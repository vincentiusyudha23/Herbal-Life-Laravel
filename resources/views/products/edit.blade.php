@php
    $html_tag_data = [];
    $title = 'Edit Product';
    $description= 'Ecommerce Product Detail Page'
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
    <link rel="stylesheet" href="/css/vendor/quill.bubble.css"/>
    <link rel="stylesheet" href="/css/vendor/select2.min.css"/>
    <link rel="stylesheet" href="/css/vendor/select2-bootstrap4.min.css"/>
    <link rel="stylesheet" href="/css/vendor/tagify.css"/>
    <link rel="stylesheet" href="/css/vendor/dropzone.min.css"/>
@endsection

@section('js_vendor')
    <script src="/js/vendor/imask.js"></script>
    <script src="/js/vendor/quill.min.js"></script>
    <script src="/js/vendor/quill.active.js"></script>
    <script src="/js/vendor/select2.full.min.js"></script>
    <script src="/js/vendor/tagify.min.js"></script>
    <script src="/js/vendor/dropzone.min.js"></script>
@endsection

@section('js_page')
    <script src="/js/cs/dropzone.templates.js"></script>
    <script src="/js/pages/products.detail.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
    <script>
        Inputmask.extendAliases({
            rupiah: {
                prefix: "Rp ",
                groupSeparator: ".",
                alias: "numeric",
                placeholder: "0",
                autoGroup: true,
                digits: 2,
                digitsOptional: false,
                clearMaskOnLostFocus: false,
                removeMaskOnSubmit: true,
                autoUnmask: true,
            }
        });
        $(document).ready(function(){
            $(['#retail','#diskon25','#diskon35','#diskon42','#diskon50']).inputmask({alias: "rupiah"});
        }); 
    </script>
@endsection

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row g-0">
                <!-- Title Start -->
                <div class="col-auto mb-3 mb-md-0 me-auto">
                    <div class="w-auto sw-md-30">
                        <a href="{{ url('Products') }}" class="muted-link pb-1 d-inline-block breadcrumb-back">
                            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
                            <span class="text-small align-middle">Products</span>
                        </a>
                        <h1 class="mb-0 pb-0 display-4" id="title">{{ $title }}</h1>
                    </div>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <div class="row">
            <div class="col-xl-9">
                <!-- Product Info Start -->
                <div class="mb-5">
                    <h2 class="small-title">Product Info</h2>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ '/Products/'.$data->id_produk }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Nama Produk</label>
                                    <span>#ID {{ $data->id_produk }}</span>
                                    <input type="text" class="form-control" name="nama" value="{{$data->nama}}" />
                                </div>
                                <div class="mb-3 w-100">
                                    <label class="form-label">Stok</label>
                                    <input type="text" class="form-control" name="stok" value="{{$data->stok}}"/>
                                </div>
                                <div class="mb-3 w-100">
                                    <label class="form-label">VP Produk</label>
                                    <input type="text" class="form-control" name="vp" value="{{$data->vp}}"/>
                                </div>
                                <p class="text-center">Harga Produk</p>
                                <div class="mb-3 row">
                                    <div class="col-4">
                                        <label for="retail" class="form-label">Retail</label>
                                        <input type="text" class="form-control" id="retail"  name="harga_produk" value="{{ $data->harga_produk }}"/>
                                    </div>
                                    <div class="col-4">
                                        <label for="harga_25" class="form-label">Diskon 25%</label>
                                        <input type="text" class="form-control" id="diskon25"  name="harga_25" value="{{ $data->harga_25 }}"/>
                                    </div>
                                    <div class="col-4">
                                        <label for="harga_35" class="form-label">Diskon 35%</label>
                                        <input type="text" class="form-control" id="diskon35"  name="harga_35" value="{{ $data->harga_35 }}"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-6">
                                        <label for="harga_42" class="form-label">Diskon 42%</label>
                                        <input type="text" class="form-control" id="diskon42"  name="harga_42" value="{{ $data->harga_42 }}"/>
                                    </div>
                                    <div class="col-6">
                                        <label for="harga_50" class="form-label">Diskon 50%</label>
                                        <input type="text" class="form-control" id="diskon50"  name="harga_50" value="{{ $data->harga_50 }}"/>
                                    </div>
                                </div>
                                <div class="mb-3 w-100">
                                    <label for="SKU_produk" class="form-label">SKU Produk</label>
                                    <input type="text" class="form-control" id="SKU_Produk"  name="SKU_produk" value="{{ $data->SKU_produk }}"/>
                                </div>
                                <div class="mb-3 w-100">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" rows="3" name="deskripsi">{{ $data->deskripsi }}</textarea>
                                </div>
                                <div class="mb-3 w-100">
                                    <label for="image" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="img_produk"  name="img_produk"/>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-outline-primary btn-icon btn-icon-start mb-3">
                                        <i data-acorn-icon="save"></i>
                                        <span>Save</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Product Info End -->
            </div>

            <div class="col-xl-3">
                <div class="mb-5">
                    <h2 class="small-title">Image</h2>
                    <div class="card">
                        <div class="card-body">  
                            @if ($data->img_produk)
                            <img src="{{ url('img/newproduk').'/'.$data->img_produk }}" alt="products" class="card-img"/>  
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
