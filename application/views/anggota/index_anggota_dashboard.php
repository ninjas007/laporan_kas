<link href="<?php echo base_url() ?>assets/css/mystyle.css" rel="stylesheet" type="text/css">

<div class="content-wrapper">
  <section class="content-header">
    <h1>
    <i class="fa fa-list-ul"></i>
    <small>Add, Edit, Delete</small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-9">
        
        <div class="box">
            <div class="row">
  
              <div class="col-md-4" style="margin: 10px 0px 10px 0px;">
                <form action="<?php echo base_url('admin') ?>" method="post">
                  <div class="controls  input-data input-group" style="margin-left: 10px">
                      <select name="kecamatan" id="kecamatan" class="form-control">
                        <option value="0">-- Pilih Kecamatan --</option>
                        <?php foreach ($kecamatan as $value): ?>
                          <option value="<?= $value->id_kecamatan ?>"><?= $value->nama_kecamatan ?></option>
                        <?php endforeach ?>
                      </select>
                      <span class="input-group-btn">
                          <button class="btn btn-success btn-md" id="search" name="cari_kecamatan" value="submit">&nbsp; CARI</button>
                      </span>
                  </div>
                </form>
              </div>

              <div class="col-md-8" style="margin: 10px 0px 10px 0px;">
                  <div class="pull-right" style="margin-right: 10px">
                    <a class="btn btn-primary" href="<?php echo base_url('Dashboard_Anggota_Tambah')?>"><i class="fa fa-plus"></i> Tambah Anggota</a>
                  </div>
              </div>


              <div class="box-body">
                <div class="col-md-12">
                <form action="" method="post" accept-charset="utf-8" class="formcentang">
                <div class="table-output">
                  
                  <table class="table table-bordered table-striped table-responsive text-center" id="table-anggota" >
                    <thead>
                      <tr>
                        <th width="10">No</th>
                        <th width="150">Call Sign</th>
                        <th width="150">Nama</th>
                        <th width="300">Alamat</th>
                        <th>Berlaku</th>
                        <th width="100">Status</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                      </tr>
                    </thead>
                      <tbody>
                        <?php $no =1; foreach ($anggota as $value): ?>
                        <tr>
                          <td><?= $no ?></td>
                          <td><a href="#" data-toggle="modal" data-target="#modal-anggota" onclick="detail(<?php echo $value->id_anggota ?>)"><?= $value->callsign ?></a></td>
                          <td><?= $value->nama ?></td>
                          <td><?= $value->alamat ?></td>
                          <td><?= date('d-m-Y', strtotime($value->masa_berlaku)) ?></td>
                            <?php if ($value->status_id == 1) { echo '<td>BARU</td>'; }
                                  if ($value->status_id == 2) { echo '<td style="color:blue">VALID</td>'; }
                                  if ($value->status_id == 3) { echo '<td style="color:red">INVALID</td>'; }
                                  if ($value->status_id == 4) { echo '<td style="color:#700000">PERPANJANG</td>'; }
                                  if ($value->status_id == 5) { echo '<td style="color:#BDA55A">SEUMUR HIDUP</td>'; }
                            ?>
                          <td width="8" align="center">
                            <a href="<?php echo base_url('Dashboard_Anggota_Edit/'.base64_encode($value->callsign))?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i>
                            </a>
                          </td>
                          <td width="8" align="center">
                            <a href="#" class="btn btn-sm btn-danger delete" onclick="hapus(<?php echo $value->id_anggota ?>)">
                              <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>                    
                        <?php $no++; endforeach ?>
                      </tbody>
                    </table>

                </div>
              </div>
                
              </div>
            </div>

        </div>
      
      </div>

      <div class="col-md-3">
        <div class="box">
          <div class="box-body">
            <ul style="list-style: none;">
              <li style="color: green;"><h4>Total Data : <?php echo $total_data->total_data; ?> Jiwa</h4></li>
              <li><h4>Baru : <?php echo $total_data->baru; ?> Jiwa</h4></li>
              <li style="color:blue"><h4>Valid : <?php echo $total_data->valid; ?> Jiwa</h4></li>
              <li style="color:red"><h4>Invalid : <?php echo $total_data->invalid; ?> Jiwa</h4></li>
              <li style="color:#700000"><h4>Perpanjang : <?php echo $total_data->perpanjang; ?> Jiwa</h4></li>
              <li style="color:#BDA55A"><h4>Seumur Hidup : <?php echo $total_data->seumur_hidup; ?> Jiwa</h4></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

     <!-- Modal -->
        <div class="modal fade" id="modal-anggota" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Detail Anggota</h4>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

      $('#table-anggota').DataTable({

            "iDisplayLength": 10,
            "aLengthMenu": [[10, 100, 300, 500], [10, 100, 300, 500]],
          
          })

    }

    data_tables()

    $('.delete').click(function(e) {
      e.preventDefault()
    });


});

function hapus(id) {


    swal({
      title: "Yakin ingin menghapus anggota ini?",
      text: "Data anggota yang dihapus tidak dapat dikembalikan",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {

        $.ajax({
          url: '<?php echo base_url('api/Api_Anggota/delete') ?>',
          type: 'POST',
          dataType: 'json',
          data: {id_anggota: id},

          success: function (response) {

            if (response.status == 200) {

              swal({
                title: "Terhapus",
                text: response.message,
                icon: "success",
              });
              $('.swal-button').click(function(event) {
                location.reload()
              });

            }
            else
            {
              swal({
                title: "Gagal",
                text: response.message,
                icon: "error",
              });
              $('.swal-button').click(function(event) {
                location.reload()
              });
            }

          }
        
        })  

      }
    });
    
}

function gambar(foto) {

  if (foto == null) {
    return `<td valign="top" align="center" rowspan="4"><img class="img-detail" src="assets/image/foto_blank.png" style="width:120px; height:150px"></td>`
  } else {
    return `<td valign="top" align="center" rowspan="4"><img class="img-detail" src="assets/image/`+foto+`" style="width:120px; height:150px"></td>`
  }

}

function waktu(time, status_id = null) {
    var r = time.match(/^\s*([0-9]+)\s*-\s*([0-9]+)\s*-\s*([0-9]+)(.*)$/);
    var hasil = r[3]+"-"+r[2]+"-"+r[1]+r[4];

    if (status_id == 5 || hasil == '00-00-0000') {
      return '-';
    } else {
      return hasil
    }
}

function detail(id) {

  $.ajax({
    url: '<?php echo base_url('api/Api_Anggota/detail') ?>',
    type: 'POST',
    dataType: 'json',
    data: {id_anggota: id},

    success: function (response) {

      $('#modal-anggota .modal-body').html(`
          <table style="padding:5px" class="table table-responsive table-inverse">
              <tr>
                <td><strong>CallSign</strong></td><td>:</td><td>`+response[0].callsign+`</td>
                `+gambar(response[0].foto)+`
              </tr>
              <tr><td><strong>Nama</strong></td><td>:</td><td>`+response[0].nama+`</td></tr>
              <tr><td><strong>Alamat</strong></td><td>:</td><td>`+response[0].alamat+`</td></tr>
              <tr><td><strong>Kecamatan</strong></td><td>:</td><td>`+response[0].nama_kecamatan+`</td></tr>
              <tr><td><strong>NRI</strong></td><td>:</td><td>`+response[0].nia+`</td></tr>
              <tr><td><strong>Berlaku</strong></td><td>:</td><td>`+waktu(response[0].masa_berlaku)+`</td></tr>
              <tr><td><strong>Status</strong></td><td>:</td><td>`+response[0].status+`</td></tr>
              <tr><td><strong>Pengurus</strong></td><td>:</td><td>`+response[0].pengurus+`</td></tr>
              <tr><td><strong>Jabatan</strong></td><td>:</td><td>`+response[0].jabatan+`</td></tr>
              <tr><td><strong>Pekerjaan</strong></td><td>:</td><td>`+response[0].pekerjaan+`</td></tr>
              <tr><td><strong>Email</strong></td><td>:</td><td>`+response[0].email+`</td></tr>
              <tr><td><strong>Agama</strong></td><td>:</td><td>`+response[0].agama+`</td></tr>
              <tr><td><strong>No Hp</strong></td><td>:</td><td>`+response[0].no_hp+`</td></tr>
              <tr><td><strong>Tgl Lahir</strong></td><td>:</td><td>`+waktu(response[0].tgl_lahir, response[0].status_id)+`</td></tr>
          </table>`);

    }
  
  })

}

</script>
