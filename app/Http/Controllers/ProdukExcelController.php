<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProdukImport;
use Maatwebsite\Excel\Facades\Excel;

class ProdukExcelController extends Controller
{
    public function ImportData(Request $request){

        // dd($request->file('upload_file'));

        Excel::import(new ProdukImport, $request->file('upload_file'));
        
        return redirect()->back()->with('success', 'Data berhasil diupload.');
    }
}
