<!DOCTYPE html>
<html>

<head>
  <title>Riwayat Absensi - <?= $data['user']->nama ?></title>

  <style>
    table.absensi td {
      padding: 10px;
    }

    table.absensi th {
      padding: 10px;
    }
  </style>
</head>

<body>

  <div class="card card-box mb-30" style="border: 1px solid #2b2b2b;padding:10px;margin-bottom:20px;">
    <div class="card-body row" style="align-items: center;">
      <div class="pd-20">
        <table class="data-user-riwayat">
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td class="info"><?= $data['user']->nama ?></td>
          </tr>
          <tr>
            <td>NIP</td>
            <td>:</td>
            <td class="info"><?= $data['user']->nip ?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td>:</td>
            <td class="info"><?= $data['user']->email ?></td>
          </tr>
          <tr>
            <td>No HP</td>
            <td>:</td>
            <td class="info"><?= $data['user']->no_hp ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <!-- Simple Datatable start -->
  <div class="card-box mb-30 mt-10 col-12">
    <div class="pb-20 pt-20 col-12">
      <table class="table hover stripe nowrap absensi col-12" border="1">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th class="table-plus datatable-nosort">Jam Masuk</th>
            <th class="table-plus datatable-nosort">Jam Pulang</th>
            <th class="table-plus datatable-nosort">Total Jam Kerja</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($data['riwayat'] as $absen) {
            if ($absen->keterangan == 'Hadir') {
              $badge = 'success';
            } elseif ($absen->keterangan == 'Izin') {
              $badge = 'warning';
            } else {
              $badge = 'danger';
            }

            if (!$absen->jam_pulang) {
              $jam_pulang = '<span class="text-danger">Tidak Absen</span>';
            } else {
              $jam_pulang = timeFilter($absen->jam_pulang);
            }

            $total_jam = strtotime($absen->jam_pulang) - strtotime($absen->jam_masuk);
            $total_jam = $total_jam / 60;
            if ($total_jam < 480) {
              $jamkerja = 480 - $total_jam;
              $total_jam = '<span class="text-danger">Kurang ' . $jamkerja . ' Menit Kerja</span>';
            } else {
              $total_jam = $total_jam . ' Menit Kerja';
            }
            if ($absen->keterangan != 'Hadir') {
              $total_jam = '<span class="text-danger">Tidak Hadir</span>';
            }
          ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= dayID($absen->tanggal) ?>, <?= dateID($absen->tanggal) ?></td>
              <td class="table-plus"><?= timeFilter($absen->jam_masuk) ?></td>
              <td class="table-plus"><?= $jam_pulang ?></td>
              <td><?= $total_jam ?></td>
              <td><span class="badge badge-<?= $badge ?>"><?= $absen->keterangan ?></span></td>
            </tr>
          <?php
            $no++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    window.print();
  </script>
</body>

</html>