<div class="table-daftar-anggota">
<table class="table table-bordered table-striped table-list" width='100%' bgcolor='#ffffff' border='1' cellspacing='1' cellpadding='1' style='border-collapse:collapse; font-family:tahoma; font-size:11px' id="data1">
  <thead>
    <tr>
      <th width="10">NO</th>
      <th width="100">CALL SIGN</th>
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
