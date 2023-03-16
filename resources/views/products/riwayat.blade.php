@php
    $html_tag_data = [];
    $title = 'Riwayat Transaksi';
    $description= 'A table enhancing plug-in for the jQuery Javascript library, adding sorting, paging and filtering abilities to plain HTML tables with minimal effort.';
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
    <link rel="stylesheet" href="/css/vendor/datatables.min.css"/>
@endsection

@section('meta')
    
@endsection

@section('js_vendor')
<script src="/js/cs/scrollspy.js"></script>
<script src="/js/vendor/datatables.min.js"></script>
@endsection

@section('js_page')
<script src="/js/cs/datatable.extend.js"></script>
<script src="/js/plugins/riwayat.transaksi.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row" id="riwayat_transaksi">
            <div class="col-12 col-xl-4 mb-5">
                <div class="d-flex justify-content-between">
                    <h2 class="small-title">Riwayat Transaksi</h2>
                </div>
                <div class="scroll-out">
                    <div class="scroll-by-count" data-count="5">
                        @foreach ($transaksis as $transaksi)
                        <div class="card mb-2">
                            <div class="row g-0 sh-13 p-3">
                                <div class="col-6">
                                    <a class="nama-costumer" id="id_transaksi" href="#" onclick="myIdTrs('{{ url('/RiwayatTransaksi/'.$transaksi->id_transaksi) }}','{{ $transaksi->nomor_invoice }}','{{ $transaksi->total_harga }}')">{{ $transaksi->costumer->nama }}</a>
                                    <div class="text-medium text-muted text-truncate">No. Invoice : {{ $transaksi->nomor_invoice }}</div>
                                    <div class="text-medium text-muted text-truncate">Tanggal Transaksi : {{ date('d-m-Y', strtotime($transaksi->created_at)) }}</div>
                                </div>
                                <div class="col-6 text-end mt-2">
                                    <a class="medium-title">Total Harga:</a>
                                    <h4>{{'Rp '.number_format($transaksi->total_harga,0,',-','.') }}</h4>
                                </div>
                            </div>
                        </div>    
                        @endforeach
                    </div>
                </div>
            </div>
            <section class="col-12 col-xl-8 scroll-section" id="stripe">
                <h2 class="small-title">Produk</h2>
                <div class="card mb-5">
                    <div class="card-body">
                        <!-- Stripe Controls Start -->
                        <h5>No. Invoice: 
                            <span class="text-medium" id="no_invoice"></span>
                        </h5>
                        <div class="row">
                            <div class="col-12 col-sm-5 col-lg-3 col-xxl-2 mb-1">
                                <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 border border-separator bg-foreground search-sm">
                                    <input class="form-control form-control-sm datatable-search" placeholder="Search" data-datatable="#datatableStripe" />
                                    <span class="search-magnifier-icon">
                                        <i data-acorn-icon="search"></i>
                                    </span>
                                    <span class="search-delete-icon d-none">
                                        <i data-acorn-icon="close"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-sm-7 col-lg-9 col-xxl-10 text-end mb-1">
                                <div class="d-inline-block">
                                    <button class="btn btn-icon btn-icon-only btn-outline-muted btn-sm datatable-print" type="button" data-datatable="#datatableStripe">
                                        <i data-acorn-icon="print"></i>
                                    </button>
                                    <div class="d-inline-block datatable-export" data-datatable="#datatableStripe">
                                        <button
                                                class="btn btn-icon btn-icon-only btn-outline-muted btn-sm dropdown"
                                                data-bs-toggle="dropdown"
                                                type="button"
                                                data-bs-offset="0,3"
                                        >
                                            <i data-acorn-icon="download"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                            <button class="dropdown-item export-copy" type="button">Copy</button>
                                            <button class="dropdown-item export-excel" type="button">Excel</button>
                                            <button class="dropdown-item export-cvs" type="button">Cvs</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Stripe Controls End -->

                        <!-- Stripe Table Start -->
                        <table
                                class="data-table data-table-pagination data-table-standard responsive nowrap stripe"
                                id="datatableStripe"
                                data-order='[[ 0, "asc" ]]'
                        >
                            <thead>
                            <tr>
                                <th class="col-1 text-muted text-small text-uppercase">SKU Produk</th>
                                <th class="col-5 text-muted text-small text-uppercase">Nama Produk</th>
                                <th class="col-1 text-muted text-small text-uppercase">Diskon</th>
                                <th class="col-2 text-muted text-small text-uppercase">Harga</th>
                                <th class="col-1 text-muted text-small text-uppercase">Jumlah</th>
                                <th class="col-2 text-muted text-small text-uppercase">Subtotal</th>
                            </tr>
                            </thead>
                        </table>
                        <!-- Stripe Table End -->
                        <h4 class="small-title text-end mt-2">Total Harga:</h4>
                        <h4 class="text-end" id="total_harga"></h4>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection