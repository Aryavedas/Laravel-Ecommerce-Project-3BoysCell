<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Transaction;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $keranjangs = Keranjang::with(['user', 'barang'])->where('user_id', $user_id)->get();
        $total_harga = 0;
        for ($i = 0; $i < $keranjangs->count(); $i++) {
            $total_harga += $keranjangs[$i]->barang->harga;
        }

        return view('keranjang', compact(['keranjangs', 'total_harga']));
    }

    public function buat_pesanan()
    {
        $keranjangs = Keranjang::with(['user', 'barang'])->get();

        // Pengecekan Validasi
        if ($keranjangs->isEmpty()) {
            return redirect(route('keranjang'));
        }
        /////

        // Variable $total_harga
        $total_harga = 0;
        for ($i = 0; $i < count($keranjangs); $i++) {
            $total_harga += $keranjangs[$i]->barang->harga;
        }
        /////

        // Variable $user_id
        $user_id = Auth::user()->id;
        ////

        // Variable $barang_ids
        $barang_ids_array = [];
        $barang_ids = "";
        for ($i = 0; $i < count($keranjangs); $i++) {
            $barang_ids_array[] = $keranjangs[$i]->barang->id;
        }
        $barang_ids = implode(",", $barang_ids_array);
        /////

        // Penyimpanan Ke DB:Transaction
        $transaction = new Transaction();
        $transaction->order_id = "ORDER - " . rand();
        $transaction->total_harga = $total_harga;
        $transaction->status = "pending";
        $transaction->user_id = $user_id;
        $transaction->barang_ids = $barang_ids;
        $transaction->save();
        Keranjang::truncate();
        // Transaction::truncate();
        /////

        return redirect(route('alert.success'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $keranjang = new Keranjang();
        $user_id = Auth::user()->id;
        $keranjang->user_id = $user_id;
        $keranjang->barang_id = $id;
        $keranjang->save();

        return redirect(route("alert.success"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keranjang $keranjang)
    {
        Keranjang::truncate();
        return redirect(route("keranjang"));
        // return redirect('keranjang');
    }
}
