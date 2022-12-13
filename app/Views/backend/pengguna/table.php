<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="contrainer mt-3">
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Data Pengguna</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

    <button class="float-end btn-sm btn-primary" id="btn-tambah">Tambah</button>
    <table id='table-pelanggan' class="datatable table table-bordered">
         <thead>
            <tr>
                <th>No</th>
                <th>Nama Depan</th>
                <th>Nama belakang</th>
                <th>Gender</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Tanggal Lahir</th> 
                <th>Nomor hp</th>
                <th>Email</th>
                <th>Level</th> 
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<div id="modalForm" class="modal">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Form Pengguna Hotel</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form id="formPengguna" method="post" action="<?=base_url('pengguna')?>">
                <input type="hidden" name="id" />
                <input type="hidden" name="_method"/>
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
                    <label class="form-label">Nomor Telepon</label>
                    <input type="int" name="notelp" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor hp</label>
                    <input type="int" name="nohp" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Sandi</label>
                    <input type="password" name="sandi" class="form-control" />
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

            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" id='btn-kirim'>Kirim</button>
        </div>
    </div>
</div>
</div> 
<?=$this->endSection()?>

<?=$this->section('script')?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"
></script>
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
    $('form#formPengguna').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
        },
        pasca:()=>{
            $('button#btn-kirim').show();
        },
        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-pelanggan").DataTable().ajax.reload();
        },
        error:  (xhr, status)=>{
            alert('Maaf, data pengguna gagal direkam');
        }
    });

    $('button#btn-kirim').on('click', function(){
        $('form#formPengguna').submit();
    });

    $('button#btn-tambah').on('click', function(){
        $('#modalForm').modal('show');
        $('form#formPengguna').trigger('reset');
        $('input[name=_method]').val('');
    });

    $('table#table-pelanggan').on('click', '.btn-edit', function(){
        let id = $(this).data('id');

        let baseurl = "<?=base_url()?>";
        $.get(`${baseurl}/pengguna/${id}`).done((e)=>{
            $('input[name=id]').val(e.id);
            $('input[name=nama_depan]').val(e.nama_depan);
            $('input[name=nama_belakang]').val(e.nama_belakang);
            $('input[name=gender]').val(e.gender);
            $('input[name=alamat]').val(e.alamat);
            $('input[name=kota]').val(e.kota);
            $('input[name=tgl_lhr]').val(e.tgl_lhr);
            $('input[name=notelp]').val(e.notelp);
            $('input[name=nohp]').val(e.nohp);
            $('input[name=email]').val(e.email);
            $('input[name=level]').val(e.level);
            $('#modalForm').modal('show');
            $('input[name=_method]').val('patch');
        });
    });

    $('table#table-pelanggan').on('click', '.btn-hapus', function(){
        let konfirmasi = confirm('Data pengguna akan dihapus, mau dilanjutkan?');

        if(konfirmasi === true){
            let _id = $(this).data('id');
            let baseurl = "<?=base_url()?>";

            $.post(`${baseurl}/pengguna`, {id:_id, _method:'delete'}).done(function(e){
                $('table#table-pelanggan').DataTable().ajax.reload();
            });
        }
    });

    $('table#table-pelanggan').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "<?=base_url('pengguna/all')?>",
            method: 'GET'
        },
        columns: [
            { data: 'id', sortable:false, searchable:false, 
              render: (data,type,row,meta)=>{
                return meta.settings._iDisplayStart + meta.row + 1;
              }
            },
            // {data: 'id'},
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
            { data: 'id', 
              render: (data, type, meta, row)=>{
                var btnEdit  = `<button class='btn-edit btn btn-primary' data-id='${data}'> Edit </button>`;
                var btnHapus = `<button class='btn-hapus btn btn-danger' data-id='${data}'> Hapus </button>`;
                return btnEdit + btnHapus;
              }
            }
        ]
    });
});
</script>
<?=$this->endSection()?>