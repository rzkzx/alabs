<?php
session_start();

function redirect($page)
{
    header('location: ' . URLROOT . '/' . $page);
}

function setFlash($message, $type)
{
    $_SESSION['msg'] = [
        'message' => $message,
        'type' => $type
    ];
}

function flash()
{
    if (isset($_SESSION['msg'])) {
        echo '<div class="alert alert-' . $_SESSION['msg']['type'] . ' alert-dismissible text-center fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            ' . $_SESSION['msg']['message'] . '
        </div>';
    }
    unset($_SESSION['msg']);
}



function dateID($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tahun
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tanggal
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
