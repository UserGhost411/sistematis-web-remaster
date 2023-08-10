
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Cycology,IT-Telkom Cycology,CTF Cycology,CycoCTF">
  <meta name="author" content="UserGhost411">
  <title>Register Cycology</title>
  <meta name="keywords" content="Cycology,IT-Telkom Cycology,CTF Cycology,CycoCTF">
  <link rel="icon" href="<?= base_url("public/")?>img/brand/favicon.png" type="image/png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="<?= base_url("public/")?>vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" type="text/css">
  <link rel="stylesheet" href="<?= base_url("public/")?>css/argon.min.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="<?= base_url("public/")?>vendor/sweetalert2/sweetalert2.min.css" type="text/css">
</head>

<body class="bg-default">

  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url("")?>">
        <img src="<?= base_url("public/")?>img/brand/white.png">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
         
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
       
  
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
    
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
           
            <div class="card-body px-lg-4 py-lg-4">
              <div class="text-center text-muted mb-4">
                <small>Sign up with credentials</small>
              </div>
              <form role="form" action="" method="POST">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" id="user" placeholder="username" type="text" style="padding-left:10px;">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <input class="form-control" id="email" placeholder="email" type="email" style="padding-left:10px;">
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input class="form-control" id="pass1" placeholder="Password" type="password" style="padding-left:10px;">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input class="form-control" id="pass2" placeholder="Password Again" type="password" style="padding-left:10px;">
                  </div>
                </div>
                <div class="text-center">
                  <button type="button" id="btn_log" onclick="register(this)" class="btn btn-primary my-2" style="padding-left:50px;padding-right:50px;">Sign up</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="<?= base_url("auth/forgot")?>" class="text-light"><small>Forgot Password?</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="<?= base_url("auth/login")?>" class="text-light"><small>Sign in</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2020 <a href="https://www.userghost.xyz" class="font-weight-bold ml-1" target="_blank">UserGhost411</a>
          </div>
        </div>
      
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?= base_url("public/")?>vendor/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url("public/")?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url("public/")?>vendor/js-cookie/js.cookie.js"></script>
  <script src="<?= base_url("public/")?>vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="<?= base_url("public/")?>vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <script src="<?= base_url("public/")?>vendor/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- Argon JS -->
  <script src="<?= base_url("public/")?>js/argon.min.js?v=1.2.0"></script>
  <script>
  function register(btnlog){
    var user =  document.getElementById("user").value;
    var pass1 =  document.getElementById("pass1").value;
    var pass2 =  document.getElementById("pass2").value;
    var email =  document.getElementById("email").value;
    btnlog.innerHTML = '<i class="fas fa-spinner fa-spin" style="font-size:20px"></i>';
    if(pass1==pass2){
        var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange=function() {
            if (this.readyState == 4 && this.status == 200) {
                btnlog.innerHTML = "Sign up";
                try {
                var jsondata = JSON.parse(this.responseText);
                if(jsondata.status=="1"){
                    window.location = "<?= base_url("auth/login") ?>";
                }else{
                    Swal.fire({ type: 'error',title: 'Oops...',text: jsondata.msg})
                }
                }catch(err) {
                }
            }
            };
            xhttp.open("POST", "<?= base_url("auth/register") ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("user="+user+"&pass="+pass2+"&email="+email);
    }else{
        Swal.fire({ type: 'error',title: 'Oops...',text: "Those passwords didn't match"})
        btnlog.innerHTML = "Sign up";
    }
  }
  </script>
</body>

</html>