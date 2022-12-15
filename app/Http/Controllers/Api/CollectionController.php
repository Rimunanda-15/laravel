<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    public function getAllCollection()
    {

        $data = DB::table('collections')->select(
            'id',
            'namaKoleksi',
            DB::raw('
        CASE
        WHEN jenisKoleksi = "1" THEN "Buku"
        WHEN jenisKoleksi = "2" THEN "Majalah"
        WHEN jenisKoleksi = "3" THEN "Cakram Digital"
        END AS jenisKoleksi
        '),
            'jumlahKoleksi',
            'jumlahSIsa',
            'jumlahKeluar'
        )->get();
        return response()->json([
            'List Koleksi' => $data
        ]);
    }
}
