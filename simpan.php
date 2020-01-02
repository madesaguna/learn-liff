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

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
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
        $no_kk = $_POST['no_kk'];
        $alamat = $_POST['alamat'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $nama_kelurahan = $_POST['nama_kelurahan'];
        $nama_kecamatan = $_POST['nama_kecamatan'];
        $nama_kabupaten = $_POST['nama_kabupaten'];
        $nama_provinsi = $_POST['nama_provinsi'];
        $no_telp = $_POST['no_telp'];

        $data = getData($conn, $nik);

        //$msg = $_POST['nik'] . ' tidak terdaftar. Silakan daftar melalui link di bawah <a href="#" onclick="showRegistration()">Daftar</a>';

        if(!check_number($no_kk)) {
            $error = true;
            $result['msg']['no_kk'] = 'No. KK harus angka!';
        }
        
        if(!check_empty($no_kk)) {
            $error = true;
            $result['msg']['no_kk'] = 'No. KK tidak boleh kosong!';
        }

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
        
        if(!check_empty($alamat)) {
            $error = true;
            $result['msg']['alamat'] = 'Alamat tidak boleh kosong!';
        }
        
        if(!check_empty($nama_kelurahan)) {
            $error = true;
            $result['msg']['nama_kelurahan'] = 'Nama Desa/Kelurahan tidak boleh kosong!';
        }
        
        if(!check_empty($nama_kecamatan)) {
            $error = true;
            $result['msg']['nama_kecamatan'] = 'Nama Kecamatan tidak boleh kosong!';
        }
        
        if(!check_empty($nama_kabupaten)) {
            $error = true;
            $result['msg']['nama_kabupaten'] = 'Nama Kabupaten tidak boleh kosong!';
        }
        
        if(!check_empty($nama_provinsi)) {
            $error = true;
            $result['msg']['nama_provinsi'] = 'Nama Provinsi tidak boleh kosong!';
        }

        if(!check_number($no_telp)) {
            $error = true;
            $result['msg']['no_telp'] = 'No. Telepon harus angka!';
        }

        if(!check_empty($no_telp)) {
            $error = true;
            $result['msg']['no_telp'] = 'No. Telepon tidak boleh kosong!';
        }

        if(!validateDate($tanggal_lahir)) {
            $error = true;
            $result['msg']['tanggal_lahir'] = 'Tanggal lahir tidak valid!';
        }

        if(!check_empty($tanggal_lahir)) {
            $error = true;
            $result['msg']['tanggal_lahir'] = 'Tanggal lahir tidak boleh kosong!';
        }

        if(!check_empty($tempat_lahir)) {
            $error = true;
            $result['msg']['tempat_lahir'] = 'Tempat lahir tidak boleh kosong!';
        }

        if(!$error) {
            $stmt = $conn->prepare("INSERT INTO pemilih (no_kk, nik, nama, tempat_lahir, tanggal_lahir, alamat, nama_kelurahan, nama_kecamatan, nama_kabupaten, nama_provinsi, no_hp) VALUES (
                :no_kk, :nik, :nama, :tempat_lahir, :tanggal_lahir,
                :alamat, :nama_kelurahan, :nama_kecamatan, :nama_kabupaten, :nama_provinsi,
                :no_telp)");
            $dataPemilih = [
                ':no_kk' => $no_kk,
                ':nik' => $nik,
                ':nama' => $nama,
                ':tempat_lahir' => $tempat_lahir,
                ':tanggal_lahir' => $tanggal_lahir,
                ':alamat' => $alamat,
                ':nama_kelurahan' => $nama_kelurahan,
                ':nama_kecamatan' => $nama_kecamatan,
                ':nama_kabupaten' => $nama_kabupaten,
                ':nama_provinsi' => $nama_provinsi,
                ':no_telp' => $no_telp,
            ];
            $stmt->execute($dataPemilih);

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
//var_dump($result);
echo json_encode($result);