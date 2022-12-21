
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

  public function getRiwayat()
  {
    $this->db->query('SELECT ' . $this->surat . '.*,' . $this->jenis . '.nama_jenis FROM ' . $this->surat . ' LEFT JOIN ' . $this->jenis . ' ON ' . $this->jenis . '.id=' . $this->surat . '.jenis_surat ORDER BY id DESC');
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

  public function absenMasuk($data)
  {
    $tanggal = today();
    $jam_masuk = timeNow();
    $keterangan = $data[1];
    if ($data[0] == 'hadir') {
      $keterangan = 'Hadir';
    } elseif ($data[0] == 'izin') {
      $keterangan = 'Izin';
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
}
