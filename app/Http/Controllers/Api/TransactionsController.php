<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TransactionsController extends Controller
{
    public function getAllTransactions()
    {
        $transactions = DB::table('transactions')
        ->select(
            'transactions.id as id',
            'u1.fullname as peminjam',
            'u2.fullname as petugas',
            'tanggalPinjam as tanggalPinjam',
            'tanggalSelesai as tanggalSelesai',
        )
        ->join('users as u1', 'userIdPeminjam', '=', 'u1.id')
        ->join('users as u2', 'userIdPetugas', '=', 'u2.id')
        ->orderBy('tanggalPinjam', 'asc')
        ->get();
        return response()->json([
            'list transaksi' => $transactions
        ]);
    }
}
