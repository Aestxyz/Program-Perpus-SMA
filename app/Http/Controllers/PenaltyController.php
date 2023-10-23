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
        return view('penalty.index', [
            'penalties' => Penalty::get()
        ]);
    }
    public function store(PenaltyRequest $request)
    {
        $validate = $request->validated();
        Penalty::create($validate);

        $transaction = Transaction::findOrfail($request->transaction_id);
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
}