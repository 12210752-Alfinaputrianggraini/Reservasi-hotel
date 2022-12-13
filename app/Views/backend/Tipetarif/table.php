<?=$this->extend('backend/template')?>

<?=$this->section('content')?>

<div class="contrainer mt-3">
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Table Tipe Tarif</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

    <button class="float-end btn-sm btn-primary" id="btn-tambah">Tambah</button>
    <table id='table-tipetarif' class="datatable table table-bordered">
         <thead>
             <tr>
                <th>No</th>
                <th>Tipe</th>
                <th>Keterangan</th>
                <th>Urutan</th>
                <th>Aktif</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<div id="modalForm" class="modal">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Form Tipe Tarif Hotel</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form id="formTipetarif" method="post" action="<?=base_url('tipetarif')?>">
                <input type="hidden" name="id" />
                <input type="hidden" name="_method"/>
                <div class="mb-3">
                    <label class="form-label">Tipe Tarif</label>
                    <input type="text" name="tipe" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">urutan</label>
                    <input type="int" name="urutan" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Aktif</label>
                    <select name="aktif" class="form-control">
                        <option>Pilih Status</option>
                        <option value="Y">Ya</option>
                        <option value="T">Tidak</option>
                    </select>
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
    $('form#formTipetarif').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
        },
        pasca:()=>{
            $('button#btn-kirim').show();
        },
        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-tipetarif").DataTable().ajax.reload();
        },
        error:  (xhr, status)=>{
            alert('Maaf, data pengguna gagal direkam');
        }
    })
    $('button#btn-kirim').on('click', function(){
        $('form#formTipetarif').submit();
    });
    $('button#btn-tambah').on('click', function(){
        $('#modalForm').modal('show');
        $('form#formTipetarif').trigger('reset');
        $('input[name=_method').val('');
    });

    $('table#table-tipetarif').on('click', '.btn-edit', function(){
        let id = $(this).data('id');

        let baseurl = "<?=base_url()?>";
        $.get(`${baseurl}/tipetarif/${id}`).done((e)=>{
            $('input[name=id]').val(e.id);
            $('input[name=tipe]').val(e.tipe);
            $('input[name=keterangan]').val(e.keterangan);
            $('input[name=urutan]').val(e.urutan);
            $('input[name=aktif]').val(e.aktif);
            $('#modalForm').modal('show');
            $('input[name=_method]').val('patch');
        });
    });

    $('table#table-tipetarif').on('click', '.btn-hapus', function(){
        let konfirmasi = confirm('Data tipetarif akan dihapus, mau dilanjutkan?');
        if(konfirmasi === true){
            let _id = $(this).data('id');
            let baseurl = "<?=base_url()?>";

            $.post(`${baseurl}/tipetarif`, {id:_id, _method:'delete'}).done(function(e){
                $('table#table-tipetarif').DataTable().ajax.reload();
            });
        }
    });

    $('table#table-tipetarif').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "<?=base_url('tipetarif/all')?>",
            method: 'GET'
        },
        columns: [
            { data: 'id', sortable:false, searchable:false, 
              render: (data,type,row,meta)=>{
                return meta.settings._iDisplayStart + meta.row + 1;
              }
            },
            { data: 'tipe' }, 
            { data: 'keterangan' },
            { data: 'urutan' },
            { data: 'aktif', 
              render: (data, type, meta, row)=>{
                if( data === 'Y' ){
                    return 'Ya';
                }else if( data === 'T' ){
                    return 'Tidak';
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