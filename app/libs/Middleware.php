<?php
class Middleware extends Controller
{
  public static function admin()
  {
    if ($_SESSION['role'] == 'admin') {
      return true;
    }
    return false;
  }

  public static function isLoggedIn()
  {
    if (isset($_SESSION['user_id'])) {
      return true;
    } else {
      return false;
    }
  }
}
