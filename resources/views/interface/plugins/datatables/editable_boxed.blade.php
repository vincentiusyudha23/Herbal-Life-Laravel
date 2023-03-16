@php
    $html_tag_data = [];
    $title = 'Editable Boxed Datatables';
    $description= 'A table enhancing plug-in for the jQuery Javascript library, adding sorting, paging and filtering abilities to plain HTML tables with minimal effort.';
    $breadcrumbs = ["/"=>"Home","/Interface"=>"Interface","/Interface/Plugins"=>"Plugins","/Interface/Plugins/Datatables"=>"Datatables"]
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
    <link rel="stylesheet" href="/css/vendor/datatables.min.css"/>
@endsection

@section('js_vendor')
    <script src="/js/vendor/bootstrap-submenu.js"></script>
    <script src="/js/vendor/datatables.min.js"></script>
    <script src="/js/vendor/mousetrap.min.js"></script>
@endsection

@section('js_page')
    <script src="/js/cs/datatable.extend.js"></script>
    <script src="/js/plugins/datatable.editableboxed.js"></script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Title and Top Buttons Start -->
                <div class="page-title-container">
                    <div class="row">
                        <!-- Title Start -->
                        <div class="col-12 col-md-7">
                            <h1 class="mb-0 pb-0 display-4" id="title">{{ $title }}</h1>
                            @include('_layout.breadcrumb',['breadcrumbs'=>$breadcrumbs])
                        </div>
                        <!-- Title End -->

                        <!-- Top Buttons Start -->
                        <div class="col-12 col-md-5 d-flex align-items-start justify-content-end">
                            <!-- Add New Button Start -->
                            <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto add-datatable">
                                <i data-acorn-icon="plus"></i>
                                <span>Add New</span>
                            </button>
                            <!-- Add New Button End -->

                            <!-- Check Button Start -->
                            <div class="btn-group ms-1 check-all-container">
                                <div class="btn btn-outline-primary btn-custom-control p-0 ps-3 pe-2" id="datatableCheckAllButton">
                                    <span class="form-check float-end">
                                        <input type="checkbox" class="form-check-input" id="datatableCheckAll" />
                                    </span>
                                </div>
                                <button
                                        type="button"
                                        class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split"
                                        data-bs-offset="0,3"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        data-submenu
                                ></button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="dropdown dropstart dropdown-submenu">
                                        <button class="dropdown-item dropdown-toggle tag-datatable caret-absolute disabled" type="button">Tag</button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item tag-done" type="button">Done</button>
                                            <button class="dropdown-item tag-new" type="button">New</button>
                                            <button class="dropdown-item tag-sale" type="button">Sale</button>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item disabled delete-datatable" type="button">Delete</button>
                                </div>
                            </div>
                            <!-- Check Button End -->
                        </div>
                        <!-- Top Buttons End -->
                    </div>
                </div>
                <!-- Title and Top Buttons End -->

                <!-- Content Start -->
                <div class="data-table-boxed">
                    <!-- Controls Start -->
                    <div class="row mb-2">
                        <!-- Search Start -->
                        <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
                            <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
                                <input class="form-control datatable-search" placeholder="Search" data-datatable="#datatableBoxed" />
                                <span class="search-magnifier-icon">
                                    <i data-acorn-icon="search"></i>
                                </span>
                                <span class="search-delete-icon d-none">
                                    <i data-acorn-icon="close"></i>
                                </span>
                            </div>
                        </div>
                        <!-- Search End -->

                        <div class="col-sm-12 col-md-7 col-lg-9 col-xxl-10 text-end mb-1">
                            <div class="d-inline-block me-0 me-sm-3 float-start float-md-none">
                                <!-- Add Button Start -->
                                <button
                                        class="btn btn-icon btn-icon-only btn-foreground-alternate shadow add-datatable"
                                        data-bs-delay="0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Add"
                                        type="button"
                                >
                                    <i data-acorn-icon="plus"></i>
                                </button>
                                <!-- Add Button End -->

                                <!-- Edit Button Start -->
                                <button
                                        class="btn btn-icon btn-icon-only btn-foreground-alternate shadow edit-datatable"
                                        data-bs-delay="0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Edit"
                                        type="button"
                                >
                                    <i data-acorn-icon="edit"></i>
                                </button>
                                <!-- Edit Button End -->

                                <!-- Delete Button Start -->
                                <button
                                        class="btn btn-icon btn-icon-only btn-foreground-alternate shadow disabled delete-datatable"
                                        data-bs-delay="0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Delete"
                                        type="button"
                                >
                                    <i data-acorn-icon="bin"></i>
                                </button>
                                <!-- Delete Button End -->
                            </div>
                            <div class="d-inline-block">
                                <!-- Print Button Start -->
                                <button
                                        class="btn btn-icon btn-icon-only btn-foreground-alternate shadow datatable-print"
                                        data-bs-delay="0"
                                        data-datatable="#datatableBoxed"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Print"
                                        type="button"
                                >
                                    <i data-acorn-icon="print"></i>
                                </button>
                                <!-- Print Button End -->

                                <!-- Export Dropdown Start -->
                                <div class="d-inline-block datatable-export" data-datatable="#datatableBoxed">
                                    <button class="btn p-0" data-bs-toggle="dropdown" type="button" data-bs-offset="0,3">
                                        <span
                                                class="btn btn-icon btn-icon-only btn-foreground-alternate shadow dropdown"
                                                data-bs-delay="0"
                                                data-bs-placement="top"
                                                data-bs-toggle="tooltip"
                                                title="Export"
                                        >
                                            <i data-acorn-icon="download"></i>
                                        </span>
                                    </button>
                                    <div class="dropdown-menu shadow dropdown-menu-end">
                                        <button class="dropdown-item export-copy" type="button">Copy</button>
                                        <button class="dropdown-item export-excel" type="button">Excel</button>
                                        <button class="dropdown-item export-cvs" type="button">Cvs</button>
                                    </div>
                                </div>
                                <!-- Export Dropdown End -->

                                <!-- Length Start -->
                                <div class="dropdown-as-select d-inline-block datatable-length" data-datatable="#datatableBoxed" data-childSelector="span">
                                    <button class="btn p-0 shadow" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-offset="0,3">
                                        <span
                                                class="btn btn-foreground-alternate dropdown-toggle"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-delay="0"
                                                title="Item Count"
                                        >
                                            15 Items
                                        </span>
                                    </button>
                                    <div class="dropdown-menu shadow dropdown-menu-end">
                                        <a class="dropdown-item" href="#">10 Items</a>
                                        <a class="dropdown-item active" href="#">15 Items</a>
                                        <a class="dropdown-item" href="#">20 Items</a>
                                    </div>
                                </div>
                                <!-- Length End -->
                            </div>
                        </div>
                    </div>
                    <!-- Controls End -->
                    <div class="row">
                        <div class="col-xl-6 col-12">
                            <table id="datatableBoxed" class="data-table data-table-scrollable nowrap hover">
                                <thead>
                                <tr>
                                    <th class="text-muted text-small text-uppercase">Name</th>
                                    <th class="text-muted text-small text-uppercase">Sales</th>
                                    <th class="text-muted text-small text-uppercase">Stock</th>
                                    <th class="text-muted text-small text-uppercase">Category</th>
                                    <th class="text-muted text-small text-uppercase">Tag</th>
                                    <th class="empty all">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-xl-6 mb-5">
                            <div class="d-flex justify-content-between">
                                <h2 class="small-title">Products</h2>
                                <button
                                        class="btn btn-icon btn-icon-only btn-sm btn-background-alternate mt-n2 shadow"
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        aria-haspopup="true"
                                >
                                    <i data-acorn-icon="more-horizontal" data-acorn-size="15"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end shadow">
                                    <a class="dropdown-item" href="#">Reload</a>
                                    <a class="dropdown-item" href="#">Stats</a>
                                    <a class="dropdown-item" href="#">Details</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </div>
            
                            <div class="scroll-out">
                                <div class="scroll-by-count" data-count="6">
                                    <div class="card mb-2" data-title="Product Card" data-intro="Here is a product card with buttons!" data-step="2">
                                        <div class="row g-0 sh-12">
                                            <div class="col-auto">
                                                <a href="/Pages/Portfolio/Detail">
                                                    <img src="/img/product/small/product-1.webp" alt="alternate text" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                                </a>
                                            </div>
                                            <div class="col">
                                                <div class="card-body pt-0 pb-0 h-100">
                                                    <div class="row g-0 h-100 align-content-center">
                                                        <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0 position-static">
                                                            <a href="/Pages/Portfolio/Detail">Kommissbrot</a>
                                                            <div class="text-small text-muted text-truncate">Icing liquorice olegário jujubes oat cake.</div>
                                                        </div>
                                                        <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="edit-square" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Edit</span>
                                                            </button>
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="bin" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="card mb-2">
                                        <div class="row g-0 sh-12">
                                            <div class="col-auto position-relative">
                                                <span class="badge rounded-pill bg-primary me-1 position-absolute e-n3 t-2">TREND</span>
                                                <a href="/Pages/Portfolio/Detail">
                                                    <img src="/img/product/small/product-2.webp" alt="alternate text" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                                </a>
                                            </div>
                                            <div class="col">
                                                <div class="card-body pt-0 pb-0 h-100">
                                                    <div class="row g-0 h-100 align-content-center">
                                                        <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                            <a href="/Pages/Portfolio/Detail">Yeast Karavai</a>
                                                            <div class="text-small text-muted text-truncate">Gummi liquorice olegário jujubes cookie.</div>
                                                        </div>
                                                        <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="edit-square" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Edit</span>
                                                            </button>
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="bin" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="card mb-2">
                                        <div class="row g-0 sh-12">
                                            <div class="col-auto">
                                                <a href="/Pages/Portfolio/Detail">
                                                    <img src="/img/product/small/product-3.webp" alt="alternate text" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                                </a>
                                            </div>
                                            <div class="col">
                                                <div class="card-body pt-0 pb-0 h-100">
                                                    <div class="row g-0 h-100 align-content-center">
                                                        <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                            <a href="/Pages/Portfolio/Detail">Cholermüs</a>
                                                            <div class="text-small text-muted text-truncate">Marshmallow topping icing liquorice oat cake.</div>
                                                        </div>
                                                        <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="edit-square" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Edit</span>
                                                            </button>
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="bin" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="card mb-2">
                                        <div class="row g-0 sh-12">
                                            <div class="col-auto">
                                                <a href="/Pages/Portfolio/Detail">
                                                    <img src="/img/product/small/product-4.webp" alt="alternate text" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                                </a>
                                            </div>
                                            <div class="col">
                                                <div class="card-body pt-0 pb-0 h-100">
                                                    <div class="row g-0 h-100 align-content-center">
                                                        <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                            <a href="/Pages/Portfolio/Detail">Cheesymite Scroll</a>
                                                            <div class="text-small text-muted text-truncate">Tootsie brownie ice cream marshmallow topping.</div>
                                                        </div>
                                                        <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="edit-square" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Edit</span>
                                                            </button>
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="bin" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="card mb-2">
                                        <div class="row g-0 sh-12">
                                            <div class="col-auto">
                                                <a href="/Pages/Portfolio/Detail">
                                                    <img src="/img/product/small/product-5.webp" alt="alternate text" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                                </a>
                                            </div>
                                            <div class="col">
                                                <div class="card-body pt-0 pb-0 h-100">
                                                    <div class="row g-0 h-100 align-content-center">
                                                        <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                            <a href="/Pages/Portfolio/Detail">Bazlama</a>
                                                            <div class="text-small text-muted text-truncate">Tootsie roll cream marshmallow chocolate bar.</div>
                                                        </div>
                                                        <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="edit-square" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Edit</span>
                                                            </button>
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="bin" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="card mb-2">
                                        <div class="row g-0 sh-12">
                                            <div class="col-auto">
                                                <a href="/Pages/Portfolio/Detail">
                                                    <img src="/img/product/small/product-6.webp" alt="alternate text" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                                </a>
                                            </div>
                                            <div class="col">
                                                <div class="card-body pt-0 pb-0 h-100">
                                                    <div class="row g-0 h-100 align-content-center">
                                                        <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                            <a href="/Pages/Portfolio/Detail">Soda Bread</a>
                                                            <div class="text-small text-muted text-truncate">Marshmallow topping icing liquorice oat cake.</div>
                                                        </div>
                                                        <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="edit-square" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Edit</span>
                                                            </button>
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="bin" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="card mb-2">
                                        <div class="row g-0 sh-12">
                                            <div class="col-auto">
                                                <a href="/Pages/Portfolio/Detail">
                                                    <img src="/img/product/small/product-7.webp" alt="alternate text" class="card-img card-img-horizontal sw-13 sw-lg-15" />
                                                </a>
                                            </div>
                                            <div class="col">
                                                <div class="card-body pt-0 pb-0 h-100">
                                                    <div class="row g-0 h-100 align-content-center">
                                                        <div class="col-12 col-md-7 d-flex flex-column mb-2 mb-md-0">
                                                            <a href="/Pages/Portfolio/Detail">Chapati</a>
                                                            <div class="text-small text-muted text-truncate">Tootsie brownie ice cream marshmallow topping.</div>
                                                        </div>
                                                        <div class="col-12 col-md-5 d-flex align-items-center justify-content-md-end">
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="edit-square" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Edit</span>
                                                            </button>
                                                            <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                                                                <i data-acorn-icon="bin" data-acorn-size="15"></i>
                                                                <span class="d-none d-xxl-inline-block">Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table Start -->
                    
                    <!-- Table End -->
                </div>
                <!-- Content End -->

                <!-- Add Edit Modal Start -->
                <div class="modal modal-right fade" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle">Add New</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input name="Name" type="text" class="form-control" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Sales</label>
                                        <input name="Sales" type="number" class="form-control" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Stock</label>
                                        <input name="Stock" type="number" class="form-control" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <div class="form-check">
                                            <input type="radio" id="category1" name="Category" value="Whole Wheat" class="form-check-input" />
                                            <label class="form-check-label" for="category1">Whole Wheat</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="category2" name="Category" value="Sourdough" class="form-check-input" />
                                            <label class="form-check-label" for="category2">Sourdough</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="category3" name="Category" value="Multigrain" class="form-check-input" />
                                            <label class="form-check-label" for="category3">Multigrain</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tag</label>
                                        <div class="form-check">
                                            <input type="radio" id="tag1" name="Tag" value="New" class="form-check-input" />
                                            <label class="form-check-label" for="tag1">New</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="tag2" name="Tag" value="Sale" class="form-check-input" />
                                            <label class="form-check-label" for="tag2">Sale</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="tag3" name="Tag" value="Done" class="form-check-input" />
                                            <label class="form-check-label" for="tag3">Done</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="addEditConfirmButton">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Edit Modal End -->
            </div>
        </div>
    </div>
@endsection
