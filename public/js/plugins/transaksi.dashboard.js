/**
 *
 * BoxedVariations
 *
 * Interface.Plugins.Datatables.BoxedVariations page content scripts. Initialized from scripts.js file.
 *
 *
 */



$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

class BoxedVariations {
  constructor() {
    if (!jQuery().DataTable) {
      console.log('DataTable is null!');
      return;
    }

    this._dataTableScroll = null;

    this._rowToEdit;

    this._getrowdata;

    this._datatable;

    this._totalharga = 0;

    this._datatableExtend;

    this._invoicenumber = '';

    this._TestData = [];

    this._initBoxedWithScrollbar();

    this._extend();
    this._addListeners();
    this._inputmask();
    this._initCostumer();
    this._Tanggal();


  }

  // Boxed variation with scrollbar
  _initBoxedWithScrollbar() {
    const _this = this;
    this._datatable = jQuery('.data-table-scrollable').DataTable({
      destroy: true,
      paging: false,
      buttons: ['copy', 'excel', 'csv', 'print'],
      columns: [{ data: 'id_produk' }, { data: 'SKU_produk' }, { data: 'nama_produk' }, { data: 'diskon' }, { data: 'harga' }, { data: 'jumlah' }, { data: 'subtotal' }, { data: 'check' }],
      columnDefs: [
        // Adding Name content as an anchor with a target #
        {
          targets: 2,
          render: function (data, type, row, meta) {
            return '<div class="row"><div class="col-10 text-truncate">' + data + '</div></div>'
          },
        },
        {
          targets: [4, 6],
          render: $.fn.dataTable.render.number(',', '.', 0, 'Rp '),
        },
        {
          targets: 7,
          render: function (data, type, row, meta) {
            return '<div class="form-check float-end mt-1"><input type="checkbox" class="form-check-input"></div>';
          },
        },
      ],
      sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>',
      responsive: true,
      scrollY: '100%',
      scrollCollapse: !0,
      fnInitComplete: function () {
        _this._dataTableScroll = OverlayScrollbars(document.querySelectorAll('.dataTables_scrollBody'), {
          scrollbars: { autoHideDelay: 300 },
          overflowBehavior: { x: 'hidden', y: 'scroll' },
        });
      },
    });
  }

  _addListeners() {

    document.querySelectorAll('#tambahproduk').forEach((el) => el.addEventListener('click', this._addNewRowFromModal.bind(this)));

    document.getElementById('resetform').addEventListener('click', this._clearForm);

    document.querySelectorAll('.delete-datatable').forEach((el) => el.addEventListener('click', this._onDeleteClick.bind(this)));

    document.getElementById('simpanproduk').addEventListener('click', this._simpanproduk.bind(this));

    document.querySelectorAll('.add-produk-database').forEach((el) => el.addEventListener('click', this._dataTransaksi.bind(this)));

    document.querySelectorAll('.add-produk').forEach((el) => el.addEventListener('click', this._totalhargaclass.bind(this)));

  }

  _extend() {
    this._datatableExtend = new DatatableExtend({
      datatable: this._datatable,
      editRowCallback: this._onEditRowClick.bind(this),
      singleSelectCallback: this._onSingleSelect.bind(this),
      multipleSelectCallback: this._onMultipleSelect.bind(this),
      anySelectCallback: this._onAnySelect.bind(this),
      noneSelectCallback: this._onNoneSelect.bind(this),
    });
  }

  _addNewRowFromModal() {
    const data = this._getFormData();
    this._datatable.row.add(data).draw()
    this._datatableExtend.unCheckAllRows();
  }


  _getFormData() {
    const data = {};
    data.id_produk = document.getElementById('id_produk').value;
    data.SKU_produk = document.querySelector('#tambahproduktabel input[name=SKU_produk]').value;
    data.nama_produk = document.querySelector('#tambahproduktabel input[name=nama_produk]').value;
    data.diskon = document.getElementById('diskon').value;
    data.harga = document.querySelector('#tambahproduktabel input[name=harga]').value;
    data.jumlah = document.querySelector('#tambahproduktabel input[name=jumlah]').value;
    data.subtotal = document.querySelector('#tambahproduktabel input[name=subtotal]').value;
    data.check = '';
    // if (data.id_produk == '' || data.nama_produk == '' || data.harga == '' || data.jumlah == '' || data.subtotal == '') {
    //   alert('Diisi dulu goblok');
    //   return false;
    // }

    return data;
  }

  _totalhargaclass() {

    //total harga
    const data = this._getFormData();
    const subtotal = parseInt(data.subtotal);
    let total = this._totalharga += subtotal;
    this._totalhargaELM(total);
    // document.querySelector('#tambahproduktabel form').reset();
  }

  _totalhargaELM(total) {
    const totalElm = document.getElementById('totalbelanja');
    totalElm.innerText = this._formatRupiah(total);
  }




  _onDeleteClick() {
    const selected = this._datatableExtend.getSelectedRows();
    selected.each((row, index) => {
      this._delrowdata(this._datatable.row(index));
    });
    selected.remove().draw();
    this._datatableExtend.controlCheckAll();
  }

  _delrowdata(getrowdata) {
    this._getrowdata = getrowdata;
    this._rowdata();
  }

  _rowdata() {
    const data = this._getrowdata.data();
    const subtotal = parseInt(data.subtotal);
    let total = this._totalharga -= subtotal;
    this._totalhargaELM(total);
  }

  _clearForm() {
    document.querySelector('#tambahproduktabel form').reset();

  }

  _formatRupiah(angka) {
    let reverse = angka.toString().split('').reverse().join('');
    let ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join(',').split('').reverse().join('');
    return 'Rp ' + ribuan + '.00';
  }



  _initCostumer() {
    if (document.getElementById('id_costumer') !== null) {
      new AutocompleteCustom('id_costumer', 'id_costumerResult', {
        data: {
          src: async () => {
            const source = await fetch('/Costumer');
            const data = await source.json();
            return data;
            // console.log(source);
          },
          key: ['kode_cs'],
          cache: false,

        },
        searchEngine: 'loose',
        onSelection: (feedback) => {
          document.getElementById('id_costumer').value = feedback.selection.value['kode_cs'];
          document.getElementById('id_cs').value = feedback.selection.value['id_costumer'];
          document.getElementById('nama_costumer').value = feedback.selection.value['nama'];
          document.getElementById('id_costumer').blur();
        },
      });
    }
  }

  _dataTransaksi() {
    const tabel = this._datatable.column(4).data();
    let jumlah_item = tabel.reduce(function (a, b) {
      return parseInt(a) + parseInt(b);
    });
    const costumer = this._setFormCostumer();
    const data = {};
    data.total_harga = this._totalharga;
    data.jumlah_item = jumlah_item;
    data.id_costumer = costumer.id_cs;
    $.ajax({
      url: 'Transaksi',
      type: 'POST',
      data: {
        'id_costumer': data.id_costumer,
        'jumlah_item': data.jumlah_item,
        'total_harga': data.total_harga,
        'produk': this._TestData,
      },
      success: function (response) {
        // $('#datatableR').DataTable().ajax.reload();
        alert(response.message);
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      }
    })
    this._datatable.clear().draw();
    this._totalharga = 0;
    this._totalhargaELM(this._totalharga);
    this._invoicenumber = '';
    this._invoicenumberELM(this._invoicenumber);
    document.querySelector('#costumer form').reset();
    document.querySelector('#tambahproduktabel form').reset();

  }


  _simpanproduk() {
    const data = this._datatable.data();
    data.each((row, index) => {
      this._onEditRowClick(this._datatable.row(index))
    });
  }

  _onEditRowClick(rowToEdit) {
    this._rowToEdit = rowToEdit;
    this._setForm();
  }

  _setForm() {
    const data = this._rowToEdit.data();
    const produk = {};
    produk.id_produk = data.id_produk;
    produk.harga = data.harga;
    produk.jumlah = data.jumlah;
    produk.subtotal = data.subtotal;
    produk.diskon = data.diskon;

    this._TestData.push(produk);
    // $.ajax({
    //   url: 'Transaksi',
    //   type: 'POST',
    //   data: {
    //     'produk': [
    //       {
    //         'id_produk': data.id_produk,
    //         'harga': data.harga,
    //         'jumlah': data.jumlah,
    //         'subtotal': data.subtotal
    //       }
    //     ],
    //   },
    //   success: function (response) {
    //     // $('#datatableR').DataTable().ajax.reload();
    //     console.log(response);
    //   },
    //   error: function (xhr, status, error) {
    //     console.log(xhr.responseText);
    //   }
    // })

  }
  _setFormCostumer() {
    const data_cs = {};
    data_cs.nama_cs = document.querySelector('#costumer input[name=nama_costumer]').value;
    data_cs.id_costumer = document.querySelector('#costumer input[name=id_costumer]').value;
    data_cs.bayar_cs = document.querySelector('#costumer input[name=bayar_costumer]').value;
    data_cs.id_cs = document.querySelector('#costumer input[name=id_cs]').value;
    data_cs.invoice = this._invoicenumber;
    return data_cs;
  }
  _inputmask() {
    if (document.querySelector(['#currency', '#subtotal', '#bayar_costumer'])) {
      new Inputmask.extendAliases({
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
      $(document).ready(function () {
        $(['#currency', '#subtotal', '#bayar_costumer']).inputmask({ alias: "rupiah" });
      });
    }
  }

  _Tanggal() {
    const now = new Date();
    const hari = now.getDate();
    const bulan = now.getMonth() + 1;
    const tahun = now.getFullYear();
    const tanggalELm = document.getElementById('tanggal');
    if (bulan < 10) {
      tanggalELm.innerText = `Tanggal : ${hari}/0${bulan}/${tahun}`;
    } else {
      tanggalELm.innerText = `Tanggal : ${hari}/${bulan}/${tahun}`;
    }
  }

  _onSingleSelect() {
    document.querySelectorAll('.edit-datatable').forEach((el) => el.classList.remove('disabled'));
  }

  // Multiple item select callback from DatatableExtend
  _onMultipleSelect() {
    document.querySelectorAll('.delete-datatable').forEach((el) => el.classList.add('disabled'));
  }

  // One or more item select callback from DatatableExtend
  _onAnySelect() {
    document.querySelectorAll('.delete-datatable').forEach((el) => el.classList.remove('disabled'));
    document.querySelectorAll('.tag-datatable').forEach((el) => el.classList.remove('disabled'));
  }

  // Deselect callback from DatatableExtend
  _onNoneSelect() {
    document.querySelectorAll('.delete-datatable').forEach((el) => el.classList.add('disabled'));
    document.querySelectorAll('.tag-datatable').forEach((el) => el.classList.add('disabled'));
  }

}


function _total() {
  const harga = document.querySelector('#tambahproduktabel input[name=harga]').value;
  const jumlah = document.getElementById('jumlah').value;
  const total = harga * jumlah;
  document.querySelector('#tambahproduktabel input[name=subtotal]').value = total;
}

$(document).ready(function () {
  $('#id_produk').on('change', function () {
    const selectedvalue = $(this).val();

    if (selectedvalue !== '') {

      $.ajax({
        url: '/Products/create',
        type: 'GET',
        dataType: 'json',
        data: { selectedvalue: selectedvalue },
        success: function (response) {
          $('#nama_produk').val(response.data.nama);
          $('#SKU_produk').val(response.data.SKU_produk);
          $('#diskon').on('change', function () {
            const selectedDiskon = $(this).val();

            if (selectedDiskon == 'Retail') {
              $('#currency').val(response.data.harga_produk);
            }
            if (selectedDiskon == '25%') {
              $('#currency').val(response.data.harga_25);
            }
            if (selectedDiskon == '35%') {
              $('#currency').val(response.data.harga_35);
            }
            if (selectedDiskon == '42%') {
              $('#currency').val(response.data.harga_42);
            }
            if (selectedDiskon == '50%') {
              $('#currency').val(response.data.harga_50);
            }
          });
        }
      });
    }
  });
});



