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

    <table id='table-pembayaran' class="datatable table table-bordered">
         <thead>
             <tr>
                <th>Id</th>
                <th>Tanggal</th>
                <th>Tagihan</th>
                <th>Dibayar</th>
                <th>Nama Pembayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<div id="modalForm" class="modal">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">From Pembayaran Hotel</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form id="formpembayaran" method="post" action="<?=base_url('pembayaran')?>">
                <input type="hidden" name="id" />
                <input type="hidden" name="_method"/>
                <div class="mb-3">
                    <label class="form-label">Id</label>
                    <input type="text" name="id" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tgl" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Tagihan</label>
                    <input type="double" name="tagihan" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Dibayar</label>
                    <input type="double" name="dibayar" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Pembayar</label>
                    <input type="text" name="nama_pembayar" class="form-control" />
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success" id='btn-kirim'>Kirim</button>
        </div>
    </div>
</div>
</div>

<script>
$(document).ready(function(){
    $('form#formpembayaran').submitAjax({
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
    $('button#btn-kirim').on('click', function(){
        $('form#formpembayaran').submit();
    });
    $('button#btn-tambah').on('click', function(){
        $('#modalForm').modal('show');
        $('form#formpembayaran').trigger('reset');
        $('input[name=_method').val('');
    });

    $('table#table-pembayaran').on('click', 'btn-edit', function(){
        let id = $(this).data('id');
        let baseurl = "<?=base_url()?>";
        $.get(`${baseurl}pembayaran/${id}`).done((e)=>{
            $('input[name=id]').val(e.id);
            $('input[name=tgl]').val(e.tgl);
            $('input[name=tagihan]').val(e.tagihan);
            $('input[name=dibayar]').val(e.dibayar);
            $('input[name=nama_pembayar]').val(e.nama_pembayar);
            $('#modalForm').modal('show');
            $('input[name=_method]').val('patch');
        });
    });

    $('table#table-pembayaran').on('click', '.btn-hapus', function(){
        let konfirmasi = confirm('Data pelanggan akan dihapus, mau dilanjutkan?');

        if(konfirmasi === true){
            let _id = $(this).data('id');
            let baseurl = "<?=base_url()?>";

            $.post(`${baseurl}/pembayaran`, {id:_id, _method:'delete'}).done(function(e){
                $('table#table-pembayaran').DataTable().ajax.reload();
            });
        }
    });

    $('table#table-pembayaran').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "<?=base_url('pembayaran/all')?>",
            method: 'GET'
        },
        columns: [
            { data: 'id', sortable:false, searchable:false, 
              render: (data,type,row,meta)=>{
                return meta.settings._iDisplayStart + 1;
              }
            },
            // {data: 'id'},
            { data: 'tgl' },
            { data: 'tagihan' },
            { data: 'dibayar' },
            { data: 'nama_pembayar' },
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