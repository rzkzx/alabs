<?php
class Absen extends Controller
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
      'title' => 'Absen',
      'menu' => 'Absen',
    ];

    $this->view('absen/index', $data);
  }
}
