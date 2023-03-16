<form method="POST" action="/Products" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="large-title" id="exampleModalLabel">Add Products</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input  type="text" class="form-control" id="jsonData" autocomplete="off" name="nama"/>
                        </div>
                        <div class="mb-3 w-100">
                            <label for="vp_produk" class="form-label">VP Produk</label>
                            <input type="text" class="form-control" id="vp" name="vp" />
                        </div>
                        <div class="mb-3 w-100">
                            <label for="persediaan_produk" class="form-label">Stok</label>
                            <input type="text" class="form-control" id="stock" name="stok"/>
                        </div>
                        <p class="text-center">Harga Produk</p>
                        <div class="mb-3 row">
                            <div class="col-4">
                                <label for="retail" class="form-label">Retail</label>
                                <input type="text" class="form-control" id="retail"  name="harga_produk"/>
                            </div>
                            <div class="col-4">
                                <label for="harga_25" class="form-label">Diskon 25%</label>
                                <input type="text" class="form-control" id="diskon25"  name="harga_25"/>
                            </div>
                            <div class="col-4">
                                <label for="harga_35" class="form-label">Diskon 35%</label>
                                <input type="text" class="form-control" id="diskon35"  name="harga_35"/>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-6">
                                <label for="harga_42" class="form-label">Diskon 42%</label>
                                <input type="text" class="form-control" id="diskon42"  name="harga_42"/>
                            </div>
                            <div class="col-6">
                                <label for="harga_50" class="form-label">Diskon 50%</label>
                                <input type="text" class="form-control" id="diskon50"  name="harga_50"/>
                            </div>
                        </div>
                        <div class="mb-3 w-100">
                            <label for="SKU_produk" class="form-label">SKU Produk</label>
                            <input type="text" class="form-control" id="SKU_Produk"  name="SKU_produk"/>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea placeholder="" class="form-control" rows="3" name="deskripsi"></textarea>
                        </div>
                        <div class="mb-3 w-100">
                            <label for="img_produk" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="img_produk"  name="img_produk"/>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary btn-icon btn-icon-start">
                        <i data-acorn-icon="plus"></i>
                        <span>Add</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<form method="POST" action="/ImportData" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="CreateModalExcel" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="large-title" id="exampleModalLabel">Add Products Via Excel</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <label for="upload_file">File Upload</label>
                        <input type="file" name="upload_file" class="form-control">
                <div class="mt-5 d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-primary mx-2" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary btn-icon btn-icon-start">
                        <i data-acorn-icon="plus"></i>
                        <span>Add</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

