<div class="content-wrapper">
  <section class="content-header">
    <h1>
    <i class="fa fa-user"></i>
    <small>Edit Data Anggota</small>
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="row">
            
            <div class="box-body">

              <div class="col-md-8">
                <div class="row row-content-value">
                  <div class="col-md-12 py-3">
                    <form method="post" enctype="multipart/form-data" id="form-edit">
                      
                      <input type="hidden" value="<?php echo $data->id_anggota ?>" name="id">
                      <div class="row">
                        <div class="col-md-6">

                          <div class="form-group">
                            <label for="callsign">Call Sign:</label>
                            <input type="text" class="form-control" id="callsign" name="callsign" value="<?php echo $data->callsign ?>" placeholder="Masukkan Call Sign..." required readonly>
                          </div>

                          <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data->nama ?>" placeholder="Masukkan Nama..." required>
                          </div>

                          <div class="form-group">
                            <label for="no_hp">No Hp:</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $data->no_hp ?>" placeholder="Masukkan Nomor Hp..." value="-">
                          </div>

                          <div class="form-group">
                            <label for="nia">NRI:</label>
                            <input type="text" class="form-control" id="nia" name="nia" value="<?php echo $data->nia ?>" placeholder="Masukkan NRI..." required>
                          </div>

                          <div class="form-group">
                            <label for="tgl_lahir">Tgl_Lahir :  </label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $data->tgl_lahir ?>">
                          </div>

                          <div class="form-group">
                            <label for="kecamatan">Kecamatan:</label>
                            <select name="kecamatan" id="kecamatan" class="form-control" required>
                              <option disabled selected value="">Pilih Kecamatan</option>
                              <?php foreach ($kecamatan as $value): ?>
                              <option value="<?= $value->id_kecamatan ?>" <?php if ($data->nama_kecamatan == $value->nama_kecamatan){echo 'selected';} ?>><?= $value->nama_kecamatan ?></option>
                              <?php endforeach ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="alamat">Alamat:</label>
                            <textarea name="alamat" id="alamat" rows="5" class="form-control" style="resize: none;" placeholder="Masukkan Alamat..." required><?= $data->alamat ?></textarea>
                          </div>
                        </div>

                        <div class="col-md-6">

                          <div class="form-group">
                            <label for="berlaku">Berlaku:</label>
                            <input type="date" class="form-control" id="berlaku" name="berlaku" value="<?php echo $data->masa_berlaku ?>">
                          </div>

                          <div class="form-group">
                            <label for="pengurus">Pengurus:</label>
                            <input type="text" class="form-control" id="pengurus" name="pengurus" value="<?= $data->pengurus ?>" placeholder="Masukkan Pengurus..." value="-">
                          </div>

                          <div class="form-group">
                            <label for="jabatan">Jabatan:</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $data->jabatan ?>" placeholder="Masukkan Jabatan..." value="-">
                          </div>

                          <div class="form-group">
                            <label for="pekerjaan">Pekerjaan:</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= $data->pekerjaan ?>" placeholder="Masukkan Pekerjaan..." value="-">
                          </div>

                          <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $data->email ?>" placeholder="Masukkan Email..." value="-">
                          </div>

                          <div class="form-group">
                            <label for="agama">Agama:</label>
                            <input type="text" class="form-control" id="agama" name="agama" value="<?= $data->agama ?>" placeholder="Masukkan Agama...">
                          </div>

                          <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control" required>
                              <?php foreach ($status as $value): ?>
                                <option value="<?= $value->id_status ?>"  <?php if ($value->status == $data->status){echo 'selected';} ?>><?= $value->status ?></option>
                              <?php endforeach ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="foto">Foto:</label>
                            <small style="color: blue">(*) upload gambar berupa jpg, png, jpeg dan max 2000 Kb</small>
                            <input type="file" class="form-control" id="foto" name="foto">
                          </div>
                        </div>

                      </div>                    
                      <button type="submit" class="btn btn-primary form-control" name="submit">Simpan</button>
                    
                    </form>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <h4 class="text-center">Catatan Edit Data</h4>
                <ul>
                  <li>Jika Data yang diinputkan kosong, harap di isi simbol minus (-)</li>
                  <li>Jika anggota yang diinput baru, Berlaku jangan diisi</li>
                </ul>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>
<script type="text/javascript">
  $(document).ready(function($) {

    $('#form-edit').submit(function(event) {
      event.preventDefault()

      $.ajax({
        url: '<?php echo base_url('api/Api_Anggota/update') ?>',
        type: 'POST',
        data: new FormData(this),
        processData:false,
        contentType:false,
        cache:false,
        async:false,

        success: function (response) {

          var message = response.message
          var title = 'Berhasil'
          var icon = 'success'

          if (response.status == 201) {

            if (response.status_foto == 400) {
              message = 'Upload foto gagal, Gambar di set ke default'
              title = 'Berhasil Tambah'
            }

          }

          if (response.status == 204) {
            title = 'Gagal'
            icon = 'error'
          }
          
          swal({
            title: title,
            text: message,
            icon: icon,
          });

          $('.swal-button').click(function(event) {
            location.reload()
          });

        }

      })

    });
      
  });
</script>