<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="contrainer mt-3">
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Data Pemesanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

    <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>

<table id="table-pemesanan" class="datatable table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kamar</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Pemesanan Status</th>
            <th>Tamu</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Pemesanan</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formPemesanan" method="post" action="<?=base_url('pemesanan')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label for="lblnama" class="form-label">Kamar</label>
                        <select name="kamar_id" class="form-control">
                            <option>Pilih Kamar</option>
                            <?php foreach($data_kamar as $k): ?>
                                <option value="<?=$k['id']?>"><?=$k['deskripsi']?></option>
                            <?php endforeach;?>    
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label for="lblnama" class="form-label">Pemesanan Status</label>
                        <select name="pemesananstatus_id" class="form-control">
                            <option>Pilih Pemesanan Status</option>
                            <?php foreach($data_pemesananstatus as $k): ?>
                                <option value="<?=$k['id']?>"><?=$k['status']?></option>
                            <?php endforeach;?>    
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lblnama" class="form-label">Tamu</label>
                        <select name="tamu_id" class="form-control">
                            <option>Pilih Tamu</option>
                            <?php foreach($data_tamu as $k): ?>
                                <option value="<?=$k['id']?>"><?=$k['nama_depan']?></option>
                            <?php endforeach;?>    
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="btn-kirim">Kirim</button>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection()?>

<?=$this->section('script')?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"></script>
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){
        $('select[name=kamar_id]').select2({
            width:'100%'
        });
        $('select[name=pemesananstatus_id]').select2({
            width:'100%'
        });
        $('select[name=tamu_id]').select2({
            width:'100%'
        });

        $('button#btn-kirim').on('click', function(){
            $('form#formPemesanan').submit();
        });

        $('table#table-pemesanan').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pemesanan/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=kamar_id]').val(e.kamar_id);
                $('input[name=tgl_mulai]').val(e.tgl_mulai);
                $('select[name=tgl_selesai]').val(e.tgl_selesai);
                $('input[name=pemesananstatus_id]').val(e.pemesananstatus_id);
                $('input[name=tamu_id]').val(e.tamu_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');
            });
        });

        
        $('table#table-pemesanan').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('Data pemesanan akan dihapus, mau dilanjutkan?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/pemesanan`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-pemesanan').DataTable().ajax.reload();
                });
            }
        }); 

        $('#formPemesanan').submitAjax({
            pre:()=>{

            },
            pasca:()=>{

            },
            success:(e,s)=>{

                $('table#table-pemesanan').DataTable().ajax.reload();
            },
            error:(x, s)=>{
                alert('Maaf, data pengguna gagal direkam');
            }
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formPemesanan').trigger('reset');
        });

        $('table#table-pemesanan').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pemesanan/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'deskripsi' },
                { data: 'tgl_mulai' },
                { data: 'tgl_selesai' },
                { data: 'status' },
                { data: 'nama_depan' },

                { data: 'id',
                render: (data, type, meta, row)=>{
                    var btnEdit = `<button class='btn btn-primary btn-edit' data-id='${data}'> Edit </button>`;
                    var btnHapus = `<button class='btn btn-danger btn-hapus' data-id='${data}'> Hapus </button>`;
                    return btnEdit + btnHapus;
                    
                } 
            }
            ]
        });
    });
</script>

<?=$this->endSection()?>