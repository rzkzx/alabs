<?php
class Dashboard extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }

    //new model instance
    $this->userModel = $this->model('UserModel');
  }

  public function index()
  {
    $users = $this->userModel->getAll();
    $admin = $this->userModel->getAdmin();

    $data = [
      'title' => 'Dashboard',
      'menu' => 'Dashboard',
      'users' => $users,
      'admin' => $admin
    ];

    $this->view('dashboard/index', $data);
  }
}
