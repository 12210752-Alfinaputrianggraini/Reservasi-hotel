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

<table id='table-tamu' class="datatable table table-bordered">
    <thead>
        <tr>
            <th>nama_depan</th>
            <th>nama_belakang</th>
            <th>gender</th>
            <th>alamat</th>
            <th>kota</th>
            <th>negara</th>
            <th>nohp</th>
            <th>email</th>
            <th>sandi</th>
            <th>token_reset</th>
            <th>aksi</th>
        </tr>
    </thead>
</table>
</div>

<div id="modalForm" class="modal">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">From Tamu Hotel</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <from id="formtipetarif" method="post" action="<?=base_url('tamu')?>">
                <input type="hidden" name="id" />
                <input type="hidden" name="_method"/>
                <div class="mb-3">
                    <label class="form-label">Nama Depan</label>
                    <input type="text" name="nama_depan" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Belakng</label>
                    <input type="text" name="nama_belakang" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <input type="text" name="gender" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Kota</label>
                    <input type="text" name="kota" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Negara</label>
                    <input type="text" name="negara" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">No Hp</label>
                    <input type="text" name="nohp" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" />
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
    $('form#formtamu').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
        },
        pasca:()=>{
            $('button#btn-kirim').show();
        },
        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-tamu").DataTable().ajax.reload();
        },
        error:  (xhr, status)=>{
            alert('Maaf, data pengguna gagal direkam');
        }
    })
    $('button#btn-kirim').on('click', function(){
        $('form#formtamu').submit();
    });
    $('button#btn-tambah').on('click', function(){
        $('#modalForm').modal('show');
        $('form#formtamu').trigger('reset');
        $('input[name=_method').val('');
    });

    $('table#table-tamu').on('click', 'btn-edit', function(){
        let id = $(this).data('id');
        let baseurl = "<?=base_url()?>";
        $.get(`${baseurl}tipetarif/${id}`).done((e)=>{
            $('input[name=id]').val(e.id);
            $('input[name=nama_depan]').val(e.nama_depan);
            $('input[name=nama_belakang]').val(e.nama_belakang);
            $('input[name=gender]').val(e.gender);
            $('input[name=alamat]').val(e.alamat);
            $('input[name=kota]').val(e.kota);
            $('input[name=negara]').val(e.negara);
            $('input[name=nohp]').val(e.nohp);
            $('input[name=email]').val(e.email);
        });
    });

    $('table#table-tamu').on('click', '.btn-hapus', function(){
        let konfirmasi = confirm('Data pelanggan akan dihapus, mau dilanjutkan?');

        if(konfirmasi === true){
            let _id = $(this).data('id');
            let baseurl = "<?=base_url()?>";

            $.post(`${baseurl}/tamu`, {id:_id, _method:'delete'}).done(function(e){
                $('table#table-tamu').DataTable().ajax.reload();
            });
        }
    });

    $('table#table-tamu').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "<?=base_url('tamu/all')?>",
            method: 'GET'
        },
        columns: [
            { data: 'id', sortable:false, searchable:false, 
              render: (data,type,row,meta)=>{
                return meta.settings._iDisplayStart + 1;
              }
            },
            // {data: 'id'},
            { data: 'nama_depan' },
            { data: 'nama_belakang' },
            { data: 'gender' },
            { data: 'alamat' },
            { data: 'kota' },
            { data: 'negara' },
            { data: 'nohp' },
            { data: 'email' },
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