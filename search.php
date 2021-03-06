<?php

header('Content-Type: application/json');

/* init db */
$connectionString = parse_url(getenv('DATABASE_URL'));
$servername = $connectionString['host'];
$username = $connectionString['user'];
$password = $connectionString['pass'];
$port = $connectionString['port'];
$db = substr($connectionString['path'], 1);

$result = [
    'error' => true,
    'status' => 'error',
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

    if(isset($_POST['nik'])) {
        $data = getData($conn, $_POST['nik']);
        $msg = $_POST['nik'] . ' tidak terdaftar. Silakan daftar melalui link di bawah <a href="#" onclick="showRegistration()">Daftar</a>';
        $result['status'] = 'unregistered';
        if($data !== false) {
            $msg = "NIK {$data['nik']} A/N {$data['nama']} telah didaftarkan. Tunggu petugas PPS untuk memverifikasi berkas anda!";
            $result['status'] = 'registered';
        }
        $result['error'] = false;
        $result['msg'] = $msg;
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

echo json_encode($result);