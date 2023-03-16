@php
    $html_tag_data = [];
    $title = 'Product List';
    $description= 'Ecommerce Product List Page'
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
@endsection

@section('js_vendor')
<script src="js/vendor/datatables.min.js"></script>
@endsection

@section('js_page')
    <script src="/js/cs/checkall.js"></script>
    
    <script src="js/cs/datatable.extend.js"></script>
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
    @if (session('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="container"> 
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row g-0">
                <!-- Title Start -->
                <div class="col-auto mb-3 mb-md-0 me-auto">
                    <div class="w-auto sw-md-30">
                        <a href="#" class="muted-link pb-1 d-inline-block breadcrumb-back">
                            <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
                            <span class="text-small align-middle">Home</span>
                        </a>
                        <h1 class="mb-0 pb-0 display-4" id="title">{{ $title }}</h1>
                    </div>
                </div>
                <!-- Title End -->

                <!-- Top Buttons Start -->
                <div class="w-100 d-md-none"></div>
                <div class="col-12 col-sm-6 col-md-auto d-flex align-items-end justify-content-end mb-2 mb-sm-0 order-sm-3">
                    <a class="btn btn-outline-primary btn-icon btn-icon-start ms-0 ms-sm-1 w-100 w-md-auto">
                        Total VP : {{ $volume }}
                    </a>
                    {{-- <a href="/Products/create" type="button" class="btn btn-outline-primary btn-icon btn-icon-start ms-0 ms-sm-1 w-100 w-md-auto">
                        <i data-acorn-icon="plus"></i>
                        Add Product
                    </a> --}}
                    <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start ms-0 ms-sm-1 w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#CreateModal">
                        <i data-acorn-icon="plus"></i>
                        Add Product
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start ms-0 ms-sm-1 w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#CreateModalExcel">
                        <i data-acorn-icon="plus"></i>
                        Add Product Via Excel
                    </button>
                </div>
                
                <!-- Top Buttons End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Controls Start -->
        <div class="row mb-2">
            <!-- Search Start -->
            <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
                <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
                    <form action="Products">
                        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}"/>
                        <span class="search-magnifier-icon">
                            <i data-acorn-icon="search" class="mb-2"></i>
                        </span>
                        {{-- <button type="submit" class="search-magnifier-icon bg-foreground border-0 rounded">
                        </button> --}}
                        <span class="search-delete-icon d-none">
                            <i data-acorn-icon="close"></i>
                        </span>
                    </form>
                </div>
            </div>
            
            <!-- Search End -->

        </div>
        <!-- Controls End -->

        <div class="row g-0">
            <div class="col-12 mb-5">
                <!-- List Items Start -->
                <div id="checkboxTable">
                    <div class="mb-4 mb-lg-3 bg-transparent no-shadow d-none d-lg-block">
                        <div class="row g-0">
                            <div class="col-auto sw-11 d-none d-lg-flex"></div>
                            <div class="col">
                                <div class="ps-5 pe-4 h-100">
                                    <div class="row g-0 h-100 align-content-center custom-sort">
                                        <div class="col-lg-2 d-flex flex-column mb-lg-0 pe-3 d-flex">
                                            <div class="text-muted cursor-pointer" >Nama Produk</div>
                                        </div>
                                        <div class="col-lg-1 d-flex flex-column pe-1 justify-content-center">
                                            <div class="text-muted cursor-pointer" >Stock</div>
                                        </div>
                                        <div class="col-lg-1 d-flex flex-column pe-1 justify-content-center">
                                            <div class="text-muted cursor-pointer" >Harga Retail</div>
                                        </div>
                                        <div class="col-lg-1 d-flex flex-column pe-1 justify-content-center">
                                            <div class="text-muted cursor-pointer" >Diskon 25%</div>
                                        </div>
                                        <div class="col-lg-1 d-flex flex-column pe-1 justify-content-center">
                                            <div class="text-muted cursor-pointer" >Diskon 35%</div>
                                        </div>
                                        <div class="col-lg-1 d-flex flex-column pe-1 justify-content-center">
                                            <div class="text-muted cursor-pointer" >Diskon 42%</div>
                                        </div>
                                        <div class="col-lg-1 d-flex flex-column pe-1 justify-content-center">
                                            <div class="text-muted cursor-pointer" >Diskon 50%</div>
                                        </div>
                                        <div class="col-lg-1 d-flex flex-column pe-1 justify-content-center">
                                            <div class="text-muted  cursor-pointer" >VP</div>
                                        </div>
                                        <div class="col-lg-3 d-flex flex-column pe-1 justify-content-center">
                                            <div class="text-muted cursor-pointer" >Action</div>
                                        </div>
                                    </div>
                        
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Container Start -->
                    @foreach ( $data as $item)
                    <div class="card mb-2">
                        <div class="row g-0 h-100 sh-lg-9 position-relative">
                            <a href="{{url('/Products/'.$item->id_produk)}}" class="col-auto position-relative">
                                @if ($item->img_produk)
                                    <img src="{{ url('img/newproduk').'/'.$item->img_produk }}" alt="product" class="card-img card-img-horizontal sw-11 sh-9"/>
                                @else
                                    <img src="img/product/small/product-1.webp" alt="product" class="card-img card-img-horizontal sw-11 h-100" />
                                @endif
                            </a>
                            <div class="col py-4 py-lg-0">
                                <div class="ps-5 pe-4 h-100">
                                    <div class="row g-0 h-100 align-content-center">
                                        <a href="{{url('/Products/'.$item->id_produk)}}" class="col-11 col-lg-2 d-flex flex-column mb-lg-0 mb-3 pe-3 d-flex order-1 h-lg-100 justify-content-center">
                                            {{ $item->nama}}
                                            <span class="text-small">#{{ $item->id_produk }}</span>
                                        </a>
                                        <div class="col-12 col-lg-1 d-flex flex-column pe-1 mb-2 mb-lg-0 justify-content-center order-2">
                                            <div class="lh-1 text-alternate">{{ $item->stok }}</div>
                                        </div>
                                        <div class="col-12 col-lg-1 d-flex flex-column pe-1 mb-2 mb-lg-0 justify-content-center order-2">
                                            <div class="lh-1 text-alternate">{{'Rp'.number_format($item->harga_produk,0,',-','.')  }}</div>
                                        </div>
                                        <div class="col-12 col-lg-1 d-flex flex-column pe-1 mb-2 mb-lg-0 justify-content-center order-2">
                                            <div class="lh-1 text-alternate">{{'Rp'.number_format($item->harga_25,0,',-','.')  }}</div>
                                        </div>
                                        <div class="col-12 col-lg-1 d-flex flex-column pe-1 mb-2 mb-lg-0 justify-content-center order-2">
                                            <div class="lh-1 text-alternate">{{'Rp'.number_format($item->harga_35,0,',-','.')  }}</div>
                                        </div>
                                        <div class="col-12 col-lg-1 d-flex flex-column pe-1 mb-2 mb-lg-0 justify-content-center order-2">
                                            <div class="lh-1 text-alternate">{{'Rp'.number_format($item->harga_42,0,',-','.')  }}</div>
                                        </div>
                                        <div class="col-12 col-lg-1 d-flex flex-column pe-1 mb-2 mb-lg-0 justify-content-center order-2">
                                            <div class="lh-1 text-alternate">{{'Rp'.number_format($item->harga_50,0,',-','.')  }}</div>
                                        </div>
                                        <div class="col-12 col-lg-1 d-flex flex-column pe-1 mb-2 mb-lg-0 justify-content-center order-3">
                                            <div class="lh-1 text-alternate">
                                                {{ $item->vp }}
                                            </div>
                                        </div>
                                        <a role="button" href="{{url('/Products/'.$item->id_produk)}}" class="col-12 col-lg-2 d-flex flex-column order-4 btn btn-outline-primary btn-icon btn-icon-start my-0 my-sm-1 my-md-3 w-100 w-md-auto">
                                            Detail
                                        </a>
                                        <form action="{{ '/Products/'.$item->id_produk }}" method="POST" class="col-12 col-lg-2 d-flex flex-column order-4 mt-2 my-sm-1 my-md-3 w-100 w-md-auto mx-0 mx-sm-0 mx-md-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-primary btn-icon btn-icon-start align-items-center">
                                                <i data-acorn-icon="bin"></i>
                                            </button>
                                        </form>
                                        <a role="button" href="{{url('/Products/'.$item->id_produk.'/edit')}}" class="col-12 col-lg-2 d-flex  flex-column order-4 btn btn-outline-primary btn-icon btn-icon-start mt-2 my-sm-1 my-md-3 w-100 w-md-auto mx-0 mx-sm-0 align-items-center">
                                            <i data-acorn-icon="pen"></i>
                                        </a>
        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
            
                    <!-- Items Container Start -->

                    <!-- List Items End -->
                </div>
            </div>
            <!-- Items Pagination Start -->
            {{ $data->links() }}
            
            <!-- Items Pagination End -->
        </div>
    </div>
    
    @include('products/create')    
    {{-- @include('products/edit')     --}}
    
@endsection
