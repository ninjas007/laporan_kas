  <div class="row row-content-value">
  <?php if ($this->session->flashdata('success') == TRUE): ?>
      <div role="alert" class="alert alert-success alert-dismissable fade in" >
          <button aria-label="Close" data-dismiss="alert" class="close btn-xs" type="button"><span aria-hidden="true" class="fa fa-times"></span></button>
          <strong><?php echo $this->session->flashdata('success'); ?></strong>
      </div>
  <?php endif ?>
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6">
          <h3>Tambah / Hapus Kecamatan</h3>
          <form action="<?php echo base_url('admin/dataKecamatan') ?>" role="form" method="post">
          <div class="form-group">
            <label for="nama_kecamatan ">Nama Kecamatan:</label>
            <input type="text" class="form-control" id="nama_kecamatan" name="nama_kecamatan" placeholder="Masukkan Nama Kecamatan..." required>
          </div>
          <button type="submit" name="submit" class="btn btn-md btn-primary">Simpan</button>
          <button class="btn-md btn btn-danger" type="button" id="hapus">Hapus</button>
          </form>
        </div>
        <div class="col-md-6">
          <h3>Daftar Kecamatan</h3>
          <ol>
            <?php foreach ($kecamatan as $value): ?>
              <li style=""><strong><?php echo $value->nama_kecamatan ?></strong> : <?php echo $value->count ?> Jiwa</p>
            <?php endforeach ?>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url() ?>/assets/js/jQuery-2.1.4.min.js"></script>
  <script>
  $(document).ready(function($) {

    $('#hapus').click(function(event) {
      var kecamatan = $('#nama_kecamatan').val()
      
      $.ajax({
        url: '<?php echo base_url('admin/hapus') ?>',
        type: 'POST',
        dataType: 'json',
        data: {data: kecamatan},

        success: function(response){
          alert('Kecamatan Berhasil Dihapus')
          location.reload()
        }
      })
    })
  })
  </script>
</div>
</body>
