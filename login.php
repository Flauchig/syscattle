<?php
require_once 'config.php';

if (isset($_POST['usuario']) && isset($_POST['senha'])) {
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];

  try {
    $sql = "SELECT 
              usuario,
              cargo
            FROM
              login  
            WHERE  
              usuario = :usuario 
              AND senha = :senha";

    $sql_query = $conexao->prepare($sql);
    $sql_query->bindParam(":usuario", $usuario, PDO::PARAM_STR);
    $sql_query->bindParam(":senha", $senha, PDO::PARAM_STR);
    $sql_query->execute();
    $resultado = $sql_query->fetch(PDO::FETCH_ASSOC);

    if ($sql_query->rowCount() > 0) {
      // echo "<script>alert('Logado com sucesso'); window.location.href = 'index.php';</script>";
          echo "<script> window.location.href = 'index.php';</script>";

      $_SESSION['usuario'] = $usuario;
      $_SESSION['senha'] = $senha;
      $_SESSION['cargo'] = $cargo;
   
      exit();
    } else {
       echo "<script> window.location.href = 'login.php';</script>";

          // echo "<script>alert('É necessário estar logado para acessar o sistema'); window.location.href = 'login.php';</script>";


      
      unset($_SESSION['usuario']);
      unset($_SESSION['senha']);
      unset($_SESSION['cargo']); 
    
      exit();
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}




?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SysCattle</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login SysCattle</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">SysCattle</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">LOGIN</h5>
                    <p class="text-center small">Entre com seu nome e senha </p>
                  </div>

                  <form class="row g-3 needs-validation" action="login.php" method="post">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Usuário</label>
                      <div class="input-group has-validation">
                        <input type="text" name="usuario" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Por favor coloque o nome de usuário.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Senha</label>
                      <input type="password" name="senha" class="form-control" id="senha" required>
                      <div class="invalid-feedback">Por favor coloque a senha!</div>
                    </div>


                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>

                  </form>

                </div>
              </div>

              Develop by <a href="https://www.instagram.com/rafael.vasconcellos8/">
                <svg width="120" height="25" viewBox="0 0 570 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M147 2.13331C143.667 3.19997 134.733 4.66664 127 5.46664C109.133 7.06664 101.533 9.59997 96.3333 15.4666C91 21.6 91.1333 24.2666 96.7333 19.0666C100.867 15.0666 106.867 11.3333 107.533 12.2666C107.8 12.5333 106.333 18.5333 104.333 25.6C101.533 35.6 99.8 39.3333 97.1333 41.4666C93.4 44.4 92.4666 47.4666 95.6666 46.1333C98.4666 45.0666 98.2 46.4 93.5333 58.2666C89.5333 68.4 89.4 68.6666 82.7333 71.3333C78.8666 72.8 75.5333 74.8 75.2666 75.8666C74.8666 77.2 75.4 77.3333 77.8 76.5333C79.5333 76 82.6 75.3333 84.4666 75.3333C86.3333 75.2 88.6 74.6666 89.4 74.1333C90.3333 73.6 96.6 73.8666 103.4 74.8C117.8 76.6666 123.933 75.4666 131 69.4666C137 64.5333 135.4 62.5333 129.133 67.3333C126.6 69.3333 122.067 71.2 119.133 71.6C111.933 72.5333 91.9333 69.4666 92.8666 67.4666C93.1333 66.6666 95.6666 61.2 98.2 55.3333L102.867 44.6666L111.933 43.7333C120.2 43.0666 128.333 40.9333 128.333 39.4666C128.333 39.2 123.267 39.3333 117 39.7333C110.733 40 105.667 39.8666 105.667 39.2C105.667 37.6 111.4 11.4666 111.933 10.8C112.2 10.4 118.467 9.7333 126.067 9.19997C141.933 8.1333 149.533 6.26664 153.933 2.66664C157.667 -0.400028 155.667 -0.533362 147 2.13331Z" fill="#060505" />
                  <path d="M193.667 3.86666C193.667 4.53333 195.4 5.33333 197.533 5.73333C206.467 7.6 207.4 12.9333 201 26C198.067 32 181.667 54.6667 173 64.6667L169.533 68.6667L170.6 56.6667C171.933 42 172.067 8.53333 170.733 7.33333C170.333 6.8 166.067 8.26666 161.267 10.5333C150.867 15.4667 141.667 24.8 141.667 30.2667C141.8 34 141.8 33.8667 144.333 29.0667C147 24 153.8 18.6667 164.067 13.4667L169.667 10.6667V19.0667C169.667 23.6 168.733 34.6667 167.667 43.3333C165.4 61.4667 165.133 76 166.867 76C168.6 76 181.667 61.2 190.733 48.9333C198.733 38.4 208.333 19.8667 208.333 15.0667C208.333 10 205.533 5.46666 201.267 4C196.333 2.4 193.667 2.26666 193.667 3.86666Z" fill="#060505" />
                  <path d="M460.6 12C452.467 26.5333 445.667 50.4 445.667 63.7333C445.667 72.2666 448.2 77.3333 452.467 77.3333C455.933 77.3333 464.333 72.9333 467.533 69.4666C470.867 65.7333 468.867 66 462.333 70C453.267 75.6 448.333 73.6 448.333 64.2666C448.333 57.3333 454.467 35.8666 460.867 20.4C467.4 4.39998 467.533 3.99998 465.933 3.99998C465.4 3.99998 463 7.59998 460.6 12Z" fill="#060505" />
                  <path d="M487.267 12C479.133 26.5333 472.333 50.4 472.333 63.7333C472.333 72.2666 474.867 77.3333 479.133 77.3333C482.067 77.3333 489.133 74 492.467 71.0666C494.467 69.4666 495.133 69.7333 498.733 73.3333C503.267 77.7333 506.6 78.2666 512.2 75.4666C521.267 70.6666 529.667 55.3333 529.667 43.3333C529.667 35.6 528.733 33.6 524.067 31.2C518.6 28.4 516.467 30.4 521.667 33.6C525.933 36.1333 526.067 36.2666 525.4 44.4C523.4 68.5333 501.4 84 498.067 63.7333C496.733 55.3333 505.133 41.0666 514.2 36.4C516.467 35.2 517.667 34 516.733 33.7333C514.333 32.9333 507.667 36.8 503.8 41.4666C498.333 48 495 55.3333 495 61.2C495 66.1333 494.467 66.8 489.267 70C479.667 75.6 475 73.7333 475 64.2666C475 57.3333 481.133 35.8666 487.533 20.4C494.067 4.39998 494.2 3.99998 492.6 3.99998C492.067 3.99998 489.667 7.59998 487.267 12Z" fill="#060505" />
                  <path d="M33.9333 11.2C22.2 17.6 17 21.7333 14.4667 27.0667C12.0667 32.4 11.6667 36 13.6667 36C14.4667 36 15 34.9333 15 33.6C15 29.7333 18.8667 25.3333 27.4 19.8667C31.8 17.0667 35.8 14.6667 36.3333 14.6667C37.8 14.6667 24.7333 51.7333 21.1333 57.8667C16.8667 65.0667 9.26665 71.8667 4.19999 72.9333C0.599985 73.6 -1.40001 76 1.66665 76C4.46665 76 13 71.8667 15.9333 69.0667C18.7333 66.4 19.1333 66.4 21.4 68.4C24.7333 71.4667 32.8667 74.6667 37.4 74.6667C45.4 74.6667 54.2 70.4 61.8 62.8C78.3333 46.2667 82.7333 23.7333 71.6667 12.6667C64.3333 5.33333 53.9333 5.2 45.1333 12.1333L41.6667 14.9333L43 11.3333C45.2667 5.33333 45 5.33333 33.9333 11.2ZM66.4667 14.1333C81.4 24 70.8667 56.5333 49.4 67.2C41 71.4667 33.8 71.6 26.2 67.8667L20.4667 65.2L25 56.9333C27.5333 52.4 31.2667 43.7333 33.5333 37.7333C38.7333 23.7333 40.8667 20.4 48.2 15.7333C55 11.4667 61.4 10.9333 66.4667 14.1333Z" fill="#060505" />
                  <path d="M367.667 30.1334C365.533 31.3334 362.2 33.6001 360.467 35.2001L357.4 38.0001L358.333 33.3334C359.267 29.3334 359.133 28.9334 357.267 30.4001C352.6 34.4001 336.6 72.5334 338.067 76.2667C338.6 77.3334 339.133 76.8001 339.8 74.8001C340.333 73.0667 343.667 65.7334 347.133 58.5334C352.2 48.1334 354.733 44.5334 359.267 41.3334C365.933 36.4001 372.333 32.9334 373.133 33.7334C373.4 34.0001 371.267 41.2001 368.2 49.7334C360.067 73.3334 362.067 80.2667 375 72.2667L381.8 68.0001L382.867 71.0667C386.067 79.2001 393.667 78.9334 401 70.2667C407.533 62.6667 406.867 61.2001 399.667 67.8667C390.333 76.5334 385.667 74.9334 385.667 63.0667C385.667 51.7334 394.067 38.9334 404.333 34.6667C406.6 33.7334 408.333 32.5334 408.333 31.8667C408.333 28.0001 395.267 34.4001 389.933 40.8001C385.267 46.4001 381.667 55.6001 381.667 62.0001C381.667 65.6001 380.867 66.5334 375.667 69.0667C363.533 74.9334 363.267 73.2001 371.933 49.8667C376.6 37.0667 377.8 32.5334 376.733 30.8001C374.867 27.8667 372.333 27.7334 367.667 30.1334Z" fill="#060505" />
                  <path d="M325.667 30.6667C325.667 31.4667 327.133 32.8 329 33.6C335.133 36.4 335 46.9333 328.867 59.6C322.733 72.2667 313.933 76.8 308.467 69.8667C302.6 62.4 306.733 49.4667 317.933 39.3333C321.667 36 323.8 33.3333 322.6 33.3333C319.667 33.3333 308.467 43.7333 305.667 49.2C301.8 56.9333 301.133 62.8 303.667 68.9333C310.2 85.2 328.867 76 335.533 53.3333C338.733 42.5333 338.333 37.7333 333.8 33.2C329.933 29.3333 325.667 28 325.667 30.6667Z" fill="#060505" />
                  <path d="M224.333 34.6666C206.733 44.2666 193.4 67.8666 201.667 75.3333C204.733 78.1333 209.8 77.2 215.8 72.6666L219.8 69.6L221.267 73.4666C222.067 75.6 223.8 77.3333 225 77.3333C227.4 77.3333 233 72.1333 236.467 66.6666L238.733 63.3333L240.733 68.1333C245.533 79.7333 261.933 77.2 265.8 64.1333C267.8 57.3333 265.933 53.8666 258.2 50.6666C255 49.2 252.333 47.4666 252.333 46.5333C252.333 41.8666 268.067 33.3333 276.6 33.3333C277.933 33.3333 279 32.6666 279 32C279 28 260.867 33.2 254.2 38.9333C247.8 44.6666 248.333 48.6666 256.333 53.3333C263.8 57.7333 264.6 61.2 259.133 66.6666C251.8 74.1333 244.067 71.0666 241.8 59.6L240.867 55.3333L236.733 61.3333C231.933 68.4 226.067 74.1333 224.867 72.9333C223.933 72 227.4 54.6666 230.2 46.8C232.467 40.5333 233 34.6666 231.267 36.6666C230.6 37.4666 228.2 42.9333 225.8 48.9333C221 60.9333 216.867 67.2 211.4 70.9333C205.533 74.6666 203 74.1333 203 68.9333C203 58.9333 216.867 40.8 228.867 35.0666C231.533 33.8666 233.667 32.4 233.667 31.7333C233.667 30 232.067 30.5333 224.333 34.6666Z" fill="#060505" />
                  <path d="M291.267 33.4667C284.467 36.8 279.8 42.6667 276.2 52C273.133 60 273 65.2 275.533 71.2C279 79.6 287.933 78.6667 294.467 69.2C299.267 62.1334 298.067 61.6 291.8 68C283.4 76.6667 277.667 74.5334 277.667 62.8C277.667 52.5334 287 39.0667 297.133 34.4C300.467 32.8 301.4 30.6667 298.733 30.6667C297.8 30.6667 294.467 32 291.267 33.4667Z" fill="#060505" />
                  <path d="M428.2 33.3334C422.333 36.4 415.4 44.1334 412.6 50.5334C408.067 61.6 411.4 76 418.867 77.0667C422.333 77.6 433.667 66.8 433.667 62.9334C433.667 61.4667 431.8 62.8 428.2 66.9334C422.2 74 418.867 74.9334 415.8 70.4C409.933 62.1334 416.467 44.6667 428.067 37.7334C434.067 34 436.333 33.8667 436.333 37.2C436.333 40.4 424.867 51.8667 420.733 52.8C417.133 53.7334 416.6 56 420.067 56C423.4 56 433.933 49.2 437.4 44.6667C442.067 38.6667 440.733 30.5334 435.133 30.6667C433.933 30.8 430.867 31.8667 428.2 33.3334Z" fill="#060505" />
                  <path d="M558.067 32.5333C551.133 34.8 543.533 39.4666 542.467 42.1333C540.2 47.8666 541.533 50.6666 547.667 53.3333C552.867 55.6 553.667 56.4 553.667 60C553.667 65.3333 548.467 70.6666 543.133 70.6666C538.6 70.6666 533.667 65.4666 533.667 60.5333C533.667 58.9333 533 57.0666 532.2 56.5333C531 55.8666 530.867 57.6 531.267 62.6666C531.8 68.2666 532.733 70.5333 535.533 72.9333C544.467 80.6666 558.467 71.7333 557.4 58.9333C557 54.5333 556.333 53.7333 550.733 50.9333C543.533 47.6 543 45.7333 547.533 41.4666C550.867 38.2666 562.733 33.3333 567 33.3333C568.467 33.3333 569.667 32.6666 569.667 32C569.667 30.2666 564.867 30.4 558.067 32.5333Z" fill="#060505" />
                </svg>
              </a>
            </div>

          </div>
        </div>
    </div>

    </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>