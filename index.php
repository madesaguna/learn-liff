<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cek Pemilih</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
<style>
    #form-identity-register {display: none}
    .error-form, .error-form .error {color:#8b0000}
    .error-form input {border-color: #8b0000}
    .error {display: none}
</style>
    </head>
    <body class="bg-light">
        <div class="container">
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/KPU_Logo.svg/217px-KPU_Logo.svg.png" alt="" width="72">
                <h2>Form pengecekan NIK</h2>
                <p class="lead">Silakan check nama NIK anda!</p>
            </div>
            <div class="py-3">
                <div class="buttonGroup">
                    <div class="buttonRow">
                        <button type="button" class="btn btn-primary" id="openWindowButton">Open External Window</button>
                        <button type="button" class="btn btn-primary" id="closeWindowButton">Close LIFF App</button>
                    </div>
                </div>
            </div>
            <!-- Pencarian -->
            <form id="form-identity-check">
                <div class="form-group">
                    <label for="searchNik">Nomor Induk Kependudukan (No. KTP)</label>
                    <input name="nik" type="text" class="form-control" id="searchNik" aria-describedby="emailHelp" placeholder="Nomor Induk Kependudukan (Contoh : 5171xxx)">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <!-- registrasi -->
            <form id="form-identity-register">
                <h4 class="py-2 text-center">Form Registrasi Pemilih</h4>
                <div class="form-group">
                    <label for="searchNik">Nomor Induk Kependudukan (No. KTP)</label>
                    <input name="nik" type="text" class="form-control" id="nik" aria-describedby="emailHelp" placeholder="Nomor Induk Kependudukan (Contoh : 5171xxx)">
                    <div id="error-reg-nik" class="form-text error"></div>
                </div>
                <div class="form-group">
                    <label for="searchNama">Nama</label>
                    <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama Lengkap">
                    <div id="error-reg-nama" class="form-text error"></div>
                </div>
                <div class="form-group">
                    <label for="registerNoHP">No. HP</label>
                    <input name="no_telp" type="text" class="form-control" id="no_telp" placeholder="081xxx">
                    <div id="error-reg-no_telp" class="form-text error"></div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-primary btn-reg-cancel" onclick="closeRegistrationForm()" href="javascript:void(0);">Batal</a>
            </form>

            <div class="py-5">
                <div id="result" class="text-center"></div>
            </div>

        </div>

        <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="line-starter.js"></script>
        <script src="app.js"></script>
    </body>
</html>