<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistematis Login</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?= base_url("public/login/css/materialdesignicons.min.css") ?>">
  <link rel="stylesheet" href="<?= base_url("public/login/css/vendor.bundle.base.css") ?>">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url("public/login/css/dark/style.css") ?>" id="darkTheme" disabled>
  <link rel="stylesheet" href="<?= base_url("public/login/css/light/style.css") ?>" id="lightTheme">
  <!-- endinject -->
  <style>
    @media (max-width: 991px) {
      .hide-show {
        display: none !important;
      }
    }

    @media (max-width: 991px) {
      .show-hide {
        display: flex !important;
      }
    }

    .show-hide {
      display: none;
    }

    .hide-show {
      display: flex;
    }

    .auth .login-half-bg {
      background: url("<?= base_url("public/login/bg.jpg") ?>");
      background-size: auto;
      background-size: cover;
    }

    @font-face {
      font-family: 'sansation';
      src: url('<?= base_url("public/login/fonts/Sansation_Bold.ttf") ?>') format('woff'), url('<?= base_url("public/login/fonts/Sansation_Bold.ttf") ?>') format('truetype');
    }
  </style>
  <link rel="shortcut icon" href="/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">

      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">

        <div class="row flex-grow">
          <div class="col-lg-8 login-half-bg flex-row hide-show">
            <p class="text-white font-weight-normal text-center flex-grow align-self-end">Copyleft © <?= date("Y") ?>
              <a class="text-dark" href="https://userghost.my.id/" target="_blank">UserGhost411</a>. All
              rights
              reserved.
            </p>
          </div>
          <div class="col-lg-4 ">
            <div class="d-flex flex-row-reverse" style="height: 20px;">
              <a class="float-right pr-2" style="font-size: 30px;" href="#" id="modeSwitcher">
                <i class="mdi mdi-weather-sunny"></i>
              </a>
            </div>
            <div class="d-flex align-items-center justify-content-center h-100">
              <div class="auth-form-transparent text-left p-0 w-75">
                <div class="brand-logo text-center mb-2">
                  <img class="login-brand-dark" src="<?= base_url("public/assets/img/logo_dark.png") ?>" alt="Sistematis logo">
                  <img class="login-brand-light" src="<?= base_url("public/assets/img/logo.png") ?>" alt="Sistematis logo">
                </div>

                <h2 class="text-center mb-4 login-brand-text">SISTEMATIS</h2>

                <h4>Welcome back!</h4>

                <h6 class="font-weight-light pb-2">Happy to see you again!</h6>
                <?php if ($this->session->has_userdata("login_msg")) { ?>
                  <div class="alert alert-warning alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?= $this->session->userdata("login_msg") ?>
                  </div>
                <?php } ?>
                <form class="" method="POST">

                  <div class="form-group">
                    <label for="exampleInputEmail">Username</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-account-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="text" name="username" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Username">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-primary"></i>
                        </span>
                      </div>
                      <input type="password" name="password" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password">
                    </div>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" name="remember_me">
                        Keep me signed in
                      </label>
                    </div>

                  </div>
                  <div class="my-3">
                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                  </div>

                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-8 login-half-bg flex-row show-hide">
            <p class="text-white font-weight-normal text-center flex-grow align-self-end">Copyleft © <?= date("Y") ?>
              <a class="text-dark" href="https://userghost.my.id/" target="_blank">UserGhost411</a>. All
              rights
              reserved.
            </p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="<?= base_url("public/login/js/vendor.bundle.base.js") ?>"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?= base_url("public/login/js/template.js") ?>"></script>
  <script src="<?= base_url("public/login/js/modeswitch.js") ?>"></script>
  <!-- endinject -->
</body>

</html>