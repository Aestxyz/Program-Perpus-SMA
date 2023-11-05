<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $waiting = Transaction::where('status', 'Menunggu')
            ->orderBy('updated_at', 'DESC')
            ->get();
        $walking = Transaction::where('status', 'Berjalan')
            ->orderBy('updated_at', 'DESC')
            ->get();
        $penalty = Transaction::where('status', 'Terlambat')
            ->orderBy('updated_at', 'DESC')
            ->get();
        $finished = Transaction::where('status', 'Selesai')
            ->orderBy('updated_at', 'DESC')
            ->get();

        $borrow_date = Carbon::now()->format('Y-m-d');
        $return_date = Carbon::now()->addDays(7)->format('Y-m-d');
        $users = User::select('id', 'name')->get();
        $books = Book::get();

        return view('transaction.index', [
            'waiting' => $waiting,
            'walking' => $walking,
            'penalty' => $penalty,
            'finished' => $finished,
            'borrow_date' => $borrow_date,
            'return_date' => $return_date,
            'users' => $users,
            'books' => $books,
        ]);
    }
    public function store(TransactionRequest $request)
    {
        $validate = $request->validated();

        $transaction = Transaction::where('user_id', $request->user_id)
            ->where(function ($query) {
                $query->where('status', 'Berjalan')
                    ->orWhere('status', 'Terlambat');
            })->orWhere(function ($query) {
                $query->where('status', 'Berjalan')
                    ->Where('status', 'Terlambat');
            })
            ->count();

        if ($transaction >= 3) {
            return back()->with('warning', 'Peminjaman melebihi batas yang telah ditentukan 😀');
        } else {
            $book = Book::find($request->book_id);
            $book->book_count -= 1;
            $book->save();

            $user = User::findOrFail($request->user_id);

            $validate['code'] = $user->slug . '-' . Str::random(10);

            Transaction::create($validate);

            return back()->with('success', 'Proses penambahan data telah berhasil dilakukan.');
        }
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        $users = User::select('id', 'name')->get();
        $books = Book::get();

        return view(
            'transaction.show',
            compact('transaction', 'users', 'books')
        );
    }
    public function update(TransactionRequest $request, $id)
    {
        $validate = $request->validated();
        $transaction = Transaction::findOrFail($id);
        $findbook = Book::findOrFail($transaction->book->id);

        if ($request->book_id != $findbook->id) {
            $findbook->book_count++;
            $findbook->save();

            $book = Book::findOrFail($request->book_id);
            $book->book_count--;
            $book->save();
        }

        $transaction->update($validate);

        return back()->with('success', 'Proses perubahan data telah berhasil dilakukan.');
    }
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        $book = Book::findOrfail($transaction->book->id);
        $book->book_count++;
        $book->save();

        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Proses penghapusan data telah berhasil dilakukan.');
    }
    public function confirmation(Request $request, $id)
    {
        $validate = $request->validate([
            'status' => 'required|string',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date',
        ]);

        $transaction = Transaction::findOrfail($id);

        $transaction->update($validate);

        return back()->with('success', 'Proses penambahan data peminjaman dan pengembalian buku berhasil telah berhasil dilakukan.');
    }
    public function finished($id)
    {
        $transaction = Transaction::findOrfail($id);

        $transaction->update([
            'status' => 'Selesai',
            'return_date' => Carbon::now()->format('Y-m-d'),
        ]);

        $book = Book::findOrfail($transaction->book->id);
        $book->book_count++;
        $book->save();

        return back()->with('success', 'Proses peminjaman dan pengembalian buku telah selesai dilakukan.');
    }

    public function reject($id)
    {
        $transaction = Transaction::findOrfail($id);

        $transaction->update([
            'status' => 'Tolak',
            'borrow_date' => null,
            'return_date' => null,
        ]);

        $book = Book::findOrfail($transaction->book->id);
        $book->book_count++;
        $book->save();

        return back()->with('success', 'Proses peminjaman dan pengembalian buku berhasil di tolak.');
    }

    public function extratime($id)
    {
        $transaction = Transaction::findOrfail($id);

        $transaction->update([
            'status' => 'Berjalan',
            'return_date' => Carbon::parse($transaction->return_date)
                ->addDays(7)
                ->format('Y-m-d'),
        ]);

        return back()->with('success', 'Proses perpanjangan waktu peminjaman dan pengembalian buku telah dilakukan.');
    }
}
