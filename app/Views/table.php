<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
rel="stylesheet"  crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
        rossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"
></script>
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<div class="container">
<button class="float-end btn-sm btn-primary" id="btn-tambah">Tambah</button>

<table id='table-pelanggan' class="datatable table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>nama_depan</th>
            <th>nama_belakang</th>
            <th>gender</th>
            <th>alamat</th>
            <th>kota</th>
            <th>tgl_lhr</th>
            <th>notelp</th>
            <th>nohp</th>
            <th>email</th>
            <th>level</th>
            <th>foto</th>
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
            <h5 class="modal-title">From Pelanggan Hotel</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <from id="formPengguna" method="post" action="<?=base_url('pengguna')?>">
                <input type="hidden" name="id" />
                <div class="mb-3">
                    <label class="form-label">Nama Depan</label>
                    <input type="text" name="nama_depan" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Belakang</label>
                    <input type="text" name="nama_belakang" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="gender" class="form-control">
                        <option>Pilih Jenis Kelamin</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
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
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lhr" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Telpon</label>
                    <input type="int" name="no_telp" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input type="int" name="nohp" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Level</label>
                    <select name="level" class="form-control">
                        <option>Pilih Level</option>
                        <option value="M">Manager</option>
                        <option value="A">Administrasi</option>
                        <option value="R">Resepsionis</option>
                        <option value="B">Room Boy</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="text" name="foto" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Sandi</label>
                    <input type="password" name="sandi" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Token Reset</label>
                    <input type="text" name="token_reset" class="form-control" />
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
$(document)-ready(function(){
    $('formPengguna').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
        },
        pasca:()=>{
            $('button#-kirim').show();
        },
        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-pelanggan").DataTable().ajax.reload();
        },
        error:  (xhr, status)=>{
            alert('Maaf, data pengguna gagal direkam');
        }
    })
    $('button#btn-kirim').on('click', function(){
        $('form#formPengguna').submit();
    })
    $('button#btn-tambah').on('click', function(){
        $('#modalForm').modal('show');
        $('form#formPengguna').trigger('reset');
    });

    $('table#table-pelanggan').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "<?=base_url('pengguna/all')?>",
            method: 'GET'
        },
        colums: [
            { data: 'id', sortable:false, searchable:false, 
              render: (data,type,row,meta)=>{
                return meta.settings._iDisplayStart + 1;
              }
            },
            { data: 'nama_depan' },
            { data: 'nama_belakang' },
            { data: 'gender', 
              render: (data, type, meta, row)=>{
                if( data === 'L' ){
                    return 'Laki-Laki';
                }else if( data === 'P' ){
                    return 'Perempuan';
                }
                return data;
              }
            },
            { data: 'alamat' },
            { data: 'kota' },
            { data: 'tgl_lhr' },
            { data: 'no_telp' },
            { data: 'nohp' },
            { data: 'email' },
            { data: 'level', 
              render: (data, type, meta, row)=>{
                if( data === 'M' ){
                    return 'Manager';
                }else if( data === 'A' ){
                    return 'Administrasi';
                }else if( data === 'R' ){
                    return 'Resepsionis';
                }else if( data === 'B' ){
                    return 'Room Boy';
                }
                return data;
              }
            },
            { data: 'foto' },
            { data: 'sandi' },
            { data: 'token_reset' },
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