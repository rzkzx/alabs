
<?php
class UserModel
{
  private $db;
  public function __construct()
  {
    $this->db = new Database;
  }

  public function login($nip, $password)
  {
    $this->db->query('SELECT * FROM users WHERE nip = :nip');
    $this->db->bind(':nip', $nip);

    $row = $this->db->single();

    $hash_password = $row->password;

    if (password_verify($password, $hash_password)) {
      return $row;
    } else {
      return false;
    }
  }

  //register new user
  public function register($data)
  {
    $role = 'user';

    $this->db->query('INSERT INTO users (nip,nama, email, no_hp, jenis_kelamin, password,role) VALUES (:nip,:nama,:email, :no_hp, :jenis_kelamin, :password,:role)');
    $this->db->bind(':nip', $data['nip']);
    $this->db->bind(':nama', $data['nama']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':no_hp', $data['no_hp']);
    $this->db->bind(':jenis_kelamin', $data['jenis_kelamin']);
    $this->db->bind(':password', password_hash($data['nip'], PASSWORD_DEFAULT));
    $this->db->bind(':role', $role);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getAll()
  {
    $role = 'user';

    $this->db->query('SELECT * FROM users WHERE role = :role');
    $this->db->bind(':role', $role);

    $row = $this->db->resultSet();

    return $row;
  }

  public function getUserById($id)
  {
    $this->db->query('SELECT * FROM users WHERE id = :id');
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }

  public function getByLogin()
  {
    $query = "SELECT * FROM users WHERE nip = :nip";
    $this->db->query($query);
    $this->db->bind(':nip', $_SESSION['nip']);

    $row = $this->db->single();

    return $row;
  }

  public function delete($id)
  {
    $this->db->query('DELETE FROM users WHERE id = :id');
    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function update($data, $id)
  {
    if (!$data['password']) {
      $query = "UPDATE users SET nip=:nip,nama=:nama,email=:email,no_hp=:no_hp,jenis_kelamin=:jenis_kelamin WHERE id=:id";
      $this->db->query($query);
      $this->db->bind(':id', $id);
      $this->db->bind(':nip', $data['nip']);
      $this->db->bind(':nama', $data['nama']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':no_hp', $data['no_hp']);
      $this->db->bind(':jenis_kelamin', $data['jenis_kelamin']);
    } else {
      $query = "UPDATE users SET nip=:nip,nama=:nama,email=:email,no_hp=:no_hp,jenis_kelamin=:jenis_kelamin,password=:password WHERE id=:id";
      $this->db->query($query);
      $this->db->bind(':id', $id);
      $this->db->bind(':nip', $data['nip']);
      $this->db->bind(':nama', $data['nama']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':no_hp', $data['no_hp']);
      $this->db->bind(':jenis_kelamin', $data['jenis_kelamin']);
      $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
    }

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function changePassword($data)
  {
    $query = "SELECT * FROM users WHERE username = :username";
    $this->db->query($query);
    $this->db->bind(':username', $_SESSION['username']);

    $user = $this->db->single();
    if ($user) {
      if (password_verify($data['password'], $user->password)) {
        $query = "UPDATE users SET password=:password WHERE username=:username";
        $this->db->query($query);
        $this->db->bind(':username', $_SESSION['username']);
        $this->db->bind(':password', password_hash($data['password_baru'], PASSWORD_DEFAULT));

        $this->db->execute();
        return $this->db->rowCount();
      } else {
        return 0;
      }
    } else {
      return 0;
    }
  }
}
