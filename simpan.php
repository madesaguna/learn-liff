<?php

/* init db */

$connectionString = parse_url(getenv('DATABASE_URL'));
$servername = $connectionString['host'];
$username = $connectionString['user'];
$password = $connectionString['pass'];
$port = $connectionString['port'];
$db = substr($connectionString['path'], 1);

$result = [
    'error' => true,
    'status' => 'unregistered',
    'msg' => 'Not implemented'
];


function getData($conn, $id) {

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('SELECT nik,nama FROM pemilih WHERE nik=:id');
    $stmt->execute(['id' => $id]);
    //var_dump($stmt->fetch(PDO::FETCH_ASSOC));
    $row =  $stmt->fetch();
    return $row;

}
try{
    $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
        $servername, $port, $db, $username, $password);
    $conn = new PDO($conStr);

    if(isset($_POST)) {
        $data = getData($conn, $_POST['nik']);
        $msg = $_POST['nik'] . ' tidak terdaftar. Silakan daftar melalui link di bawah <a href="#" onclick="showRegistration()">Daftar</a>';
        if($data !== false) {
            $result['error'] = true;
            $msg = "NIK {$data['nik']} sudah pernah didaftarkan.!";
            $result['status'] = 'failed';
        }
        else {
            $stmt = $conn->prepare("INSERT INTO pemilih (nik, nama, no_hp) VALUES (:nik, :nama, :no_telp)");
            $dataPemilih = [
                ':nik' => $_POST['nik'],
                ':nama' => $_POST['nama'],
                ':no_telp' => $_POST['no_telp'],
            ];
            $stmt->execute($dataPemilih);
            $result['error'] = false;
            $result['msg'] = "Data Pemilih {$_POST['nik']} telah disimpan. Tunggu PPS menghubungi anda untuk verifikasi!";
        }

    }
} catch (PDOException $e) {
    $result['msg'] = $e->getMessage();
}

echo json_encode($result);