<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Pemilih</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.min.css">
        <style>
            //#form-identity-register {display: none}
            .error-form, .error-form .error {color:#8b0000}
            .error-form input {border-color: #8b0000}
            .error {display: none}
            #result {
                display: none;
                padding: .9em;
                background: #fafad2;
                color: #cd5c5c;
                border: 1px solid #eee8aa;
            }
        </style>
</head>
<body class="bg-light">

<div id="liffAppContent">
<!-- LOGIN LOGOUT BUTTONS -->
    <div class="buttonGroup">
        <button id="liffLoginButton">Log in</button>
        <button id="liffLogoutButton">Log out</button>
    </div>
    <!-- content -->
    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/KPU_Logo.svg/217px-KPU_Logo.svg.png" alt="" width="72">
            <h2>Form Pengecekan Data Pemilih</h2>
            <p class="lead">Silakan check nama NIK anda!</p>
        </div>
        <div class="py-3">
        
            <div class="buttonGroup">
                <div class="buttonRow">
                    <button type="button" class="btn btn-primary btn-sm" id="openWindowButton">Open External Window</button>
                    <button type="button" class="btn btn-primary btn-sm" id="closeWindowButton">Close LIFF App</button>
                </div>
            </div>
        </div>

        <!-- TABS -->
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pencarian</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="registrasi-tab" data-toggle="tab" href="#registrasi" role="tab" aria-controls="registrasi" aria-selected="false">Registrasi</a>
          </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <!-- Pencarian -->
                <h4 class="py-2 text-center">Form Pencarian Pemilih</h4>
                <form id="form-identity-check">
                    <div class="form-group">
                        <label for="searchNik">Nomor Induk Kependudukan (No. KTP)</label>
                        <input name="nik" type="text" class="form-control" id="searchNik" aria-describedby="emailHelp" placeholder="Nomor Induk Kependudukan (Contoh : 5171xxx)">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="tab-pane" id="registrasi" role="tabpanel" aria-labelledby="registrasi-tab">
                <!-- registrasi -->
                <form id="form-identity-register">
                    <h4 class="py-2 text-center">Form Registrasi Pemilih</h4>
                    <div class="form-group">
                        <label for="searchKK">Nomor Induk Kependudukan (No. KTP)</label>
                        <input name="no_kk" type="text" class="form-control" id="no_kk" aria-describedby="searchKK" placeholder="Nomor Kartu Keluarga (Contoh : 5171xxx)">
                        <div id="error-reg-no_kk" class="form-text error"></div>
                    </div>
                    <div class="form-group">
                        <label for="searchNik">Nomor Induk Kependudukan (No. KTP)</label>
                        <input name="nik" type="text" class="form-control" id="nik" aria-describedby="searchNik" placeholder="Nomor Induk Kependudukan (Contoh : 5171xxx)">
                        <div id="error-reg-nik" class="form-text error"></div>
                    </div>
                    <div class="form-group">
                        <label for="searchNama">Nama</label>
                        <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama Lengkap">
                        <div id="error-reg-nama" class="form-text error"></div>
                    </div>
                    <div class="form-group">
                        <label for="searchGender">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <div id="error-reg-jenis_kelamin" class="form-text error"></div>
                    </div>
                    <div class="form-group">
                        <label for="searchTempatLahir">Tempat Lahir</label>
                        <input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir">
                        <div id="error-reg-tempat_lahir" class="form-text error"></div>
                    </div>
                    <div class="form-group">
                        <label for="searchTanggalLahir">Tanggal Lahir</label>
                        <input name="tanggal_lahir" type="text" class="form-control" id="tanggal_lahir" readonly>
                        <div id="error-reg-tanggal_lahir" class="form-text error"></div>
                    </div>
                    <div class="form-group">
                        <label for="searchAlamat">Alamat</label>
                        <input name="alamat" type="text" class="form-control" id="alamat" placeholder="Alamat Lengkap">
                        <div id="error-reg-alamat" class="form-text error"></div>
                    </div>
                    <div class="form-group">
                        <label for="searchNamaKelurahan">Nama Desa/Kelurahan</label>
                        <input name="nama_kelurahan" type="text" class="form-control" id="nama_kelurahan" placeholder="Nama Desa/Kelurahan">
                        <div id="error-reg-nama_kelurahan" class="form-text error"></div>
                    </div>
                    <div class="form-group">
                        <label for="searchNamaKecamatan">Nama Kecamatan</label>
                        <input name="nama_kecamatan" type="text" class="form-control" id="nama_kecamatan" placeholder="Nama Kecamatan">
                        <div id="error-reg-nama_kecamatan" class="form-text error"></div>
                    </div>
                    <div class="form-group">
                        <label for="searchNamaKabupaten">Nama Kabupaten</label>
                        <input name="nama_kabupaten" type="text" class="form-control" id="nama_kabupaten" placeholder="Nama Kabupaten">
                        <div id="error-reg-nama_kabupaten" class="form-text error"></div>
                    </div>
                    <div class="form-group">
                        <label for="searchNamaProvinsi">Nama Provinsi</label>
                        <input name="nama_provinsi" type="text" class="form-control" id="nama_provinsi" placeholder="Nama Provinsi">
                        <div id="error-reg-nama_provinsi" class="form-text error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="registerNoHP">No. HP</label>
                        <input name="no_telp" type="text" class="form-control" id="no_telp" placeholder="081xxx">
                        <div id="error-reg-no_telp" class="form-text error"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-primary btn-reg-cancel" onclick="closeRegistrationForm()" href="javascript:void(0);">Batal</a>
                </form>
            </div>
        </div>
        <div class="py-5">
            <div id="result" class="text-center"></div>
        </div>
    </div>
    
    <div id="statusMessage">
        <div id="isInClientMessage"></div>
        <div id="apiReferenceMessage">
            <p>Available LIFF methods vary depending on the browser you use to open the LIFF app.</p>
            <p>Please refer to the <a href="https://developers.line.biz/en/reference/liff/#initialize-liff-app">API reference page</a> for more information.</p>
        </div>
    </div>
</div>
<!-- LIFF ID ERROR -->
<div id="liffIdErrorMessage" class="hidden">
    <p>You have not assigned any value for LIFF ID.</p>
    <p>If you are running the app using Node.js, please set the LIFF ID as an environment variable in your Heroku account follwing the below steps: </p>
    <code id="code-block">
        <ol>
            <li>Go to `Dashboard` in your Heroku account.</li>
            <li>Click on the app you just created.</li>
            <li>Click on `Settings` and toggle `Reveal Config Vars`.</li>
            <li>Set `MY_LIFF_ID` as the key and the LIFF ID as the value.</li>
            <li>Your app should be up and running. Enter the URL of your app in a web browser.</li>
        </ol>
    </code>
    <p>If you are using any other platform, please add your LIFF ID in the <code>index.html</code> file.</p>
    <p>For more information about how to add your LIFF ID, see <a href="https://developers.line.biz/en/reference/liff/#initialize-liff-app">Initializing the LIFF app</a>.</p>
</div>
<!-- LIFF INIT ERROR -->
<div id="liffInitErrorMessage" class="hidden">
    <p>Something went wrong with LIFF initialization.</p>
    <p>LIFF initialization can fail if a user clicks "Cancel" on the "Grant permission" screen, or if an error occurs in the process of <code>liff.init()</code>.
</div>
<!-- NODE.JS LIFF ID ERROR -->
<div id="nodeLiffIdErrorMessage" class="hidden">
    <p>Unable to receive the LIFF ID as an environment variable.</p>
</div>
<script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="liff-starter.js"></script>
<script src="app.js"></script>
</body>
</html>