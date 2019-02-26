<div class="row row-content-value">
  <div class="col-md-12 py-3">
    <div class="row" style="background: white; border-radius: 5px;">
      <h3 style="text-align: center;">Tambah Data</h3>
      <div class="col-md-12" style="justify-content: center;">
      <label style="color: blue; ">Jika data diinput tidak ada, isikan dengan simbol minus (-)</label>
      <p style="color: red; ">Jika anggota yang diinput baru, Berlaku jangan diisi</p>
        <form action="" method="post" role=form enctype="multipart/form-data">

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="callsign">Call Sign:</label>
                <input type="text" class="form-control" id="callsign" name="callsign" placeholder="Masukkan Call Sign..." required>
              </div>
              <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama..." required>
              </div>
              <div class="form-group">
                <label for="no_hp">No Hp:</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor Hp..." value="-">
              </div>
              <div class="form-group">
                <label for="nia">NRI:</label>
                <input type="text" class="form-control" id="nia" name="nia" placeholder="Masukkan NRI..." required>
              </div>
              <div class="form-group">
                <label for="tgl_lahir">Tgl_Lahir:</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" >
              </div>
              <div class="form-group">
                <label for="kecamatan">Kecamatan:</label>
                <select name="kecamatan" id="kecamatan" class="form-control" required>
                  <option disabled selected value="">Pilih Kecamatan</option>
                  <?php foreach ($kecamatan as $value): ?>
                    <option value="<?= $value->id_kecamatan ?>"><?= $value->nama_kecamatan ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea name="alamat" id="alamat" rows="5" class="form-control" style="resize: none;" placeholder="Masukkan Alamat..." required></textarea>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="berlaku">Berlaku:</label>
                <input type="date" class="form-control" id="berlaku" name="berlaku">
              </div>
              <div class="form-group">
                <label for="pengurus">Pengurus:</label>
                <input type="text" class="form-control" id="pengurus" name="pengurus" placeholder="Masukkan Pengurus..." value="-">
              </div>
              <div class="form-group">
                <label for="jabatan">Jabatan:</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan..." value="-">
              </div>
              <div class="form-group">
                <label for="pekerjaan">Pekerjaan:</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Masukkan Pekerjaan..." value="-">
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email..." value="-">
              </div>
              <div class="form-group">
                <label for="agama">Agama:</label>
                <input type="text" class="form-control" id="agama" name="agama" placeholder="Masukkan Agama...">
              </div>
              <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" required>
                  <option disabled selected value="">Pilih Status</option>
                  <option value="1">BARU</option>
                  <option value="2">VALID</option>
                  <option value="3">INVALID</option>
                  <option value="4">PERPANJANG</option>
                  <option value="5">SEUMUR HIDUP</option>
                </select>
              </div>
              <div class="form-group">
                <label for="foto">Foto:</label>
                <small style="color: blue">(*) upload gambar berupa jpg, png, jpeg dan max 2000 Kb</small>
                <input type="file" class="form-control" id="foto" name="foto">
              </div>
            </div>
          </div>
          
          
          <button type="submit" class="btn btn-primary form-control" name="submit" style="margin-bottom: 10px;">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<br>
<br>
<script src="<?php echo base_url() ?>/assets/js/jQuery-2.1.4.min.js"></script>
<script>
  $('.alert').fadeOut(7000);
</script>
