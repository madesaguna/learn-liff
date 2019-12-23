<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cek Pemilih</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">

    </head>
    <body class="bg-light">
        <div class="container">
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/KPU_Logo.svg/217px-KPU_Logo.svg.png" alt="" width="72">
                <h2>Form pengecekan NIK</h2>
                <p class="lead">Silakan check nama NIK anda!</p>
            </div>
            <form id="form-identity-check">
                <div class="form-group">
                    <label for="searchNik">Nomor Induk Kependudukan (No. KTP)</label>
                    <input name="nik" type="text" class="form-control" id="searchNik" aria-describedby="emailHelp" placeholder="Nomor Induk Kependudukan (Contoh : 5171xxx)">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <form id="form-identity-register">
                <div class="form-group">
                    <label for="searchNik">Nomor Induk Kependudukan (No. KTP)</label>
                    <input name="nik" type="text" class="form-control" id="searchNik" aria-describedby="emailHelp" placeholder="Nomor Induk Kependudukan (Contoh : 5171xxx)">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="searchNama">Nama</label>
                    <input name="nama" type="text" class="form-control" id="searchNama" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="registerNoHP">No. HP</label>
                    <input name="no_telp" type="text" class="form-control" id="registerNoHP" placeholder="081xxx">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <div class="py-2">
                <div id="result" class="text-center">
                    Selamat Anda Telah terdaftar sebagai pemilih
                </div>
            </div>

        </div>

        <div id="liffAppContent">
            <!-- ACTION BUTTONS -->
            <div class="buttonGroup">
                <div class="buttonRow">
                    <button id="openWindowButton">Open External Window</button>
                    <button id="closeWindowButton">Close LIFF App</button>
                </div>
                <div class="buttonRow">
                    <button id="scanQrCodeButton">Open QR Code Reader</button>
                    <button id="sendMessageButton">Send Message</button>
                </div>
                <div class="buttonRow">
                    <button id="getAccessToken">Get Access Token</button>
                    <button id="getProfileButton">Get Profile</button>
                </div>
            </div>
            <!-- ACCESS TOKEN DATA -->
            <div id="accessTokenData" class="hidden textLeft">
                <h2>Access Token</h2>
                <a href="#" onclick="toggleAccessToken()">Close Access Token</a>
                <table>
                    <tr>
                        <th>accessToken</th>
                        <td id="accessTokenField"></td>
                    </tr>
                </table>
            </div>
            <!-- SCAN QR RESULT -->
            <div id="scanQr" class="hidden textLeft">
                <h2>QR Code reader</h2>
                <a href="#" onclick="toggleQRCodeReader()">Close QR Code Reader Result</a>
                <table>
                    <tr>
                        <th>scanCode Result</th>
                        <td id="scanQrField"></td>
                    </tr>
                </table>
            </div>
            <!-- PROFILE INFO -->
            <div id="profileInfo" class="hidden textLeft">
                <h2>Profile</h2>
                <a href="#" onclick="toggleProfileData()">Close Profile</a>
                <div id="profilePictureDiv">
                </div>
                <table>
                    <tr>
                        <th>userId</th>
                        <td id="userIdProfileField"></td>
                    </tr>
                    <tr>
                        <th>displayName</th>
                        <td id="displayNameField"></td>
                    </tr>
                    <tr>
                        <th>statusMessage</th>
                        <td id="statusMessageField"></td>
                    </tr>
                </table>
            </div>
            <!-- LIFF DATA -->
            <div id="liffData">
                <h2 id="liffDataHeader" class="textLeft">LIFF Data</h2>
                <table>
                    <tr>
                        <th>OS</th>
                        <td id="deviceOS" class="textLeft"></td>
                    </tr>
                    <tr>
                        <th>Language</th>
                        <td id="browserLanguage" class="textLeft"></td>
                    </tr>
                    <tr>
                        <th>LIFF SDK Version</th>
                        <td id="sdkVersion" class="textLeft"></td>
                    </tr>
                    <tr>
                        <th>isInClient</th>
                        <td id="isInClient" class="textLeft"></td>
                    </tr>
                    <tr>
                        <th>isLoggedIn</th>
                        <td id="isLoggedIn" class="textLeft"></td>
                    </tr>
                </table>
            </div>
            <!-- LOGIN LOGOUT BUTTONS -->
            <div class="buttonGroup">
                <button id="liffLoginButton">Log in</button>
                <button id="liffLogoutButton">Log out</button>
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
        <form id="form_cari" method="post" action="search.php">
            <input type="text" name="nik" id="nik">
            <input type="submit" value="cari">
        </form>

        <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="line-starter.js"></script>
        <script src="app.js"></script>
    </body>
</html>