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
            <th>kamar_id</th>
            <th>tgl_mulai</th>
            <th>tgl_selesai</th>
            <th>pemesananstatus_id</th>
            <th>tamu_id</th>
        </tr>
    </thead>
</table>
</div>

<div id="modalForm" class="modal">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">From Pemesanan</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <from id="formtipetarif" method="post" action="<?=base_url('tamu')?>">
                <input type="hidden" name="id" />
                <input type="hidden" name="_method"/>
                <div class="mb-3">
                    <label class="form-label">Kamar id</label>
                    <input type="text" name="kamar_id" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="text" name="tgl_selesai" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="text" name="tgl_selesai" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Pemesanan Status</label>
                    <input type="text" name="pemesananstatus" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Tamu id</label>
                    <input type="text" name="tamu_id" class="form-control" />
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
    $('form#formpemesanan').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
        },
        pasca:()=>{
            $('button#btn-kirim').show();
        },
        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-pemesanan").DataTable().ajax.reload();
        },
        error:  (xhr, status)=>{
            alert('Maaf, data pengguna gagal direkam');
        }
    })
    $('button#btn-kirim').on('click', function(){
        $('form#formpemesanan').submit();
    });
    $('button#btn-tambah').on('click', function(){
        $('#modalForm').modal('show');
        $('form#formpemesanan').trigger('reset');
        $('input[name=_method').val('');
    });

    $('table#table-pemesanan').on('click', 'btn-edit', function(){
        let id = $(this).data('id');
        let baseurl = "<?=base_url()?>";
        $.get(`${baseurl}tipetarif/${id}`).done((e)=>{
            $('input[name=kamar_id]').val(e.kamar_id);
            $('input[name=tgl_mulai]').val(e.tgl_mulai);
            $('input[name=tgl_selesai]').val(e.tgl_selesai);
            $('input[name=pemesananstatus]').val(e.pemesananstatus);
            $('input[name=tamu_id]').val(e.tamu_id);
        });
    });

    $('table#table-pemesanan').on('click', '.btn-hapus', function(){
        let konfirmasi = confirm('Data pelanggan akan dihapus, mau dilanjutkan?');

        if(konfirmasi === true){
            let _id = $(this).data('id');
            let baseurl = "<?=base_url()?>";

            $.post(`${baseurl}/pemesanan`, {id:_id, _method:'delete'}).done(function(e){
                $('table#table-pemsanan').DataTable().ajax.reload();
            });
        }
    });

    $('table#table-pemesanan').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "<?=base_url('pemesanan/all')?>",
            method: 'GET'
        },
        columns: [
            { data: 'id', sortable:false, searchable:false, 
              render: (data,type,row,meta)=>{
                return meta.settings._iDisplayStart + 1;
              }
            },
            // {data: 'id'},
            { data: 'kamar_id' },
            { data: 'tgl_mulai' },
            { data: 'tgl_selesai' },
            { data: 'pemesananstatus_id' },
            { data: 'tamu_id' },
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