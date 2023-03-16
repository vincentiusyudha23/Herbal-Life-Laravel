/**
 *
 * BoxedVariations
 *
 * Interface.Plugins.Datatables.BoxedVariations page content scripts. Initialized from scripts.js file.
 *
 *
 */

class BoxedVariations {
  constructor() {
    if (!jQuery().DataTable) {
      console.log('DataTable is null!');
      return;
    }

    this._dataTableScroll = null;


    this._datatable;


    this._initBoxedWithPagination();
    this._extendDatatables();
    this._addListener();

  }


  // Boxed variation for pagination, hover and stripe examples
  _initBoxedWithPagination() {
    const _this = this;
    this._datatable = jQuery('.data-table-standard').DataTable({
      destroy: true,
      paging: false,
      data: [],
      columns: [{ data: 'SKU_produk' }, { data: 'nama' }, { data: 'pivot.diskon' }, { data: 'pivot.harga' }, { data: 'pivot.jumlah_item' }, { data: 'pivot.subtotal_harga' }],
      buttons: ['copy', 'excel', 'csv', 'print'],
      length: 10,
      columnDefs: [
        {
          targets: [3, 5],
          render: $.fn.dataTable.render.number('.', ',', 0, 'Rp '),
        },

      ],
      sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>',
      responsive: true,

    });
  }

  _addListener() {
    // document.getElementById('id_transaksi').addEventListener('click', this._idTransaksi.bind(this));
  }

  // Calling extend makes search, page length, print and export work
  _extendDatatables() {
    this._datatableExtend = new DatatableExtend({
      datatable: this._datatable,
    });
  }

}

function formatRupiah(angka) {
  let angkaElm = parseInt(angka);
  let reverse = angkaElm.toString().split('').reverse().join('');
  let ribuan = reverse.match(/\d{1,3}/g);
  ribuan = ribuan.join('.').split('').reverse().join('');
  return 'Rp ' + ribuan + ',-';
}

function myIdTrs(url, nomor_invoice, total_harga) {
  const table = $('#datatableStripe').DataTable();
  const invoiceElm = document.getElementById('no_invoice');
  const total_hargaELm = document.getElementById('total_harga');
  total_hargaELm.innerText = formatRupiah(total_harga);
  invoiceElm.innerText = nomor_invoice;

  $.ajax({
    url: url,
    type: 'GET',
    dataType: 'json',
    success: function (response) {
      // Menambahkan data ke dalam DataTables

      table.clear();
      table.rows.add(response.data).draw();
    }
  });
}


