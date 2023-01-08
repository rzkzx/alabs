
<?php
class AbsenModel
{
  private $db;
  private $table = 'absen';


  public function __construct()
  {
    $this->db = new Database;
  }

  // Absen
  public function getAbsenTodayByUserLogged()
  {
    $tanggal = today();

    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE tanggal=:tanggal AND nip=:nip');
    $this->db->bind('tanggal', $tanggal);
    $this->db->bind('nip', $_SESSION['nip']);
    $row = $this->db->single();

    if ($row) {
      return $row;
    } else {
      return 0;
    }
  }

  public function getAbsensiKonfirmasiToday()
  {
    $tanggal = today();

    $this->db->query('SELECT absen.*, users.nama, users.no_hp FROM ' . $this->table . ' LEFT JOIN users ON users.nip=absen.nip WHERE tanggal=:tanggal AND (keterangan=:izin OR keterangan=:cuti)');
    $this->db->bind('tanggal', $tanggal);
    $this->db->bind('izin', 'Izin');
    $this->db->bind('cuti', 'Cuti');
    $result = $this->db->resultSet();

    return $result;
  }

  public function getRiwayat()
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip ORDER BY id ASC');
    $this->db->bind('nip', $_SESSION['nip']);
    $result = $this->db->resultSet();

    return $result;
  }

  public function getRiwayatUserNIP($nip)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip ORDER BY id ASC');
    $this->db->bind('nip', $nip);
    $result = $this->db->resultSet();

    return $result;
  }

  public function getRiwayatUserNIPByDate($nip, $date)
  {
    $bulan = date("m", strtotime($date));
    $tahun = date("Y", strtotime($date));

    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip AND MONTH(tanggal) = :bulan AND YEAR(tanggal) = :tahun ORDER BY id ASC');
    $this->db->bind('nip', $nip);
    $this->db->bind('bulan', $bulan);
    $this->db->bind('tahun', $tahun);
    $result = $this->db->resultSet();

    return $result;
  }

  public function getRiwayatUserNIPByCurrentDate($nip)
  {
    $bulan = date("m");

    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip AND MONTH(tanggal) = :bulan ORDER BY id ASC');
    $this->db->bind('nip', $nip);
    $this->db->bind('bulan', $bulan);
    $result = $this->db->resultSet();

    return $result;
  }

  public function getRiwayatUserLogged()
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip ORDER BY id ASC');
    $this->db->bind('nip', $_SESSION['nip']);
    $result = $this->db->resultSet();

    return $result;
  }

  public function getRiwayatUserLoggedByDate($date)
  {
    $bulan = date("m", strtotime($date));
    $tahun = date("Y", strtotime($date));

    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip AND MONTH(tanggal) = :bulan AND YEAR(tanggal) = :tahun ORDER BY id ASC');
    $this->db->bind('nip', $_SESSION['nip']);
    $this->db->bind('bulan', $bulan);
    $this->db->bind('tahun', $tahun);
    $result = $this->db->resultSet();

    return $result;
  }

  public function absenMasuk($data)
  {
    $tanggal = today();
    $jam_masuk = timeNow();
    $keterangan = $data[1];
    if ($data[0] == 'hadir') {
      $keterangan = 'Hadir';
    } elseif ($data[0] == 'izin') {
      $keterangan = 'Izin';
    } elseif ($data[0] == 'cuti') {
      $keterangan = 'Cuti';
    } else {
      $keterangan = 'Tidak Hadir';
    }

    $query = "INSERT INTO " . $this->table . " (nip, tanggal, jam_masuk, keterangan) 
    VALUES (:nip, :tanggal, :jam_masuk, :keterangan)";

    $this->db->query($query);
    $this->db->bind('nip', $_SESSION['nip']);
    $this->db->bind('tanggal', $tanggal);
    $this->db->bind('jam_masuk', $jam_masuk);
    $this->db->bind('keterangan', $keterangan);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function absenCuti($data)
  {
    $tanggal = today();
    $jam_masuk = timeNow();
    $keterangan = 'Cuti';

    // // get day diff between cuti date
    $cuti_mulai = strtotime($data['cuti_mulai']);
    $cuti_akhir = strtotime($data['cuti_berakhir']);
    $datediff = $cuti_akhir - $cuti_mulai;

    $daysDiff = round($datediff / (60 * 60 * 24));

    if ($daysDiff < 1) {
      return false;
    }

    $query = "INSERT INTO " . $this->table . " (nip, tanggal, jam_masuk, keterangan, cuti_mulai, cuti_berakhir) 
    VALUES (:nip, :tanggal, :jam_masuk, :keterangan, :cuti_mulai, :cuti_berakhir)";

    $this->db->query($query);
    $this->db->bind('nip', $_SESSION['nip']);
    $this->db->bind('tanggal', $tanggal);
    $this->db->bind('jam_masuk', $jam_masuk);
    $this->db->bind('keterangan', $keterangan);
    $this->db->bind('cuti_mulai', $data['cuti_mulai']);
    $this->db->bind('cuti_berakhir', $data['cuti_berakhir']);
    $this->db->execute();

    return $this->db->rowCount();
  }


  public function absenPulang()
  {
    $tanggal = today();
    $jam_pulang = timeNow();

    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE tanggal=:tanggal AND nip=:nip');
    $this->db->bind('tanggal', $tanggal);
    $this->db->bind('nip', $_SESSION['nip']);
    $result = $this->db->single();

    $this->db->query('UPDATE ' . $this->table . ' SET jam_pulang=:jam_pulang WHERE id=:id');
    $this->db->bind(':id', $result->id);
    $this->db->bind(':jam_pulang', $jam_pulang);

    //execute 
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function konfirmasi($data)
  {
    $id = $data[1];
    if ($data[0] == 'diterima') {
      $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
      $this->db->bind('id', $id);
      $absen = $this->db->single();

      $ket = 'Diterima';

      if ($absen->keterangan == 'Cuti') {
        $this->db->query('UPDATE ' . $this->table . ' SET konfirmasi=:konfirmasi WHERE id=:id');
        $this->db->bind(':id', $id);
        $this->db->bind(':konfirmasi', $ket);
        $this->db->execute();

        // // get day diff between cuti date
        $cuti_mulai = strtotime($absen->cuti_mulai);
        $cuti_akhir = strtotime($absen->cuti_berakhir);
        $datediff = $cuti_akhir - $cuti_mulai;

        $daysDiff = round($datediff / (60 * 60 * 24));
        $tanggal = date('Y-m-d', strtotime('+1 days'));

        for ($i = 0; $i < $daysDiff; $i++) {
          $query = "INSERT INTO " . $this->table . " (nip, tanggal, jam_masuk, keterangan, konfirmasi, cuti_mulai, cuti_berakhir) 
    VALUES (:nip, :tanggal, :jam_masuk, :keterangan, :konfirmasi, :cuti_mulai, :cuti_berakhir)";

          $this->db->query($query);
          $this->db->bind('nip', $absen->nip);
          $this->db->bind('tanggal', $tanggal);
          $this->db->bind('jam_masuk', $absen->jam_masuk);
          $this->db->bind('keterangan', 'Cuti');
          $this->db->bind('konfirmasi', 'Diterima');
          $this->db->bind('cuti_mulai', $absen->cuti_mulai);
          $this->db->bind('cuti_berakhir', $absen->cuti_berakhir);
          $this->db->execute();
          $tanggal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal)));
        }

        return $this->db->rowCount();
      } else {
        $this->db->query('UPDATE ' . $this->table . ' SET konfirmasi=:konfirmasi WHERE id=:id');
        $this->db->bind(':id', $id);
        $this->db->bind(':konfirmasi', $ket);
        //execute 
        if ($this->db->execute()) {
          return true;
        } else {
          return false;
        }
      }
    } else {
      $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
  }

  //batas maksimal cuti model
  public function getDataCutiByYearAndUserLogged()
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE YEAR(tanggal)=:tahun AND keterangan=:keterangan AND nip=:nip');
    $this->db->bind('tahun', date('Y'));
    $this->db->bind('keterangan', 'Cuti');
    $this->db->bind('nip', $_SESSION['nip']);
    $result = $this->db->resultSet();

    return $result;
  }
}
