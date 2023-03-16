@php
    $html_tag_data = [];
    $title = 'Default Dashboard';
    $description = 'Home screen that contains stats, charts, call to action buttons and various listing elements.';
    $breadcrumbs = ["/"=>"Home","/Dashboards"=>"Dashboards"]
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
<link rel="stylesheet" href="/css/vendor/datatables.min.css"/>
@endsection

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" >
@endsection

@section('js_vendor')
<script src="/js/cs/scrollspy.js"></script>
<script src="/js/vendor/datatables.min.js"></script>
@endsection

@section('js_page')
<script src="/js/cs/datatable.extend.js"></script>
<script src="/js/plugins/transaksi.dashboard.js"></script>
<script src="/js/cs/autocomplete.custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="mb-5" id="tambahproduktabel">
            <div class="small-title d-flex justify-content-between">
                <span>Produk</span>
                <span id="tanggal"></span>
            </div>
            <div class="card">
                <div class="card-body">
                    <form class="row">
                        <input class="d-none" type="text" name="nama_produk" id="nama_produk"/>
                        <div class="mt-1 col-xl-1">
                            <label class="form-label">SKU Produk</label>
                            <input type="text" class="form-control" name="SKU_produk" id="SKU_produk" readonly/>
                        </div>
                        <div class="mt-1 col-xl-2">
                            <label class="form-label">Nama Produk</label>
                            {{-- <input type="text" class="form-control" name="nama_produk" id="nama_produk" autocomplete="off"/> --}}
                            <select class="form-control" id="id_produk" required>
                                <option value="">---Pilih Produk---</option>
                                @foreach ($produks as $produk)
                                    <option value="{{ $produk->id_produk }}">{{ $produk->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-1 col-xl-1">
                            <label class="form-label">Diskon</label>
                            <select type="number" class="form-control" name="diskon" id="diskon" oninput="_total()">
                                <option value="">--Diskon--</option>
                                <option value="Retail">Retail</option>
                                <option value="25%">25%</option>
                                <option value="35%">35%</option>
                                <option value="42%">42%</option>
                                <option value="50%">50%</option>
                            </select>
                        </div>
                        <div class="mt-1 col-xl-2">
                            <label class="form-label">Harga Produk</label>
                            <input type="text" class="form-control" name="harga" id="currency"  oninput="_total()" readonly/>
                        </div>
                        <div class="mt-1 col-xl-2">
                            <label class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah"  oninput="_total()"/>
                        </div>
                        <div class="mt-1 col-xl-2">
                            <label class="form-label">Subtotal</label>
                            <input type="text" class="form-control" name="subtotal" id="subtotal" readonly/>
                        </div>
                        <div class="mt-5 col-xl-2 d-flex justify-content-center">
                            <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start" id="resetform">Reset</button>
                            <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start ms-3 add-produk" id="tambahproduk">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8">
                <!-- Scrollbar Start -->
                <section class="scroll-section" id="scrollbar">
                    <div class="card mb-5">
                        <div class="card-body scroll-out">
                            <div class="scroll-track-visible sh-45">
                                <!-- Scrollbar Controls Start -->
                                
                                <div class="row">
                                    <div class="col-12 col-sm-5 col-lg-3 col-xxl-3 mb-1">
                                        <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 border border-separator bg-foreground search-sm">
                                            <input class="form-control form-control-sm datatable-search" placeholder="Search" data-datatable="#datatableScroll" />
                                            <span class="search-magnifier-icon">
                                                <i data-acorn-icon="search"></i>
                                            </span>
                                            <span class="search-delete-icon d-none">
                                                <i data-acorn-icon="close"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-7 col-lg-9 col-xxl-9 text-end mb-1">
                                        <div class="d-inline-block">
                                            <div class=" d-none btn btn-outline-muted btn-custom-control p-0 ps-3 pe-2" id="datatableCheckAllButton">
                                                <span class="form-check float-end">
                                                    <input type="checkbox" class="form-check-input" id="datatableCheckAll" />
                                                </span>
                                            </div>
                                            <button
                                                class="btn btn-icon btn-icon-only btn-outline-muted btn-sm disabled delete-datatable"
                                                data-bs-delay="0"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Delete"
                                                type="button"
                                            >
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                            <button
                                                    class="btn btn-icon btn-icon-only btn-outline-muted btn-sm datatable-print"
                                                    type="button"
                                                    data-datatable="#datatableScroll"
                                                    data-bs-delay="0"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Cetak"
                                            >
                                                <i data-acorn-icon="print"></i>
                                            </button>
                                            <div class="d-inline-block datatable-export" data-datatable="#datatableScroll">
                                                <button
                                                        class="btn btn-icon btn-icon-only btn-outline-muted btn-sm dropdown"
                                                        data-bs-toggle="dropdown"
                                                        type="button"
                                                        data-bs-offset="0,3"
                                                        data-bs-delay="0"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Download"
                                                        
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
                                <!-- Scrollbar Controls End -->

                                <!-- Scrollbar Table Start -->
                                <table class="data-table data-table-scrollable responsive nowrap hover" data-order='[[ 0, "asc" ]]' id="datatableScroll">
                                    <thead>
                                    <tr>
                                        <th class="text-muted text-small text-uppercase">ID</th>
                                        <th class="col-1 text-muted text-small text-uppercase">SKU</th>
                                        <th class="col-4 text-muted text-small text-uppercase">Nama Produk</th>
                                        <th class="col-1 text-muted text-small text-uppercase">Diskon</th>
                                        <th class="col-2 text-muted text-small text-uppercase">Harga</th>
                                        <th class="col-1 text-muted text-small text-uppercase">Jumlah</th>
                                        <th class="col-2 text-muted text-small text-uppercase">Subtotal</th>
                                        <th class="col-1 empty all">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    {{-- <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>PRD-001</td>
                                            <td>Herbal Jamu</td>
                                            <td>20000</td>
                                            <td>2</td>
                                            <td>40000</td>
                                            <td></td>
                                        </tr>    
                                        <tr>
                                            <td>2</td>
                                            <td>PRD-002</td>
                                            <td>Herbal Susu</td>
                                            <td>40000</td>
                                            <td>2</td>
                                            <td>80000</td>
                                            <td></td>
                                        </tr>    
                                    </tbody> --}}
                                </table>
                                <!-- Scrollbar Table End -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Scrollbar End -->
            </div>
            <div class="col-xl-4">
                <div class="card mb-5">
                    <div class="card-body">
                        <p class="small-title">Total Harga</p>
                        <h1 id="totalbelanja">Rp 0</h1>
                    </div>
                </div>
                <div class="card" id="costumer">
                    <form class="card-body">
                        <h2 class="small-title">Costumer</h2>
                        <input class="d-none" name="id_cs" id="id_cs"/>
                        <div class="row mb-2">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="id_costumer" id="id_costumer" placeholder="" />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="nama_costumer" id="nama_costumer" placeholder="" readonly/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Bayar</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="bayar_costumer" id="bayar_costumer" placeholder="" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start ms-1 add-produk-database" id="simpanproduk">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
