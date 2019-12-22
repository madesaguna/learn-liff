<?php

$identities = ['76', '72'];
$result = [
    'error' => true,
    'msg' => 'Not implemented'
];
if(isset($_POST['nik'])) {
    $msg = $_POST['nik'] . ' tidak terdaftar. silakan daftar melalui link di bawah <a href="#" onclick="showRegistration()">Daftar</a>';
    if(in_array($_POST['nik'], $identities)) {
        $msg = $_POST['nik'] . ' A/N ... telah didaftarkan. Tunggu petugas PPS untuk memverifikasi berkas anda!';
    }
    $result = [
        'error' => false,
        'msg' => $msg
    ];
}


echo json_encode($result);