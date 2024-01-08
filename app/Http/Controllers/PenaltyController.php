<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenaltyRequest;
use App\Models\Book;
use App\Models\Penalty;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    public function index()
    {
        $penalties = Penalty::get();
        $total = 0;

        foreach ($penalties as $penalty) {
            $total += $penalty->amount;
        }

        $dont_payment = Transaction::where('status', 'Terlambat')
            ->orderBy('updated_at', 'DESC')
            ->get();

        return view('penalty.index', [
            'penalties' => $penalties,
            'all_amount' => $total,
            'dont_payment' => $dont_payment
        ]);
    }
    public function store(PenaltyRequest $request)
    {
        $transaction = Transaction::findOrFail($request->transaction_id);

        $validatedData = $request->validated();
        $validatedData['borrow_date'] = $transaction->borrow_date;
        $validatedData['return_date'] = $transaction->return_date;

        Penalty::create($validatedData);
        $transaction->update([
            'status' => 'Selesai',
            'return_date' => Carbon::now()->format('Y-m-d'),
        ]);

        $book = Book::findOrfail($transaction->book->id);
        $book->book_count++;
        $book->save();

        return redirect()->route('transactions.index')->with('success', 'Proses pelunasan dan pengembalian buku telah berhasil dilakukan.');
    }

    public function show($id)
    {
        $transaction = Transaction::findOrfail($id);
        $lates_day = Carbon::parse($transaction->return_date)->diffInDays();

        $penalty = 1000;

        $amount = $lates_day * $penalty;

        return view('penalty.show', [
            'transaction' => $transaction,
            'lates_day' => $lates_day,
            'penalty' => $penalty,
            'amount' => $amount,
        ]);
    }

    public function createAndUpdate(PenaltyRequest $request)
    {
        $transaction = Transaction::findOrFail($request->transaction_id);

        $validatedData = $request->validated();
        $validatedData['borrow_date'] = $transaction->borrow_date;
        $validatedData['return_date'] = $transaction->return_date;

        Penalty::create($validatedData);

        $transaction->update([
            'status' => 'Berjalan',
            'return_date' => Carbon::parse($transaction->return_date)
                ->addDays(7)
                ->format('Y-m-d'),
        ]);

        return redirect()->route('penalties.index')->with('success', 'Proses perpanjangan waktu peminjaman dan pengembalian buku telah dilakukan.');
    }
}
