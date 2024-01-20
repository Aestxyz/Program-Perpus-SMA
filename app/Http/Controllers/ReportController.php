<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transactions()
    {
        $transactions = Transaction::get();
        return view('report.transaction', [
            'transactions' => Transaction::latest()->get(),
        ]);
    }
}
