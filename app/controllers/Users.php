<?php
class Users extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }
    if (!Middleware::admin()) {
      return redirect('login');
    }

    //new model instance
    $this->userModel = $this->model('UserModel');
  }

  public function index()
  {
    $users = $this->userModel->getAll();

    $data = [
      'title' => 'Daftar Pengguna',
      'menu' => 'Daftar Pengguna',
      'users' => $users
    ];

    $this->view('pengguna/index', $data);
  }

  public function add()
  {
    $data = [
      'title' => 'Tambah Pengguna Baru',
      'menu' => 'Daftar Pengguna'
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['nip']) || empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['no_hp']) || empty($_POST['jenis_kelamin'])) {
        //load view with error
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('users/add');
      } else {
        if ($this->userModel->register($_POST)) {
          setFlash('Pengguna baru berhasil ditambahkan.', 'success');
          return redirect('users');
        } else {
          die('something went wrong');
        }
      }
    } else {
      $this->view('pengguna/add', $data);
    }
  }

  public function edit($id = '')
  {
    $data['title'] = 'Perbarui Data Pengguna';
    $data['menu'] = 'Daftar Pengguna';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      //validate error free
      if (empty($_POST['nip']) || empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['no_hp']) || empty($_POST['jenis_kelamin'])) {
        //load view with error
        setFlash('Form input tidak boleh kosong', 'danger');
        return redirect('users/edit/' . $_POST['id']);
      } else {
        if ($this->userModel->update($_POST, $id)) {
          setFlash('Data pengguna berhasil diperbarui.', 'success');
          return redirect('users');
        } else {
          die('something went wrong');
        }
      }
    } else {
      $user = $this->userModel->getUserById($id);
      if ($user) {
        $data['id'] = $id;
        $data['user'] = $user;

        $this->view('pengguna/edit', $data);
      } else {
        return redirect('users');
      }
    }
  }

  public function delete($id = '')
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->userModel->delete($id)) {
        setFlash('Berhasil menghapus data pengguna', 'success');
      } else {
        setFlash('Gagal menghapus data pengguna', 'danger');
      }
    } else {
      return redirect('users');
    }
  }
}
