<div class="content-wrapper">
  <section class="content-header">
    <h1>
    <i class="fa fa-list-ul"></i>
    <small>Add, Edit, Delete</small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-6">
        
        <div class="box">
            <div class="row">
  
              <div class="col-md-12" style="margin: 10px 0px 10px 0px;">
                  <div class="text-center">
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal-kecamatan" onclick="tambah()"><i class="fa fa-plus"></i> Tambah Kecamatan</a>
                  </div>
              </div>


              <div class="box-body">
                <div class="col-md-12">
                <form action="" method="post" accept-charset="utf-8" class="formcentang">
                <div class="table-output">
                  
                  <table class="table table-bordered table-responsive" id="table-kecamatan" >
                    <thead>
                      <tr>
                        <th width="10">No</th>
                        <th width="200">Nama Kecamatan</th>
                        <th width="100">Jumlah Anggota</th>
                        <th class="text-center" width="10">Delete</th>
                      </tr>
                    </thead>
                      <tbody>
                      </tbody>
                    </table>

                </div>
              </div>
                
              </div>
            </div>

        </div>
      
      </div>
    </div>

     <!-- Modal -->
        <div class="modal fade" id="modal-kecamatan" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Kecamatan</h4>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary simpan" data-dismiss="modal">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        
  </section>
</div>

<script type="text/javascript" language="JavaScript" src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="JavaScript" src="<?php echo base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function($) {

      var data_tables = function() {

        $('#table-kecamatan').DataTable({

              "iDisplayLength": 10,
              "aLengthMenu": [[10, 100, 300, 500], [10, 100, 300, 500]],
            
            })

      }

      $.ajax({
        url: 'api/Api_Kecamatan/index',
        type: 'GET',
        dataType: 'json',

        success: function (response) {
          let output = ''
          let no = 1;
          $.each(response, function(index, el) {
            output += 
            `<tr>
              <td>`+no+`</td>
              <td>`+el.nama_kecamatan+`</td>
              <td>`+el.count+` Jiwa </td>
              <td align="center"><a class="btn btn-danger btn-sm" onclick="hapus(`+el.id_kecamatan+`)"><i class="fa fa-trash"></i></a></td>
            </tr>`
            no++
          });

          $('#table-kecamatan tbody').html(output)

          data_tables()

        }
      })

      
  });
  
  function tambah() {
    $('#modal-kecamatan .modal-body').html(`
        <table style="padding:5px" class="table table-responsive table-inverse">
            <tr>
              <td class="text-center"><strong>Nama Kecamatan</strong></td>
            </tr>
            <tr>
              <td><input type="text" class="form-control" name="nama_kecamatan"></td>
            </tr>
        </table>`);
  }

  $('.simpan').click(function(e) {

    $.ajax({
      url: 'api/Api_Kecamatan/tambah',
      type: 'POST',
      dataType: 'json',
      data: {kecamatan: $('[name="nama_kecamatan"]').val()},

      success: function (response) {

        if (response.status == 200) {
          swal({
            title: "Berhasil",
            text: response.message,
            icon: "success",
          });

          $('.swal-button').click(function(event) {
            location.reload()
          });

        }
      }
    
    })

  });  

  function hapus(kecamatan) {

    swal({
      title: "Yakin ingin menghapus kecamatan ini?",
      text: "Data kecamatan yang dihapus tidak dapat dikembalikan",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {

        $.ajax({
          url: 'api/Api_Kecamatan/hapus',
          type: 'POST',
          dataType: 'json',
          data: {id_kecamatan: kecamatan},

          success: function (response) {

            if (response.status == 200) {
              swal({
                title: "Berhasil",
                text: response.message,
                icon: "success",
              });

              $('.swal-button').click(function(event) {
                location.reload()
              });

            }

            if (response.status == 304) {
              swal({
                title: "Gagal",
                text: response.message,
                icon: "error",
              });
            }
          }
        })    

      }
    });

  }

</script>