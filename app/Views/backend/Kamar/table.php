<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="contrainer mt-3">
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Data Kamar</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

    <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
<table id="table-kamar" class="datatable table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kamar Tipe</th>
            <th>Lantai</th>
            <th>Nomor</th>
            <th>Kamar Status</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Kamar</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formKamar" method="post" action="<?=base_url('kamar')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label for="lblnama" class="form-label">Kamar Tipe</label>
                        <select name="kamartipe_id" class="form-control">
                            <option>Pilih Kamar Tipe</option>
                            <?php foreach($data_kamartipe as $k): ?>
                                <option value="<?=$k['id']?>"><?=$k['tipe']?></option>
                            <?php endforeach;?>    
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lantai</label>
                        <input type="text" name="lantai" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor</label>
                        <input type="text" name="nomor" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label for="lblnama" class="form-label">Kamar Status</label>
                        <select name="kamarstatus_id" class="form-control">
                            <option>Pilih Kamar Status</option>
                            <?php foreach($data_kamarstatus as $k): ?>
                                <option value="<?=$k['id']?>"><?=$k['status']?></option>
                            <?php endforeach;?>    
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control"/>
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

<script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"></script>
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){
        $('select[name=kamartipe_id]').select2({
            width:'100%'
        });
        $('select[name=kamarstatus_id]').select2({
            width:'100%'
        });

        $('button#btn-kirim').on('click', function(){
            $('form#formKamar').submit();
        });

        $('table#table-kamar').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/kamar/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=kamartipe_id]').val(e.kamartipe_id);
                $('input[name=lantai]').val(e.lantai);
                $('select[name=nomor]').val(e.nomor);
                $('input[name=kamarstatus_id]').val(e.kamarstatus_id);
                $('input[name=deskripsi]').val(e.deskripsi);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');


            });
        });

        
        $('table#table-kamar').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('Data kamar akan dihapus, mau dilanjutkan?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/kamar`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-kamar').DataTable().ajax.reload();
                });
            }
        }); 

        $('#formKamar').submitAjax({
            pre:()=>{

            },
            pasca:()=>{

            },
            success:(e,s)=>{

                $('table#table-kamar').DataTable().ajax.reload();
            },
            error:(x, s)=>{
                alert('gagal simpan');
            }
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formKamar').trigger('reset');
        });

        $('table#table-kamar').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('kamar/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'tipe' },
                { data: 'lantai' },
                { data: 'nomor' },
                { data: 'status' },
                { data: 'deskripsi' },

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