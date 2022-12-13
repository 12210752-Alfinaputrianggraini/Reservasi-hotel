<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="contrainer mt-3">
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Data Kamar Tarif</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

    <button class="float-end btn-sm btn-primary" id="btn-tambah">Tambah</button>
<table id="table-kamartarif" class="datatable table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kamar Tipe</th>
            <th>Tarif</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Tipe Tarif</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Kamar Tarif</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formKamartarif" method="post" action="<?=base_url('kamartarif')?>">
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
                        <label class="form-label">Tarif</label>
                        <input type="text" name="tarif" class="form-control"/>
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
                        <label for="lblnama" class="form-label">Tipe Tarif</label>
                        <select name="tipetarif_id" class="form-control">
                            <option>Pilih Tipe Tarif</option>
                            <?php foreach($data_tipetarif as $k): ?>
                                <option value="<?=$k['id']?>"><?=$k['tipe']?></option>
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
        $('select[name=kamartipe_id]').select2({
            width:'100%'
        });
        $('select[name=tipetarif_id]').select2({
            width:'100%'
        });

        $('button#btn-kirim').on('click', function(){
            $('form#formKamartarif').submit();
        });

        $('table#table-kamartarif').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/kamartarif/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=kamartipe_id]').val(e.kamartipe_id);
                $('input[name=tarif]').val(e.tarif);
                $('select[name=tgl_mulai]').val(e.tgl_mulai);
                $('input[name=tgl_selesai]').val(e.tgl_selesai);
                $('input[name=tipetarif_id]').val(e.tipetarif_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');


            });
        });

        
        $('table#table-kamartarif').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('Data kamartarif akan dihapus, mau dilanjutkan?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/kamartarif`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-kamartarif').DataTable().ajax.reload();
                });
            }
        }); 

        $('#formKamartarif').submitAjax({
            pre:()=>{
                $('button#btn-kirim').hide();
            },
            pasca:()=>{
                $('button#btn-kirim').show();
            },
            success:(response,status)=>{
                $("#modalForm").modal('hide');
                $('table#table-kamartarif').DataTable().ajax.reload();
            },
            error:(x, s)=>{
                alert('gagal simpan');
            }
        });

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formKamartarif').trigger('reset');
            $('input[name=_method]').val('');
        });

        $('table#table-kamartarif').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('kamartarif/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, searchable:false,
                  render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                  }
                },
                { data: 'tipe' },
                { data: 'tarif' },
                { data: 'tgl_mulai' },
                { data: 'tgl_selesai' },
                { data: 'tipetarif' },

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