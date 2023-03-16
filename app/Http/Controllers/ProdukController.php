<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {   
        $volume = produk::sum('vp');
        $data = produk::orderBy('id_produk','asc');
        if(request('search')){
            $data->where('nama','like','%'.request('search').'%');
            // $data->where('stock','like','%'.request('search').'%');
            // $data->where('vp','like','%'.request('search').'%');
        }
        return view('products/listproduk',[
            'data' => $data->paginate(10),
            'volume'=>$volume,  
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $selectedvalue = $request->input('selectedvalue');

        $data = produk::where('id_produk',$selectedvalue)->first();
        // return view('products/create');
        return response()->json(['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'nama'=>'required',
            'vp'=>'required',
            'harga_produk'=>'required',
            'harga_25'=>'required',
            'harga_35'=>'required',
            'harga_42'=>'required',
            'harga_50'=>'required',
            'SKU_produk'=>'required',
            'stok'=>'required'
        ]);
        $data = [  
            'nama'=>$request->input('nama'),
            'vp'=>$request->input('vp'),
            'harga_produk'=>$request->input('harga_produk'),
            'harga_25'=>$request->input('harga_25'),
            'harga_35'=>$request->input('harga_35'),
            'harga_42'=>$request->input('harga_42'),
            'harga_50'=>$request->input('harga_50'),
            'SKU_produk'=>$request->input('SKU_produk'),
            'deskripsi'=>$request->input('deskripsi'),
            'stok'=>$request->input('stok')
        ];
        if(Request('img_produk')){
            $request->validate([
                'img_produk'=>'mimes:jpeg,jpg,png,gif,webp'
            ]);
            $img_file = $request->file('img_produk');
            $img_ekstensi = $img_file->extension();
            $img_name = date('ymdhis').".".$img_ekstensi;
            $img_file->move(public_path('img/newproduk'),$img_name);

            $data['img_produk']=$img_name;
        }
        produk::create($data);
        return redirect('/Products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = produk::where('id_produk',$id)->first(); 
        return view('products/detailproduk')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = produk::where('id_produk',$id)->first();
        return view('products/edit')->with('data',$data);
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
        $request->validate([
            'nama'=>'required',
            'vp'=>'required',
            'stok'=>'required',
            'harga_produk'=>'required',
            'harga_25'=>'required',
            'harga_35'=>'required',
            'harga_42'=>'required',
            'harga_50'=>'required',
            'SKU_produk'=>'required',
            // 'deskripsi'=>'required',

        ]);

        $data = [
            'nama'=>$request->input('nama'),
            'vp'=>$request->input('vp'),
            'harga_produk'=>$request->input('harga_produk'),
            'harga_25'=>$request->input('harga_25'),
            'harga_35'=>$request->input('harga_35'),
            'harga_42'=>$request->input('harga_42'),
            'harga_50'=>$request->input('harga_50'),
            'SKU_produk'=>$request->input('SKU_produk'),
            'deskripsi'=>$request->input('deskripsi'),
            'stok'=>$request->input('stok'),
        ];
        if($request->hasFile('img_produk')){
            $request->validate([
                'img_produk'=>'mimes:jpeg,jpg,png,gif,webp'
            ]);
            $img_file=$request->file('img_produk');
            $img_ekstensi=$img_file->extension();
            $img_name=date('ymdhis').".".$img_ekstensi;
            $img_file->move(public_path('img/newproduk'),$img_name);

            $data_img=produk::where('id_produk',$id)->first();
            File::delete(public_path('img/newproduk').'/'.$data_img->img_produk);

            $data['img_produk']=$img_name;
        };
        produk::where('id_produk',$id)->update($data);
        return redirect('/Products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = produk::where('id_produk',$id)->first();
        File::delete(public_path('img/newproduk').'/'.$data->img_produk);

        produk::where('id_produk',$id)->delete();
        return redirect('/Products');
    }
}
