
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

  public function getAbsensiKonfirmasiToday(){
    $tanggal = today();

    $this->db->query('SELECT absen.*, users.nama, users.no_hp FROM ' . $this->table . ' LEFT JOIN users ON users.nip=absen.nip WHERE tanggal=:tanggal AND keterangan=:izin OR keterangan=:cuti');
    $this->db->bind('tanggal', $tanggal);
    $this->db->bind('izin', 'Izin');
    $this->db->bind('cuti', 'Cuti');
    $result = $this->db->resultSet();

    return $result;
  }

  public function getRiwayat()
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip ORDER BY id DESC');
    $this->db->bind('nip', $_SESSION['nip']);
    $result = $this->db->resultSet();

    return $result;
  }

  public function getRiwayatUserNIP($nip)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip ORDER BY id DESC');
    $this->db->bind('nip', $nip);
    $result = $this->db->resultSet();

    return $result;
  }

  public function getRiwayatUserNIPByDate($nip, $date)
  {
    $bulan = date("m", strtotime($date));
    $tahun = date("Y", strtotime($date));

    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip AND MONTH(tanggal) = :bulan AND YEAR(tanggal) = :tahun ORDER BY id DESC');
    $this->db->bind('nip', $nip);
    $this->db->bind('bulan', $bulan);
    $this->db->bind('tahun', $tahun);
    $result = $this->db->resultSet();

    return $result;
  }

  public function getRiwayatUserLogged()
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip ORDER BY id DESC');
    $this->db->bind('nip', $_SESSION['nip']);
    $result = $this->db->resultSet();

    return $result;
  }

  public function getRiwayatUserLoggedByDate($date)
  {
    $bulan = date("m", strtotime($date));
    $tahun = date("Y", strtotime($date));

    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE nip=:nip AND MONTH(tanggal) = :bulan AND YEAR(tanggal) = :tahun ORDER BY id DESC');
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
    if($data[0] == 'diterima'){
      $ket = 'Diterima';
    }else{
      $ket = 'Ditolak';
    }

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
}
