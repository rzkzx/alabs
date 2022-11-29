
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
  public function getAbsenToday()
  {
    $tanggal = today();

    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE tanggal=:tanggal');
    $this->db->bind('tanggal', $tanggal);
    $row = $this->db->single();

    if ($row) {
      return $row;
    } else {
      return 0;
    }
  }
  public function get()
  {
    $this->db->query('SELECT ' . $this->surat . '.*,' . $this->jenis . '.nama_jenis FROM ' . $this->surat . ' LEFT JOIN ' . $this->jenis . ' ON ' . $this->jenis . '.id=' . $this->surat . '.jenis_surat ORDER BY id DESC');
    $result = $this->db->resultSet();

    return $result;
  }

  public function getSuratKeluarById($id)
  {
    $this->db->query('SELECT ' . $this->surat . '.*,' . $this->jenis . '.nama_jenis FROM ' . $this->surat . ' LEFT JOIN ' . $this->jenis . ' ON ' . $this->jenis . '.id=' . $this->surat . '.jenis_surat WHERE ' . $this->surat . '.id=:id');
    $this->db->bind('id', $id);
    $row = $this->db->single();

    return $row;
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

    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE tanggal=:tanggal');
    $this->db->bind('tanggal', $tanggal);
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
