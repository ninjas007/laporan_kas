    <div class="row" style="width: 75%; margin: auto; font-weight: 700">
      <br>
      <hr>
      <footer class="main-footer fixed-bottom" style="width: 100%; ">
          <div class="text-center hidden-xs">
            <style type="text/css">
<!--
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
}
-->
</style>
<p align="center"><span class="style2">DATABASE ANGGOTA  ORARI LOKAL KANJURUHAN KAB. MALANG  JAWA TIMUR ( YC3ZKM ),<br>
JIKA CALLSIGN ANDA  MASIH AKTIF DAN BELUM TERDAFTAR PADA DATABASE INI SILAHKAN <a href="https://orlokkanjuruhan.or.id/contact-us/form-kirim-berkas/" title="Click here to upload files">KIRIM BERKAS ONLINE</a><br>
UPDATE DATA TERAKHIR  TANGGAL</span><span style="color: blue">   
  <?= date('d-m-Y / H:i:s', strtotime($waktu_update->waktu_update)) ?>   
  </span></p>
            <br><br>
            <style type="text/css">
<!--
.style1 {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
<div class="copyright style1">Copyright@2019 ORLOK KANJURUHAN-YC3ZKM</div>
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