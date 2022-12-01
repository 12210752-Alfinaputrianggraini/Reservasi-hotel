<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
rel="stylesheet"  crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.1.min.js"rossorigin="anonymous"></script>
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

    <table id='table-kamartarif' class="datatable table table-bordered">
         <thead>
             <tr>
                <th>Id</th>
                <th>Tarif</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<div id="modalForm" class="modal">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">From Tarif Kamar Hotel</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <from id="formkamartarif" method="post" action="<?=base_url('kamartarif')?>">
                <input type="hidden" name="id" />
                <input type="hidden" name="_method"/>
                <div class="mb-3">
                    <label class="form-label">Tarif</label>
                    <input type="text" name="Tarif" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">deskripsi</label>
                    <input type="date" name="tgl_selesai" class="form-control" />
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
    $('form#formkamartarif').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
        },
        pasca:()=>{
            $('button#btn-kirim').show();
        },
        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-kamartarif").DataTable().ajax.reload();
        },
        error:  (xhr, status)=>{
            alert('Maaf, data pengguna gagal direkam');
        }
    })
    $('button#btn-kirim').on('click', function(){
        $('form#formkamartarif').submit();
    });
    $('button#btn-tambah').on('click', function(){
        $('#modalForm').modal('show');
        $('form#formkamartarif').trigger('reset');
        $('input[name=_method').val('');
    });

    $('table#table-kamartarif').on('click', 'btn-edit', function(){
        let id = $(this).data('id');
        let baseurl = "<?=base_url()?>";
        $.get(`${baseurl}kamartarif/${id}`).done((e)=>{
            $('input[name=id]').val(e.id);
            $('input[name=tarif]').val(e.lantai);
            $('input[name=tgl_mulai]').val(e.nomor);
            $('input[name=tgl_selesai]').val(e.deskripsi);
            $('#modalForm').modal('show');
            $('input[name=_method]').val('patch');
        });
    });

    $('table#table-kamartarif').on('click', '.btn-hapus', function(){
        let konfirmasi = confirm('Data pelanggan akan dihapus, mau dilanjutkan?');

        if(konfirmasi === true){
            let _id = $(this).data('id');
            let baseurl = "<?=base_url()?>";

            $.post(`${baseurl}/kamartarif`, {id:_id, _method:'delete'}).done(function(e){
                $('table#table-kamartarif').DataTable().ajax.reload();
            });
        }
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
                return meta.settings._iDisplayStart + 1;
              }
            },
            // {data: 'id'},
            { data: 'tarif' },
            { data: 'tgl_mulai' },
            { data: 'tgl_selesai' },
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