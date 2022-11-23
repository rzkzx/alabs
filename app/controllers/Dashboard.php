<?php
class Dashboard extends Controller
{

  public function __construct()
  {
    if (!Middleware::isLoggedIn()) {
      return redirect('login');
    }
  }

  public function index()
  {
    $data = [
      'title' => 'Dashboard',
      'menu' => 'Dashboard',
    ];

    $this->view('dashboard/index', $data);
  }
}
