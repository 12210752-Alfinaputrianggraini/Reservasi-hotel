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

<table id='table-tipetarif' class="datatable table table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>pemesanan_id</th>
            <th>kamar_id</th>
            <th>tarif</th>
            <th>pengguna_id</th>
            <th>aktif</th>
            <th>aksi</th>
        </tr>
    </thead>
</table>
</div>

<div id="modalForm" class="modal">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">From Kamar Dipesan</h5>
            <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <from id="formkamardipesan" method="post" action="<?=base_url('kamardipesan')?>">
                <input type="hidden" name="id" />
                <input type="hidden" name="_method"/>
                <div class="mb-3">
                    <label class="form-label">Pemesanan id</label>
                    <input type="text" name="pemesanan_id" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Kamar id</label>
                    <input type="text" name="kamar_id" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Tarif</label>
                    <input type="text" name="tarif" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Pengguna id</label>
                    <input type="text" name="pengguna_id" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Aktif</label>
                    <select name="gender" class="form-control">
                        <option>Pilih Aktif</option>
                        <option value="Y">Ya</option>
                        <option value="T">Tidak</option>
                    </select>
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
    $('form#formkamardipesan').submitAjax({
        pre:()=>{
            $('button#btn-kirim').hide();
        },
        pasca:()=>{
            $('button#btn-kirim').show();
        },
        success:(response, status)=>{
            $("#modalForm").modal('hide');
            $("table#table-kamardipesan").DataTable().ajax.reload();
        },
        error:  (xhr, status)=>{
            alert('Maaf, data pengguna gagal direkam');
        }
    })
    $('button#btn-kirim').on('click', function(){
        $('form#formkamardipesan').submit();
    });
    $('button#btn-tambah').on('click', function(){
        $('#modalForm').modal('show');
        $('form#formkamardipesan').trigger('reset');
        $('input[name=_method').val('');
    });

    $('table#table-kamardipesan').on('click', 'btn-edit', function(){
        let id = $(this).data('id');
        let baseurl = "<?=base_url()?>";
        $.get(`${baseurl}tipetarif/${id}`).done((e)=>{
            $('input[name=id]').val(e.id);
            $('input[name=pemesanan_id]').val(e.pemesanan_id);
            $('input[name=kamar_id]').val(e.kamar_id);
            $('input[name=tarif]').val(e.tarif);
            $('input[name=pengguna_id]').val(e.pengguna_id);
        });
    });

    $('table#table-kamardipesan').on('click', '.btn-hapus', function(){
        let konfirmasi = confirm('Data pelanggan akan dihapus, mau dilanjutkan?');

        if(konfirmasi === true){
            let _id = $(this).data('id');
            let baseurl = "<?=base_url()?>";

            $.post(`${baseurl}/kamardipesan`, {id:_id, _method:'delete'}).done(function(e){
                $('table#table-kamardipesan').DataTable().ajax.reload();
            });
        }
    });

    $('table#table-kamardipesan').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "<?=base_url('kamardipesan/all')?>",
            method: 'GET'
        },
        columns: [
            { data: 'id', sortable:false, searchable:false, 
              render: (data,type,row,meta)=>{
                return meta.settings._iDisplayStart + 1;
              }
            },
            // {data: 'id'},
            { data: 'pemesanan_id' },
            { data: 'kamar_id' },
            { data: 'tarif' },
            { data: 'pengguna_id' },
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
                var  btnEdit = `<button class='btn-edit' data-id='${data}'> Edit </button>`;
                var  btnHapus = `<button class='btn-hapus' data-id='${data}'> Hapus </button>`;
                return btnEdit + btnHapus;
              }
            }
        ]
    });
});
</script>