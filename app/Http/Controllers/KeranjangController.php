<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
