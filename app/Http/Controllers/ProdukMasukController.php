<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\produkmasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = produkmasuk::with('produk');
        return $data->paginate();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return produk::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jml_stok = $request->stock;
        $produk_id = $request->produk_id;
        
        $produk = produk::findOrFail($produk_id);
        $produk->stok += $jml_stok;
        $produk->save(); 

        $produkmasuk = new produkmasuk();
        $produkmasuk->jumlah = $jml_stok;
        $produkmasuk->id_produk = $produk_id;
        $produkmasuk->save();

        return response()->json(['success' => true, 'produk' => $produk]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
