<?php $can_change_session = (hasPermission($this, "change_session", "r")); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="Sistematis Pelindo Sub Regional 3">
  <meta name="author" content="UserGhost411">
  <meta name="keyword" content="Sistematis">
  <title>Sistematis</title>
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url("public/assets/favicon/favicon-32x32.png") ?>">
  <link rel="manifest" href="<?= base_url("public/assets/favicon/manifest.json") ?>">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="<?= base_url("public/vendors/simplebar/css/simplebar.css") ?>">
  <link rel="stylesheet" href="<?= base_url("public/css/vendors/simplebar.css") ?>">
  <link rel="stylesheet" href="<?= base_url("public/vendors/fa/css/all.min.css") ?>">
  <link href="<?= base_url("public/css/style.css") ?>" rel="stylesheet">
  <link href="<?= base_url("public/css/examples.css") ?>" rel="stylesheet">
  <link href="<?= base_url("public/vendors/%40coreui/chartjs/css/coreui-chartjs.css") ?>" rel="stylesheet">
  <link href="<?= base_url("public/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css") ?>" rel="stylesheet">
  <link href="<?= base_url("public/vendors/sweetalert2/sweetalert2.min.css") ?>" rel="stylesheet" title="lightswal" <?= (isset($_COOKIE["display_theme"]) && $_COOKIE["display_theme"] == "dark") ? "disabled" : "" ?>>
  <link href="<?= base_url("public/vendors/sweetalert2/sweetalert2-dark.min.css") ?>" rel="stylesheet" title="darkswal" <?= (isset($_COOKIE["display_theme"]) && $_COOKIE["display_theme"] == "dark") ? "" : "disabled" ?>>
  <link href="<?= base_url("public/vendors/fullcalendar/css/main.css") ?>" rel="stylesheet">
  <link href="<?= base_url("public/vendors/select2/css/select2.min.css") ?>" rel="stylesheet">
  <link href="<?= base_url("public/vendors/select2/css/select2-bs.min.css") ?>" rel="stylesheet" aa="lightselect" <?= (isset($_COOKIE["display_theme"]) && $_COOKIE["display_theme"] == "dark") ? "disabled" : "" ?>>
  <link href="<?= base_url("public/vendors/select2/css/select2-bs-dark.min.css") ?>" rel="stylesheet" aa="darkselect" <?= (isset($_COOKIE["display_theme"]) && $_COOKIE["display_theme"] == "dark") ? "" : "disabled" ?>>

  <script src="<?= base_url("public/vendors/jquery/js/jquery.min.js") ?>"></script>
  <script src="<?= base_url("public/js/cookies.js") ?>"></script>
</head>

<body class="<?= (isset($_COOKIE["display_theme"]) && $_COOKIE["display_theme"] == "dark") ? "dark-theme" : "" ?>">
  <?php include("include/sidebar.php") ?>
  <?php include("include/sidebar_overlay.php") ?>
  <div class="wrapper d-flex flex-column min-vh-100 bg-light dark:bg-transparent">
    <?php include("include/navbar.php") ?>

    <div class="body flex-grow-1 px-3">
      <div class="container-lg">
        <?php $this->view($view) ?>
      </div>
    </div>
    <footer class="footer">
      <div>Sistematis</a> © <?= date("Y") ?> by UserGhost411<small id="display-debug-render" class="d-none"> - Page loaded in {elapsed_time} Sec</small><small class="d-none" id="display-debug-memory"> - {memory_usage}</small></div>
      <div class="ms-auto">Version 1.0.0</div>
    </footer>
  </div>
  <?php if ($can_change_session) $this->load->view('include/modal', ["id"=>"ChgSessionModal","prefix"=>"csm","size" => "md", "title" => "Change Session", "vertical" => true, "add_btn" => '<button type="button" class="btn btn-primary" href="'. base_url("account/change_session/as") .'" base_url="'. base_url("") .'" onclick="change_session(this);">Change Session</button>']); ?>
  <script src="<?= base_url("public/js/theme.js") ?>"></script>
  <!-- CoreUI and necessary plugins-->
  <script src="<?= base_url("public/vendors/moment/moment.js") ?>"></script>
  <script src="<?= base_url("public/vendors/%40coreui/coreui-pro/js/coreui.bundle.min.js") ?>"></script>
  <script src="<?= base_url("public/vendors/simplebar/js/simplebar.min.js") ?>"></script>
  <script src="<?= base_url("public/vendors/sweetalert2/sweetalert2.all.min.js") ?>"></script>
  <script src="<?= base_url("public/vendors/select2/js/select2.full.min.js") ?>"></script>
  <script src="<?= base_url("public/vendors/fullcalendar/js/main.js") ?>"></script>
  <!-- Plugins and scripts required by this view-->
  <script src="<?= base_url("public/vendors/chart.js/js/chart.min.js") ?>"></script>
  <script src="<?= base_url("public/vendors/%40coreui/chartjs/js/coreui-chartjs.js") ?>"></script>
  <script src="<?= base_url("public/vendors/%40coreui/utils/js/coreui-utils.js") ?>"></script>

  <script src="<?= base_url("public/vendors/datatables.net/js/jquery.dataTables.js") ?>"></script>
  <script src="<?= base_url("public/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js") ?>"></script>
  <script src="<?= base_url("public/vendors/moment/datetime-moment.js") ?>"></script>
  <script src="<?= base_url("public/js/main.js") ?>" defer></script>
  <?php if ($can_change_session){ ?><script src="<?= base_url("public/js/change_session.js") ?>" defer></script><?php } ?>
</body>

</html>