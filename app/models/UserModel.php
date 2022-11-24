
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
    $query = "SELECT * FROM users WHERE nip = :nip";
    $this->db->query($query);
    $this->db->bind(':nip', $_SESSION['nip']);

    $user = $this->db->single();
    if ($user) {
      if (password_verify($data['password'], $user->password)) {
        $query = "UPDATE users SET password=:password WHERE nip=:nip";
        $this->db->query($query);
        $this->db->bind(':nip', $_SESSION['nip']);
        $this->db->bind(':password', password_hash($data['newPassword'], PASSWORD_DEFAULT));

        $this->db->execute();
        return $this->db->rowCount();
      } else {
        return 0;
      }
    } else {
      return 0;
    }
  }

  public function changeProfile($data, $files)
  {
    $newAvatarName = $_SESSION['avatar'];
    if ($files['avatar']['size'] > 0) {
      $file_extension = pathinfo($files['avatar']['name'], PATHINFO_EXTENSION);
      $allowed_extension = array(
        "png",
        "jpg",
        "jpeg"
      );

      if (!in_array($file_extension, $allowed_extension)) {
        return false;
      }

      $newAvatarName = $_SESSION['nip'] . '.' . $file_extension;

      if ($files['avatar']['size'] < 2000 * 1000) {
        if ($_SESSION['avatar'] == NULL) {
          move_uploaded_file($files['avatar']['tmp_name'], "../public/images/avatar/" . $newAvatarName);
        } else {
          if (unlink("../public/images/avatar/" . $_SESSION['avatar'])) {
            move_uploaded_file($files['avatar']['tmp_name'], "../public/images/avatar/" . $newAvatarName);
          }
        }
      } else {
        return false;
      }
    }

    $query = "UPDATE users SET nip=:nip,nama=:nama,no_hp=:no_hp,email=:email,jenis_kelamin=:jenis_kelamin,avatar=:avatar WHERE nip=:nip";
    $this->db->query($query);
    $this->db->bind(':nip', $_SESSION['nip']);
    $this->db->bind(':nip', $data['nip']);
    $this->db->bind(':nama', $data['nama']);
    $this->db->bind(':no_hp', $data['no_hp']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':jenis_kelamin', $data['jenis_kelamin']);
    $this->db->bind(':avatar', $newAvatarName);

    if ($this->db->execute()) {
      $_SESSION['nip'] = $data['nip'];
      $_SESSION['nama'] = $data['nama'];
      $_SESSION['email'] = $data['email'];
      $_SESSION['no_hp'] = $data['no_hp'];
      $_SESSION['avatar'] = $newAvatarName;

      return true;
    } else {
      return false;
    }
  }
}
