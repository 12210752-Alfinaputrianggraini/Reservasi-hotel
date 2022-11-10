<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
        crossorigin="anomymouse"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"
    ></script>
<link href="cdn.datatable.net/1.12.1/css/jquery.dataTable.min.css" rel="styleseet">
<script src="//cdn.datatable.net/1.12.1/js./jquery.dataTable.min.js"></script>

<div class="container">
<button class="float-end btn-sm btn-primary" id="btn-tambah">Tambah</button>

<table id='table-pemesanan' class="datatable table table-bordered">
    <thead>
        <tr>
            <th>tgl</th>
            <th>tagihan</th>
            <th>dibayar</th>
            <th>nama_pembayar</th>
            <th>metodebayar_id</th>
            <th>pengguna_id</th>
        </tr>
    </thead>
</table>
</div>

<div id="modalForm" class="modal">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">From Pembayaran</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <from id="formpembayaran" method="post" action="<?=base_url('tamu')?>">
                <input type="hidden" name="id" />
                <input type="hidden" name="_method"/>
                <div class="mb-3">
                    <label class="form-label"></label>
                    <input type="text" name="pemesanan" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="text" name="tgl" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Tangihan</label>
                    <input type="text" name="tagihan" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Dibayar</label>
                    <input type="text" name="dibayar" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Pembayar</label>
                    <input type="text" name="nama_pembayar" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Metode Bayar</label>
                    <input type="text" name="metodebayar_id" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Pengguna id</label>
                    <input type="text" name="pengguna_id" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Aktif</label>
                    <select name="gender" class="form-control">
                        <option>Pilih Aktif</option>
                        <option value="Y">Ya</option>
                        <option value="T">Tidak</option>
                    </select>
                </div>
            </from>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" id='btn-kirim'>Kirim</button>
        </div>
    </div>
</div>
</div>

<script>
$(document).ready(function(){
    $('form#formpembayaran').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
        },
        pasca:()=>{
            $('button#btn-kirim').show();
        },
        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-pembayaran").DataTable().ajax.reload();
        },
        error:  (xhr, status)=>{
            alert('Maaf, data pengguna gagal direkam');
        }
    })
    $('button#btn-kirim').on('click', function(){
        $('form#formpembayaran').submit();
    });
    $('button#btn-tambah').on('click', function(){
        $('#modalForm').modal('show');
        $('form#formpembayarann').trigger('reset');
        $('input[name=_method').val('');
    });

    $('table#table-pembayaran').on('click', 'btn-edit', function(){
        let id = $(this).data('id');
        let baseurl = "<?=base_url()?>";
        $.get(`${baseurl}pembayaran/${id}`).done((e)=>{
            $('input[name=tgl]').val(e.kamar_id);
            $('input[name=tagihan]').val(e.tagihan);
            $('input[name=dibayar]').val(e.dibayar);
            $('input[name=nama_pembayar]').val(e.nama_pembayar);
            $('input[name=metodebayar_id]').val(e.metodebayar_id);
            $('input[name=pegguna_id]').val(e.pengguna_id);
        });
    });

    $('table#table-pembayaran').on('click', '.btn-hapus', function(){
        let konfirmasi = confirm('Data pelanggan akan dihapus, mau dilanjutkan?');

        if(konfirmasi === true){
            let _id = $(this).data('id');
            let baseurl = "<?=base_url()?>";

            $.post(`${baseurl}/pembayaran`, {id:_id, _method:'delete'}).done(function(e){
                $('table#table-pembayaran').DataTable().ajax.reload();
            });
        }
    });

    $('table#table-pembayaran').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "<?=base_url('pembayaran/all')?>",
            method: 'GET'
        },
        columns: [
            { data: 'id', sortable:false, searchable:false, 
              render: (data,type,row,meta)=>{
                return meta.settings._iDisplayStart + 1;
              }
            },
            // {data: 'id'},
            { data: 'tgl' },
            { data: 'tagihan' },
            { data: 'dibayar' },
            { data: 'nama_pembayar' },
            { data: 'metodebayar_id' },
            { data: 'pengguna_id' },
            { data: 'id', 
              render: (data, type, meta, row)=>{
                var  btnEdit = `<button class='btn-edit' data-id='${data}'> Edit </button>`;
                var  btnHapus = `<button class='btn-hapus' data-id='${data}'> Hapus </button>`;
                return btnEdit + btnHapus;
              }
            }
        ]
    });
});
</script>