<?php
class Login extends Controller
{
  public function __construct()
  {
    $this->userModel = $this->model('UserModel');
  }

  public function index()
  {
    if (Middleware::isLoggedIn()) {
      return redirect('dashboard');
    } else {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // process form
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'nip' => trim($_POST['nip']),
          'password' => trim($_POST['password']),
        ];

        //make sure error are empty
        if (empty($data['nip']) && empty($data['password'])) {
          setFlash('NIP atau Password Salah', 'danger');
          return redirect('login');
        } else {
          $loggedInUser = $this->userModel->login($data['nip'], $data['password']);
          if ($loggedInUser) {
            //create session
            $this->createUserSession($loggedInUser);
          } else {
            setFlash('NIP atau Password Salah', 'danger');
            return redirect('login');
          }
        }
      } else {
        //init data f f
        $data = [
          'nip' => '',
          'password' => '',
        ];
        //load view
        $this->view('login/index', $data);
      }
    }
    $this->view('login/index', $data);
  }

  //setting user section variable
  public function createUserSession($user)
  {
    $_SESSION['user_id'] = $user->id;
    $_SESSION['nama'] = $user->nama;
    $_SESSION['nip'] = $user->nip;
    $_SESSION['email'] = $user->email;
    $_SESSION['no_hp'] = $user->no_hp;
    $_SESSION['avatar'] = $user->avatar;
    $_SESSION['role'] = $user->role;
    $_SESSION['waktu_login'] = date('Y-m-d H:i:s');
    return redirect('dashboard');
  }

  //logout and destroy user session
  public function logout()
  {
    // add log user
    unset($_SESSION['user_id']);
    unset($_SESSION['nama']);
    unset($_SESSION['nip']);
    unset($_SESSION['avatar']);
    unset($_SESSION['role']);
    unset($_SESSION['waktu_login']);
    session_destroy();
    return redirect('login');
  }
}
