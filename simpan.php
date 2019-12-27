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

function check_empty($txt) {
    if(empty($txt) || $txt === '') {
        return false;
    }
    return true;
}

// is number
function check_number($txt) {
    return (preg_match('/^\d+$/', $txt)) ? true : false;
}

function getData($conn, $id) {
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('SELECT nik, nama FROM pemilih WHERE nik=:id');
    $stmt->execute(['id' => $id]);
    //var_dump($stmt->fetch(PDO::FETCH_ASSOC));
    return $stmt->fetch();
}

//
try{
    $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
        $servername, $port, $db, $username, $password);
    $conn = new PDO($conStr);

    if(isset($_POST)) {
        $result = [
            'error' => true,
            'status' => 'unregistered',
            'msg' => []
        ];

        $error = false;

        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $no_telp = $_POST['no_telp'];

        $data = getData($conn, $nik);

        //$msg = $_POST['nik'] . ' tidak terdaftar. Silakan daftar melalui link di bawah <a href="#" onclick="showRegistration()">Daftar</a>';


        if(!check_number($nik)) {
            $error = true;
            $result['msg']['nik'] = 'NIK harus angka!';
        }

        if($data !== false) {
            $error = true;
            $result['msg']['nik'] = "NIK {$data['nik']} sudah pernah didaftarkan.!";
        }

        if(!check_empty($nama)) {
            $error = true;
            $result['msg']['nama'] = 'Nama Lengkap tidak boleh kosong!';
        }

        if(!check_number($no_telp)) {
            $error = true;
            $result['msg']['no_telp'] = 'No. Telepon harus angka!';
        }

        if(!check_empty($no_telp)) {
            $error = true;
            $result['msg']['no_telp'] = 'No. Telepon tidak boleh kosong!';
        }

        /*$stmt = $conn->prepare("INSERT INTO pemilih (nik, nama, no_hp) VALUES (:nik, :nama, :no_telp)");
        $dataPemilih = [
            ':nik' => $_POST['nik'],
            ':nama' => $_POST['nama'],
            ':no_telp' => $_POST['no_telp'],
        ];
        $stmt->execute($dataPemilih);*/
        if(!$error) {
            $result = [
                'error' => false,
                'status' => 'registered',
                'msg' => "Data Pemilih {$_POST['nik']} telah disimpan. Tunggu PPS menghubungi anda untuk verifikasi!"
            ];
        }


    }
} catch (PDOException $e) {
    $result['msg'] = $e->getMessage();
}

echo json_encode($result);