
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Daftar Anggota</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
    <link href="<?php echo base_url() ?>assets/css/mystyle.css" rel="stylesheet" type="text/css">
    
  </head>
    
<body>
<div class="container" style="margin-top: 20px;"></div>
<div class="row content-box">

  <div class="row">
    <h4 class="text-center"><span id="title">DATABASE ANGGOTA ORARI LOKAL KANJURUHAN<br>KAB. MALANG JAWA TIMUR ( YC3ZKM )</span></h4>
  </div>
  

<div class="row row-content-value">

  <div class="col-md-12">
    <div class="row row-content-2">

      <div class="col-md-3">
          <img src="<?php echo base_url('assets/image/logokanjuruhan.jpg') ?>" width="95%">
      </div>
      <div class="col-md-9">
        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/image/orlok.png" alt="" class="pull-right" style="width: 95%;" height="125"></a>
      </div>
    </div>
	
	<div class="row">
		<nav class="navbar navbar-default">
		  <div class="container-fluid">		      
		      <ul class="nav navbar-nav">
		        <li><a href="https://orlokkanjuruhan.or.id">HOME</a></li>
		        <li><a href="https://orlokkanjuruhan.or.id/blog">NEWS INFO</a></li>
		        <li><a href="https://orlokkanjuruhan.or.id/sekretariat">SEKRETARIAT</a></li>
		      </ul>
		  </div><!-- /.container-fluid -->
		</nav>
	</div>

    <div class="row">
    	<div class="col-md-6">
    		<div class="controls  input-data input-group input-group-sm">
    		    <input type="text" name="callsign" class="form-control call-sign" placeholder="Masukkan Callsign..." />
    		    <span class="input-group-btn">
    		        <button type="button" class="btn btn-success btn-flat" id="cari_callsign"> &nbsp;CARI</button>
    		    </span>
    		</div>
    	</div>
      	<div class="col-md-6">
      		<form action="<?php echo base_url('anggota') ?>" method="POST" role="form">
      		<div class="controls  input-data input-group input-group-sm">
      		    <select name="kecamatan" id="kecamatan" class="form-control">
      		      <option disabled selected>Pilih Kecamatan</option>
      		      <?php foreach ($kecamatan as $value): ?>
      		        <option value="<?= $value->id_kecamatan ?>"><?= $value->nama_kecamatan ?></option>
      		      <?php endforeach ?>
      		    </select>
      		    <span class="input-group-btn">
      		        <button type="submit" class="btn btn-success btn-flat" name="cari_kecamatan" id="cari_kecamatan"> &nbsp;CARI</button>
      		    </span>
      		</div>
      		</form>
      	</div>
    </div>

    <hr>

    <div class="row table-daftar-anggota">
      <div class="text-center" style="font-weight: bold;">
      	<span style="color: green">TOTAL DATA : <?= $total_data->total_data ?></span>,
      	<span style="color: black">BARU : <?= $total_data->baru ?></span>,
      	<span style="color: blue">VALID : <?= $total_data->valid ?></span>,
      	<span style="color: red">INVALID : <?= $total_data->invalid ?></span>,
      	<span style="color: #700000">PERPANJANG : <?= $total_data->perpanjang ?></span>,
      	<span style="color: #BDA55A">SEUMUR HIDUP : <?= $total_data->seumur_hidup ?></span>
      </div>
      <br>
      <table class="table table-hover table-list" style="background: white; padding: 0px;" id="data1">
        <thead>
          <tr>
            <th width="10">NO</th>
            <th width="110">CALL SIGN</th>
            <th>NAMA</th>
            <th>ALAMAT</th>
            <th width="90">BERLAKU</th>
            <th width="120">STATUS</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach($anggota as $a): ?>
          <tr class="tr">
            <input type="hidden" value="<?php echo $a->id_anggota ?>" id="id">
            <td style="text-align: center;"><?= $no ?></td>
            <td style="text-align: center;" id="callsign"><a class="detail"><?= $a->callsign ?></a></td>
            <td><?= $a->nama ?></td>
            <td><?= $a->alamat ?></td>

            <?php 
	            if ($a->status_id == 5) 
	            {
	            	echo "<td style='text-align: center;'> - </td>";
	            } 
	            else 
	            {
	            	echo "<td style='text-align: center;'>" . date('d-m-Y', strtotime($a->masa_berlaku)). "</td>";
	            }
	        ?>

	        <?php 
	        	if ($a->status_id == 1) 
	            {
		            echo "<td style='text-align: center;'><strong> $a->status </strong>";
	            }
	            else if ($a->status_id == 2)
	            { 
	            	echo "<td style='color: blue; text-align: center;'><strong> $a->status </strong></td>";
	            }
	            else if ($a->status_id == 3)
	            {
	            	echo "<td style='color: red; text-align: center;'><strong> $a->status </strong></td>";
	            }
	            else if ($a->status_id == 4)
	            {
	            	echo "<td style='color: #700000; text-align: center;'><strong> $a->status </strong></td>";
	            }
	            else
	            { 
	            	echo "<td style='color: #BDA55A; text-align: center;'><strong> $a->status </strong></td>";
				}
			?>
          </tr>
          <?php $no++; endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

    <div class="row" style="width: 75%; margin: auto; font-weight: 700">
      <br>
      <hr>
      <footer class="main-footer fixed-bottom" style="width: 100%; ">
         <div class="text-center hidden-xs">
            <style type="text/css">
			.style2 {
			  font-family: Arial, Helvetica, sans-serif;
			  font-size: 13px;
			}
			</style>

			<p align="center"><span class="style2">DATABASE ANGGOTA  ORARI LOKAL KANJURUHAN KAB. MALANG  JAWA TIMUR ( YC3ZKM ),<br>
			JIKA CALLSIGN ANDA  MASIH AKTIF DAN BELUM TERDAFTAR PADA DATABASE INI SILAHKAN <a href="https://orlokkanjuruhan.or.id/contact-us/form-kirim-berkas/" title="Click here to upload files">KIRIM BERKAS ONLINE</a><br>
			UPDATE DATA TERAKHIR  TANGGAL</span><span style="color: blue">   
		  	<?= date('d-m-Y / H:i:s', strtotime($waktu_update->waktu_update)) ?>   
		 	</span></p>
            
            <br><br>
            
            <style type="text/css">
			.style1 {
			  font-size: 11px;
			  font-family: Arial, Helvetica, sans-serif;
			  font-weight: bold;
			  padding: 20px;
			}
			</style>

			<div class="copyright style1">
				<div class="row">
					<div class="col-md-12">
						COPYRIGHT @2019 ORLOK KANJURUHAN-YC3ZKM
					</div>
				</div> 
			</div>
        </div>
      </footer>
    </div>
   </div>
    


   <script src="<?php echo base_url() ?>/assets/js/jQuery-2.1.4.min.js"></script>
   <script>
     $(document).ready(function($) {
       $('input[type=search]').attr('placeholder', 'Masukkan Pencarian');
       $('.alert').fadeOut(7000);

       function table_anggota(data){
        
        if (data.foto == null) {
          output = `<td valign="top" align="center"><img class="img-detail" src="assets/image/foto_blank.png" style="width:120px; height:150px"></td>`
        } else {
          output =  `<td valign="top" align="center"><img class="img-detail" src="assets/image/`+data.foto+`" style="width:120px; height:150px"></td>`
        }
        function waktu(time, status_id) {
            var r = time.match(/^\s*([0-9]+)\s*-\s*([0-9]+)\s*-\s*([0-9]+)(.*)$/);
            var hasil = r[3]+"-"+r[2]+"-"+r[1]+r[4];

            if (status_id == 5 || hasil == '00-00-0000') {
              return '-';
            } else {
              return hasil
            }
        }

        $('.table-daftar-anggota')
                .html(`<center style="background:white; padding:20px; box-shadow: 2px 2px 2px 1px;"><table width="500">
                  <tbody>
                    <tr> 
                      `+output+`
                      <td>
                        <table class="table-detail table table-striped"  style="margin-left:10px;">
                          <tbody>
                            <tr>
                              <td>Callsign</td><td>`+data.callsign+`</td>
                            </tr>
                            <tr>
                              <td>Nama</td><td>`+data.nama+`</td>
                            </tr>
                            <tr>
                              <td>Alamat</td><td>`+data.alamat+`</td>
                            </tr>
                            <tr>
                              <td>Kecamatan</td><td>`+data.nama_kecamatan+`</td>
                            </tr>
                            <tr>
                              <td>NRI</td><td>`+data.nia+`</td>
                            </tr>
                            <tr>
                              <td>Berlaku</td><td>`+waktu(data.masa_berlaku, data.status_id)+`</td>
                            </tr>
                            <tr>
                              <td>Status</td><td>`+data.status+`</td>
                            </tr>
                            <tr>
                              <td>Pengurus</td><td>`+data.pengurus+`</td>
                            </tr>
          					<tr>
                              <td>Jabatan</td><td>`+data.jabatan+`</td>
                            </tr>
                            <tr>
                              <td>Pekerjaan</td><td>`+data.pekerjaan+`</td>
                            </tr>
                            <tr>
                              <td>Email</td><td>`+data.email+`</td>
                            </tr>
                            <tr>
                              <td>Agama</td><td>`+data.agama+`</td>
                            </tr>
                            <tr>
                              <td>No. Hp</td><td>`+data.no_hp+`</td>
                            </tr>
                            <tr>
                              <td>Tanggal Lahir</td><td>`+waktu(data.tgl_lahir, data.status_id)+`</td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  <tbody>
                  </table></center>`)
       }

       $('#cari_kecamatan').click(function(e) {
          var kecamatan = $('#kecamatan').val()
          if (kecamatan == null) {
            alert('pilih kecamatan terlebih dahulu')
          }

       });

       $('.detail').click(function() {
           var row = $(this).closest('.tr')
           var id = row.find('#id').val()

           $.ajax({
             url: '<?php echo base_url('anggota/detail') ?>',
             type: 'POST',
             dataType: 'json',
             data: {id: id},
             beforeSend: function(){
                $('.table-daftar-anggota').html('<div style="margin: 50px; text-align:center;"><strong>Sedang Mencari Data Anggota...</strong></div>')
             },
             success: function(response){
                data = response[0]
                
                table_anggota(data)
             }

           })
          $('button[type=button]').click(function() {
                location.reload()
           });
       });

       $('#cari_callsign').click(function() {
         var str = $('.call-sign').val()
         var callsign = str.trim()

         $.ajax({
           url: '<?php echo base_url('anggota/callsign') ?>',
           type: 'POST',
           dataType: 'json',
           data: {callsign: callsign},
           beforeSend: function(){
              $('.table-daftar-anggota').html('<div style="margin: 50px; text-align:center;"><strong>Sedang Mencari Data Anggota...</strong></div>')
           },
           success: function(response){
              data = response[0]
              if (data == null) {
                alert('data tidak ditemukan')
                location.reload()
              } else {
                table_anggota(data)
              }
           }
         });
       });     
     });
   </script>
   <script type="text/javascript" language="JavaScript" src="<?php echo base_url() ?>/assets/datatables/jquery.dataTables.min.js"></script>
   <script type="text/javascript" language="JavaScript" src="<?php echo base_url() ?>/assets/datatables/dataTables.bootstrap.min.js"></script>
   <script>
      $(function () {
          $('#data1').DataTable({
            "iDisplayLength": 10,
            "aLengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]]
          })
          })
   </script>
  </body>
</html>
