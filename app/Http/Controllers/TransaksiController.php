<?php

namespace App\Http\Controllers;


use Exception;
use Carbon\Carbon;
use App\Models\produk;
use App\Models\costumer;
use App\Models\transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\produk_transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{   
    public function index(){
        $today = Carbon::today()->toDateString();
        
        $data = produk_transaksi::with(['produk','transaksi']);
        // $data = produk::with('transaksi');
        return $data
                ->orderBy('created_at','desc')
                // ->whereDate('created_at',$today)
                ->paginate();
    }
    public function store(Request $request){

        $id_costumer = $request->id_costumer;
        $jumlah_item = $request->jumlah_item;
        $total_harga = $request->total_harga;
        $diskon = $request->diskon;
    
        $produks = $request->produk;
        // $produks = $request->produk;

        // $test = [
        //     'produk_id'=>$request->produk_id,
        //     'jumlah'=>$request->jumlah
        // ];
        //-------------------------//
        // $transaksi_db = new transaksi();
        // $transaksi_db->costumer_id = $costumer_id;
        // $transaksi_db->invoice = 'CSR' . date('Ymd') . Str::random(5);
        // $transaksi_db->total_harga = $totalharga;
        // $transaksi_db->save();
        DB::beginTransaction();
        try {
            $transaksi_db = new transaksi();
            $transaksi_db->id_costumer = $id_costumer;
            $transaksi_db->jumlah_item = $jumlah_item;
            $transaksi_db->total_harga = $total_harga;
            $transaksi_db->nomor_invoice = 'CSR'.date('Ymd').Str::random(3);
            $transaksi_db->save();

            foreach ($produks as $produk) {
                $produk_db = produk::find($produk['id_produk']);
                if ($produk_db->stok >= $produk['jumlah']) {
                    $produk_db->stok -= $produk['jumlah'];
                    $produk_db->save();
                    
                } else {
                    throw new Exception('Stok produk ' . $produk_db->nama . ' tidak mencukupi');
                }
                $produk_transaksi_db = new produk_transaksi();
                $produk_transaksi_db->id_transaksi = $transaksi_db->id_transaksi;
                $produk_transaksi_db->id_produk = $produk['id_produk'];
                $produk_transaksi_db->harga = $produk['harga'];
                $produk_transaksi_db->diskon = $produk['diskon'];
                $produk_transaksi_db->jumlah_item = $produk['jumlah'];
                $produk_transaksi_db->subtotal_harga = $produk['subtotal'];
                $produk_transaksi_db->save();
            }

            
            DB::commit();
            return response()->json(['success'=>true,'message'=>'Transaksi Berhasil']);
        } catch (\Throwable  $th) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
        
        
    }
    public function riwayat($transaksiId)
    {
        $transaksi = transaksi::where('id_transaksi',$transaksiId)->first();
        return response()->json([
            'data'=>$transaksi->produk
        ]);
    }
    public function show(){
        $today = Carbon::today()->toDateString();
        $transaksis = transaksi::with('costumer');
        return view('products/riwayat',[
            'transaksis'=>$transaksis
                        ->orderBy('created_at','desc')
                        // ->whereDate('created_at',$today)
                        ->get()
        ]);
    }

    public function produkdsb(){
        $produks = produk::all();
        $costumers = costumer::all();
        
        return view('products/dashboard',[
            'produks'=>$produks,
            'costumers'=>$costumers
        ]);
    }

    
}
