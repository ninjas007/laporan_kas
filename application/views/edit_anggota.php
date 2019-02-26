<div class="row row-content-value">
  <div class="col-md-12">
    <div class="row" style="background: white; border-radius: 5px;">
      <h3 style="text-align: center;">Edit Data</h3>
      <div class="col-md-12" style="justify-content: center;">
      <label style="color: blue; ">Jika data diinput tidak ada, isikan dengan simbol minus (-)</label>
        <form action="<?php echo base_url('anggota/edit/').$data->id_anggota ?>" method="post" role=form enctype="multipart/form-data">

          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="id" value="<?= $data->id_anggota ?>">  
              <div class="form-group">
                <label for="callsign">Call Sign:</label>
                <input type="text" class="form-control" id="callsign" name="callsign" value="<?= $data->callsign ?>" placeholder="Masukkan Call Sign..." required disabled>
              </div>
              <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $data->nama ?>" placeholder="Masukkan Nama..." required>
              </div>
              <div class="form-group">
                <label for="no_hp">No Hp:</label>
                <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?= $data->no_hp ?>" placeholder="Masukkan Nomor Hp...">
              </div>
              <div class="form-group">
                <label for="nia">NRI:</label>
                <input type="text" class="form-control" id="nia" name="nia" value="<?= $data->nia ?>" placeholder="Masukkan NIA..." required>
              </div>
              <div class="form-group">
                <label for="tgl_lahir">Tgl_Lahir:</label>
                <input type="date" class="form-control" id="tgl_lahir" value="<?= $data->tgl_lahir ?>" name="tgl_lahir">
              </div>
              <div class="form-group">
                <label for="kecamatan">Kecamatan:</label>
                <select name="kecamatan" id="kecamatan" class="form-control" required>
                  <!-- <option disabled selected value=""><?= $data->nama_kecamatan ?></option> -->
                  <?php foreach ($kecamatan as $value): ?>
                    <option value="<?= $value->id_kecamatan ?>" <?php if ($data->nama_kecamatan == $value->nama_kecamatan){echo 'selected';} ?>><?= $value->nama_kecamatan ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea name="alamat" id="alamat" rows="6" class="form-control" style="resize: none;" placeholder="Masukkan Alamat..." required><?= $data->alamat ?></textarea>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="berlaku">Berlaku:</label>
                <input type="date" class="form-control" id="berlaku" name="berlaku" value="<?= $data->masa_berlaku ?>">
              </div>
              <div class="form-group">
                <label for="pengurus">Pengurus:</label>
                <input type="text" class="form-control" id="pengurus" name="pengurus" value=" <?= $data->pengurus ?>" placeholder="Masukkan Pengurus..." required>
              </div>
              <div class="form-group">
                <label for="jabatan">Jabatan:</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $data->jabatan ?>" placeholder="Masukkan Jabatan..." required>
              </div>
              <div class="form-group">
                <label for="pekerjaan">Pekerjaan:</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= $data->pekerjaan ?>" placeholder="Masukkan Pekerjaan..." required>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $data->email ?>" placeholder="Masukkan Email...">
              </div>
              <div class="form-group">
                <label for="agama">Agama:</label>
                <input type="text" class="form-control" id="agama" name="agama" value="<?= $data->agama ?>" placeholder="Masukkan Agama..." required>
              </div>
              <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" required>
                  <?php foreach ($status as $value): ?>
                    <option value="<?= $value->id_status ?>"  <?php if ($value->status == $data->status){echo 'selected';} ?>><?= $value->status ?></option>
                  <?php endforeach ?>
                  <!-- <option value="<?= $value->id_status ?>" selected disabled>--Pilih Status--</option> -->
                  <!-- <option value="4">Perpanjang</option> -->
                </select>
              </div>
              <div class="form-group">
                <label for="foto">Foto:</label>
                <img src="<?php if($data->foto == NULL ) { echo base_url('assets/image/').'foto_blank.png'; } else { echo base_url('assets/image/').$data->foto; }  ?>" alt="foto" width="60" height="70">
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
