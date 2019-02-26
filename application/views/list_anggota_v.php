<div class="row row-content-value">
  <div class="col-md-12">
    <div class="row row-content-2">
      <div class="col-md-5">
          <div class="row">
            <div class="controls  input-data input-group input-group-sm">
                <input type="text" name="callsign" class="form-control call-sign" placeholder="Masukkan Callsign..." />
                <span class="input-group-btn">
                    <button type="button" class="btn btn-success btn-flat" id="cari_callsign"> &nbsp;CARI</button>
                </span>
            </div>
          </div>
          <hr>
          <div class="row">
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
      <div class="col-md-7">
        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>assets/image/orlok.png" alt="" class="pull-right" style="width: 95%;" height="125"></a>
      </div>
    </div>
    <div class="row table-daftar-anggota">
      <?php if ($this->session->flashdata('success') == TRUE): ?>
          <div role="alert" class="alert alert-success alert-dismissable fade in" >
              <button aria-label="Close" data-dismiss="alert" class="close btn-xs" type="button"><span aria-hidden="true" class="fa fa-times"></span></button>
              <strong><?php echo $this->session->flashdata('success'); ?></strong>
          </div>
      <?php endif ?>
      <?php if ($this->session->flashdata('error') == TRUE): ?>
          <div role="alert" class="alert alert-danger alert-dismissable fade in" >
              <button aria-label="Close" data-dismiss="alert" class="close btn-xs" type="button"><span aria-hidden="true" class="fa fa-times"></span></button>
              <strong><?php echo $this->session->flashdata('error'); ?></strong>
          </div>
      <?php endif ?>
      <div class="text-center" style="font-weight: bold;"><span style="color: green">TOTAL DATA : <?= $total_data->total_data ?></span>, <span >BARU : <?= $total_data->baru ?></span>, <span style="color: blue">VALID : <?= $total_data->valid ?></span>, <span style="color: red">INVALID : <?= $total_data->invalid ?></span>, <span style="color: #700000">PERPANJANG : <?= $total_data->perpanjang ?></span>, <span style="color: #BDA55A">SEUMUR HIDUP : <?= $total_data->seumur_hidup ?></span></div>
      <br>
      <table class="table table-hover table-responsive table-list" style="background: white; padding: 0px;" id="data1">
        <thead>
          <tr>
            <th width="10">NO</th>
            <th width="110">CALL SIGN</th>
            <th>NAMA</th>
            <th>ALAMAT</th>
            <th width="90">BERLAKU</th>
            <th width="120">STATUS</th>
            <th width="70">DETAIL</th>
            <?php if ($this->session->has_userdata('email')) :?>
            <th width="70">EDIT</th>
            <th width="70">HAPUS</th>
            <?php endif ?>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach($anggota as $a): ?>
          <tr class="tr">
            <input type="hidden" value="<?php echo $a->id_anggota ?>" id="id">
            <td style="text-align: center;"><?= $no ?></td>
            <td style="text-align: center;" id="callsign"><?= $a->callsign ?></td>
            <td><?= $a->nama ?></td>
            <td><?= $a->alamat ?></td>
            <?php if ($a->status_id == 5): ?>
            <td style="text-align: center;"> - </td>
            <?php else: ?>  
            <td style="text-align: center;"><?= date('d-m-Y', strtotime($a->masa_berlaku)) ?></td>
            <?php endif ?>
            <?php if($a->status_id == 1) { ?>
              <td style="text-align: center;"><strong><?= $a->status ?></strong>
            <?php }else if($a->status_id == 2){ ?>
              <td style="color: blue; text-align: center;"><strong><?= $a->status ?></strong></td>
            <?php }else if($a->status_id == 3){ ?>
              <td style="color: red; text-align: center;"><strong><?= $a->status ?></strong></td>
             <?php }else if($a->status_id == 4){ ?>
              <td style="color: #700000; text-align: center;"><strong><?= $a->status ?></strong></td>
            <?php }else{ ?>
              <td style="color: #BDA55A; text-align: center;"><strong><?= $a->status ?></strong></td>
            <?php } ?>
            <td><a class="btn btn-primary btn-sm detail">DETAIL</a></td>
            <?php if ($this->session->has_userdata('email')) :?>
            <td style="text-align: center;"><a href="<?php echo base_url('anggota/edit/').$a->id_anggota ?>" class="btn btn-warning btn-sm edit">EDIT</a></td>
            <td style="text-align: center;"><a href="<?php echo base_url('anggota/delete/').$a->id_anggota ?>" onclick="hapus()" class="btn btn-danger btn-sm hapus">HAPUS</a></td>
            <?php endif ?>
          </tr>
          <?php $no++; endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
