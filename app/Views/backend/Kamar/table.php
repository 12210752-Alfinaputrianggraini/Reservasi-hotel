<?=$this->extend('backend/template')?>

<?=$this->section('content')?>


<div class="container">
    <button class="float-end btn-sm btn-primary" id="btn-tambah">Tambah</button>

    <table id='table-kamar' class="datatable table table-bordered">
         <thead>
             <tr>
                <th>No</th>
                <th>Lantai</th>
                <th>Nomor</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<div id="modalForm" class="modal">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">From Kamar Hotel</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form id="formkamar" method="post" action="<?=base_url('kamar')?>">
                <input type="hidden" name="id" />
                <input type="hidden" name="_method"/>
                <div class="mb-3">
                    <label class="form-label">lantai</label>
                    <input type="text" name="lantai" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">nomor</label>
                    <input type="text" name="nomor" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" />
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
    
    $('form#formkamar').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
        },
        pasca:()=>{
            $('button#btn-kirim').show();
        },
        success:(response, status)=>{ 
            $("#modalForm").modal('hide');
            $("table#table-kamar").DataTable().ajax.reload();
        },
        error:  (xhr, status)=>{
            alert('Maaf, data pengguna gagal direkam');
        }
    });

    $('button#btn-kirim').on('click', function(){
        $('form#formkamar').submit(); 
    });

    $('button#btn-tambah').on('click', function(){
        $('#modalForm').modal('show');
        $('form#formkamar').trigger('reset');
        $('input[name=_method').val('');
    });

    $('table#table-kamar').on('click', '.btn-edit', function(){
        let id = $(this).data('id');
      
        let baseurl = "<?=base_url()?>"; 
        $.get(`${baseurl}/kamar/${id}`).done((e)=>{
            $('#modalForm').modal('show');
            $('input[name=id]').val(e.id);
            $('input[name=lantai]').val(e.lantai);
            $('input[name=nomor]').val(e.nomor);
            $('input[name=deskripsi]').val(e.deskripsi);
            $('input[name=_method]').val('patch');
        });
    });

    $('table#table-kamar').on('click', '.btn-hapus', function(){
        let konfirmasi = confirm('Data pelanggan akan dihapus, mau dilanjutkan?');

        if(konfirmasi === true){
            let _id = $(this).data('id');
            let baseurl = "<?=base_url()?>";

            $.post(`${baseurl}/kamar`, {id:_id, _method:'delete'}).done(function(e){
                $('table#table-kamar').DataTable().ajax.reload();
            });
        }
    });

    $('table#table-kamar').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "<?=base_url('kamar/all')?>",
            method: 'GET'
        },
        columns: [
            { data: 'id', sortable:false, searchable:false, 
              render: (data,type,row,meta)=>{
                return meta.settings._iDisplayStart + meta.row + 1;
              }
            },
            // {data: 'id'},
            { data: 'lantai' },
            { data: 'nomor' },
            { data: 'deskripsi' },
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