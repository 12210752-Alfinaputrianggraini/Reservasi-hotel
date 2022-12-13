<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="contrainer mt-3">
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Data Pembayaran</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

    <button class="float-end btn-sm btn-primary" id="btn-tambah">Tambah</button>
    <table id="table-pembayaran" class="datatable table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>tanggal</th>
            <th>tagihan</th>
            <th>dibayar</th>
            <th>nama pembayar</th>
            <th>metode bayar</th>
            <th>pengguna</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<div id="modalForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form pembayaran</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formPembayaran" method="post" action="<?=base_url('pembayaran')?>">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="_method" />

                    <div class="mb-3">
                        <label class="form-label">tanggal</label>
                        <input type="date" name="tgl" class="form-control"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">tagihan</label>
                        <input type="text" name="tagihan" class="form-control"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">dibayar</label>
                        <input type="text" name="dibayar" class="form-control"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">nama pembayar</label>
                        <input type="text" name="nama_pembayar" class="form-control"/>
                    </div>

                    <div class="mb-3">
                        <label for="lblnama" class="form-label">metode bayar</label>
                        <select name="metodebayar_id" class="form-control">
                            <option>metode bayar</option>
                            <?php foreach($data_metodebayar as $k): ?>
                                <option value="<?=$k['id']?>"><?=$k['metode']?></option>
                            <?php endforeach;?>    
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="lblnama" class="form-label">pengguna</label>
                        <select name="pengguna_id" class="form-control">
                            <option>Pilih pengguna</option>
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
        $('select[name=metodebayar_id]').select2({
            width:'100%'
        });
        $('select[name=pengguna_id]').select2({
            width:'100%'
        });

        $('button#btn-kirim').on('click', function(){
            $('form#formPembayaran').submit();
        });

        $('table#table-pembayaran').on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            let baseurl = "<?=base_url()?>";
            $.get(`${baseurl}/pembayaran/${id}`).done((e)=>{
                $('input[name=id]').val(e.id);
                $('input[name=tgl]').val(e.tgl);
                $('input[name=tagihan]').val(e.tagihan);
                $('select[name=dibayar]').val(e.diabayar);
                $('select[name=nama_pembayar]').val(e.nama_pembayar);
                $('input[name=metodebayar_id]').val(e.metodebayar_id);
                $('input[name=pengguna_id]').val(e.pengguna_id);
                $('#modalForm').modal('show');
                $('input[name=_method]').val('patch');


            });
        });

        
        $('table#table-pembayaran').on('click', '.btn-hapus', function(){
            let konfirmasi = confirm ('Data pembayaran akan dihapus, mau dilanjutkan?');
            if(konfirmasi === true){
                let _id = $(this).data('id');
                let baseurl = "<?=base_url()?>";

                $.post(`${baseurl}/pembayaran`, {id:_id, _method:'delete'}).done(function(e){
                    $('table#table-pembayaran').DataTable().ajax.reload();
                });
            }
        }); 

        $('form#formPembayaran').submitAjax({
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

        $('button#btn-tambah').on('click', function(){
            $('#modalForm').modal('show');
            $('form#formPembayaran').trigger('reset');
        });

        $('table#table-pembayaran').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "<?=base_url('pembayaran/all')?>",
                method: 'GET'
            },
            columns: [
                { data: 'id', sortable:false, seacrhable:false, render: (data,type,row,meta)=>{
                    return meta.settings._iDisplayStart + meta.row + 1;
                } 
            },
                { data: 'tgl' },
                { data: 'tagihan' },
                { data: 'dibayar' },
                { data: 'nama_pembayar' },
                { data: 'metodebayar_id' },
                { data: 'pengguna_id' },

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