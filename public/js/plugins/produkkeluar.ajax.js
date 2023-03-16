/**
 *
 * RowsAjax
 *
 * Interface.Plugins.Datatables.RowsAjax page content scripts. Initialized from scripts.js file.
 *
 *
 */
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
class RowsAjax {
  constructor() {
    if (!jQuery().DataTable) {
      console.log('DataTable is null!');
      return;
    }

    // Selected single row which will be edited
    this._rowToEdit;

    // Datatable instance
    this._datatable;

    // Edit or add state of the modal
    this._currentState;

    // Controls and select helper
    this._datatableExtend;

    // Add or edit modal
    this._addEditModal;

    // Datatable single item height
    this._staticHeight = 62;


    this._createInstance();
    this._addListeners();
    this._extend();
    this._initBootstrapModal();
    this._dropzoneimage();
    this._inputmask();
  }

  // Creating datatable instance. Table data is provided by json/products.json file and loaded via ajax
  _createInstance() {
    const _this = this;
    this._datatable = jQuery('#datatableRowsAjax').DataTable({
      scrollX: true,
      buttons: ['copy', 'excel', 'csv', 'print'],
      info: false,
      ajax: 'http://127.0.0.1:8000/Transaksi',
      order: [0, 'desc'], // Clearing default order
      sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>', // Hiding all other dom elements except table and pagination
      pageLength: 10,
      columns: [
        { data: 'created_at' },
        { data: 'produk.SKU_produk' },
        { data: 'produk.nama' },
        { data: 'diskon' },
        { data: 'jumlah_item' },
        { data: 'subtotal_harga' },
        { data: 'transaksi.nomor_invoice' }
      ],
      language: {
        paginate: {
          previous: '<i class="cs-chevron-left"></i>',
          next: '<i class="cs-chevron-right"></i>',
        },
      },
      initComplete: function (settings, json) {
        _this._setInlineHeight();
      },
      drawCallback: function (settings) {
        _this._setInlineHeight();
      },
      columnDefs: [
        // Adding Name content as an anchor with a target #
        {
          targets: [2],
          render: function (data, type, row, meta) {
            return '<a class="list-item-heading body" href="#">' + data + '</a>';
          },
        },
        {
          targets: 5,
          render: $.fn.dataTable.render.number('.', ',', 0, 'Rp '),
        },

      ],
    });
  }

  _addListeners() {
    // Listener for confirm button on the edit/add modal
    // document.getElementById('addEditConfirmButton').addEventListener('click', this._addEditFromModalClick.bind(this));
    document.getElementById('addEditConfirmButton').addEventListener('click', this._addEditFromModalClick.bind(this));

    // Listener for add buttons
    document.querySelectorAll('.add-datatable').forEach((el) => el.addEventListener('click', this._onAddRowClick.bind(this)));

    // Listener for delete buttons
    document.querySelectorAll('.delete-datatable').forEach((el) => el.addEventListener('click', this._onDeleteClick.bind(this)));

    // Listener for edit button
    document.querySelectorAll('.edit-datatable').forEach((el) => el.addEventListener('click', this._onEditButtonClick.bind(this)));

    // Calling a function to update tags on click
    document.querySelectorAll('.tag-done').forEach((el) => el.addEventListener('click', () => this._updateTag('Done')));
    document.querySelectorAll('.tag-new').forEach((el) => el.addEventListener('click', () => this._updateTag('New')));
    document.querySelectorAll('.tag-sale').forEach((el) => el.addEventListener('click', () => this._updateTag('Sale')));

    // Calling clear form when modal is closed
    document.getElementById('addEditModal').addEventListener('hidden.bs.modal', this._clearModalForm);
  }

  // Extending with DatatableExtend to get search, select and export working
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

  // Keeping a reference to add/edit modal
  _initBootstrapModal() {
    this._addEditModal = new bootstrap.Modal(document.getElementById('addEditModal'));
  }

  // Setting static height to datatable to prevent pagination movement when list is not full
  _setInlineHeight() {
    if (!this._datatable) {
      return;
    }
    const pageLength = this._datatable.page.len();
    document.querySelector('.dataTables_scrollBody').style.height = this._staticHeight * pageLength + 'px';
  }

  // Add or edit button inside the modal click
  _addEditFromModalClick(event) {
    if (this._currentState === 'add') {
      this._addNewRowFromModal();
    } else {
      this._editRowFromModal();
    }
    this._addEditModal.hide();
  }

  // Top side edit icon click
  _onEditButtonClick(event) {
    if (event.currentTarget.classList.contains('disabled')) {
      return;
    }
    const selected = this._datatableExtend.getSelectedRows();
    this._onEditRowClick(this._datatable.row(selected[0][0]));
  }

  // Direct click from row title
  _onEditRowClick(rowToEdit) {
    this._rowToEdit = rowToEdit; // Passed from DatatableExtend via callback from settings
    this._showModal('edit', 'Edit', 'Done');
    this._setForm();
  }

  // Edit button inside th modal click
  _editRowFromModal() {
    const data = this._rowToEdit.data();
    const formData = Object.assign(data, this._getFormData());
    this._datatable.row(this._rowToEdit).data(formData).draw();
    this._datatableExtend.unCheckAllRows();
    this._datatableExtend.controlCheckAll();
  }

  // Add button inside th modal click
  _addNewRowFromModal() {
    // const data = this._getFormData();
    // this._datatable.row.add(data).draw();
    // this._datatableExtend.unCheckAllRows();
    // this._datatableExtend.controlCheckAll();
    $.ajax({
      url: 'Table',
      type: 'POST',
      data: this._getFormData(),
      success: function (response) {
        $('#datatableRowsAjax').DataTable().ajax.reload();
        // console.log(response);
      }
    })
  }

  _dropzoneimage() {
    if (document.querySelector('#dropzoneImage')) {
      new Dropzone('#dropzoneImage', {
        url: '/TablePost',
        addRemoveLinks: true,
        init: function () {
          this.on('success', function (file, responseText) {
            console.log(responseText);
          });
        },
        acceptedFiles: 'image/*',
        thumbnailWidth: 160,
        previewTemplate: DropzoneTemplates.previewTemplate,
      });
    }
  }

  _inputmask() {
    if (document.querySelector('#currency')) {
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
        $('#currency').inputmask({ alias: "rupiah" });
      });
    }
  }

  // Delete icon click
  _onDeleteClick() {
    const selected = this._datatableExtend.getSelectedRows();
    selected.remove().draw();
    this._datatableExtend.controlCheckAll();
  }

  // + Add New or just + button from top side click
  _onAddRowClick() {
    this._showModal('add', 'Add Product', 'Add');
  }

  // Showing modal for an objective, add or edit
  _showModal(objective, title, button) {
    this._addEditModal.show();
    this._currentState = objective;
    document.getElementById('modalTitle').innerHTML = title;
    document.getElementById('addEditConfirmButton').innerHTML = button;
  }

  // Filling the modal form data
  _setForm() {
    const data = this._rowToEdit.data();
    document.querySelector('#addEditModal input[name=Nama]').value = data.nama;
    document.querySelector('#addEditModal input[name=Stock]').value = data.stock;
    document.querySelector('#addEditModal input[name=VP]').value = data.vp;
    document.querySelector('#addEditModal input[name=Harga_p]').value = data.harga_produk;
    document.querySelector('#addEditModal input[name=SKU_p]').value = data.SKU_produk;
    document.querySelector('#addEditModal textarea[name=Deskripsi_p]').value = data.deskripsi;
  }

  // Getting form values from the fields to pass to datatable
  _getFormData() {
    const data = {};
    data.nama = document.querySelector('#addEditModal input[name=Nama]').value;
    data.stock = document.querySelector('#addEditModal input[name=Stock]').value;
    data.vp = document.querySelector('#addEditModal input[name=VP]').value;
    data.harga_produk = document.querySelector('#addEditModal input[name=Harga_p]').value;
    data.SKU_produk = document.querySelector('#addEditModal input[name=SKU_p]').value;
    data.deskripsi = document.querySelector('#addEditModal textarea[name=Deskripsi_p]').value;
    // data.img_produk = document.querySelector('#addEditModal input[name=img_produk]').value;
    // data.append('img_produk', document.querySelector('#addEditModal input[name=img_produk]').files[0]);
    // data.Category = document.querySelector('#addEditModal input[name=Category]:checked')
    //   ? document.querySelector('#addEditModal input[name=Category]:checked').value || ''
    //   : '';
    // data.Tag = document.querySelector('#addEditModal input[name=Tag]:checked')
    //   ? document.querySelector('#addEditModal input[name=Tag]:checked').value || ''
    //   : '';
    // data.Check = '';
    return data;

  }



  // Clearing modal form
  _clearModalForm() {
    document.querySelector('#addEditModal form').reset();
  }

  // Update tag from top side dropdown
  _updateTag(tag) {
    const selected = this._datatableExtend.getSelectedRows();
    const _this = this;
    selected.every(function (rowIdx, tableLoop, rowLoop) {
      const data = this.data();
      data.Tag = tag;
      _this._datatable.row(this).data(data).draw();
    });
    this._datatableExtend.unCheckAllRows();
    this._datatableExtend.controlCheckAll();
  }

  // Single item select callback from DatatableExtend
  _onSingleSelect() {
    document.querySelectorAll('.edit-datatable').forEach((el) => el.classList.remove('disabled'));
  }

  // Multiple item select callback from DatatableExtend
  _onMultipleSelect() {
    document.querySelectorAll('.edit-datatable').forEach((el) => el.classList.add('disabled'));
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