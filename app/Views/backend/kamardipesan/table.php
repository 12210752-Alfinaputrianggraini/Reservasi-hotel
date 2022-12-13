<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="contrainer mt-3">
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Data Kamar Dipesan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

    <button class="float-end btn btn-sm btn-primary" id="btn-tambah">Tambah</button>
    <table id="table-kamardipesan" class="datatable table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pemesanan</th>
            <th>Kamar</th>
            <th>Tarif</th>
            <th>Pengguna</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Kamar Di Pesan</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formKamardipesan" method="post" action="<?=base_url('kamardipesan')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />
                    <div class="mb-3">
                        <label for="lblnama" class="form-label">Pemesanan</label>
                        <select name="pemesanan_id" class="form-control">
                            <option>Pilih Pemesanan</option>
                            <?php foreach($data_pemesanan as $k): ?>
                                <option value="<?=$k['id']?>"><?=$k['id']?></option>
                            <?php endforeach;?>    
                        </select>
                    </div>
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
                        <label class="form-label">Tarif</label>
                        <input type="text" name="tarif" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label for="lblnama" class="form-label">Pengguna</label>
                        <select name="pengguna_id" class="form-control">
                            <option>Pilih Pengguna</option>
                            <?php foreach($data_pengguna as $k): ?>
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

<script src="https://cdn.jsdelivr.net/gh/agoenxz2186/submitAjax@develop/submit_ajax.js"></script>
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){
        $('select[name=pemesanan_id]').select2({
            width:'100%'
        });
        $('select[name=kamar_id]').select2({
            width:'100%'
        });
        $('select[name=pengguna_id]').select2({
            width:'100%'
        });

        $('button#btn-kirim').on('click', function(){
            $('form#formKamardipesan').submit();
        });

        $('table#table-kamardipesan').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/kamardipesan/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=pemesanan_id]').val(e.pemesanan_id);
                $('input[name=kamar_id]').val(e.kamar_id);
                $('select[name=tarif]').val(e.tarif);
                $('input[name=pengguna_id]').val(e.pengguna_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');


            });
        });

        
        $('table#table-kamardipesan').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('Data kamardipesan akan dihapus, mau dilanjutkan?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/kamardipesan`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-kamardipesan').DataTable().ajax.reload();
                });
            }
        }); 

        $('#formKamardipesan').submitAjax({
            pre:()=>{

            },
            pasca:()=>{

            },
            success:(e,s)=>{

                $('table#table-kamardipesan').DataTable().ajax.reload();
            },
            error:(x, s)=>{
                alert('gagal simpan');
            }
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formKamardipesan').trigger('reset');
        });

        $('table#table-kamardipesan').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('kamardipesan/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'pemesanan_id' },
                { data: 'deskripsi' },
                { data: 'tarif' },
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