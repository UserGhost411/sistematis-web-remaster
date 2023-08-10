<header class="header header-sticky mb-4">
  <div class="container-fluid">
    <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
      <svg class="icon icon-lg">
        <use xlink:href="<?= base_url("public/vendors/@coreui/icons/svg/free.svg") ?>#cil-menu"></use>
      </svg>
    </button><a class="header-brand d-md-none" href="#">
      <img class="navbar-brand-dark" height="38" src="<?= base_url("public/assets/img/logo_text_light.png") ?>" alt="Sistematis Logo">
      <img class="navbar-brand-light" height="38" src="<?= base_url("public/assets/img/logo_text_dark.png") ?>" alt="Sistematis Logo">

      <ul class="header-nav d-none d-md-flex">
        <li class="nav-item"><a class="nav-link" href="<?= base_url("/") ?>">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url("/account") ?>">Profile</a></li>
        <?php  if ($this->session->has_userdata('sistms_uid_master') && $this->session->userdata('sistms_uid_master') != $this->session->userdata('sistms_uid')) { ?>
          <li class="nav-item"><a class="nav-link" href="<?= base_url("/account/change_session/back") ?>">Back to "<?= $this->userdata_master->account_name ?>"</a></li>
        <?php } ?>
      </ul>
      <nav class="header-nav ms-auto">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="changeTheme()" id="btn-theme-changer">
          <i class="fas fa-sun"></i>
        </button>
      </nav>
      <ul class="header-nav me-3">

        <li class="nav-item dropdown d-md-down-none"><a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <svg class="icon icon-lg my-1 mx-2">
              <use xlink:href="<?= base_url("public/vendors/@coreui/icons/svg/free.svg") ?>#cil-bell"></use>
            </svg><span class="badge rounded-pill position-absolute top-0 end-0 bg-info-gradient"><?= count($this->notifs) ?></span></a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg pt-0">
            <div class="dropdown-header bg-light dark:bg-white dark:bg-opacity-10"><strong>You have <?= count($this->notifs) ?> Notifications</strong></div>
            <?php foreach ($this->notifs as $val) { ?>
              <a class="dropdown-item" href="<?= base_url("home/notif/" . $val->id) ?>">
                <div class="message">
                  <div class="py-3 me-3 float-start">
                    <div class="avatar"><img class="avatar-img" src="<?= base_url("public/assets/img/logo_bg.png") ?>" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                  </div>
                  <div><small class="text-medium-emphasis"><?= htmlspecialchars($val->notif_sender) ?></small><small class="text-medium-emphasis float-end mt-1">Just now</small></div>
                  <div class="text-truncate font-weight-bold"><span class="text-danger"> </span> <?= htmlspecialchars($val->notif_title) ?></div>
                  <div class="small text-medium-emphasis text-truncate"><?= htmlspecialchars(substr($val->notif_text, 0, 100)) ?></div>
                </div>
              </a>
            <?php } ?>
          </div>
        </li>
      </ul>
      <ul class="header-nav me-4">
        <li class="nav-item dropdown d-flex align-items-center"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <div class="avatar avatar-md"><img class="avatar-img" src="<?= base_url("public/assets/img/logo_bg.png") ?>" alt="user@email.com"></div>
          </a>
          <div class="dropdown-menu dropdown-menu-end pt-0">
            <div class="dropdown-header bg-light py-2 dark:bg-white dark:bg-opacity-10">
              <div class="fw-semibold"><?= htmlspecialchars($this->userdata->account_name) ?></div>
            </div>
            <a class="dropdown-item" href="<?= base_url("account") ?>">
              <svg class="icon me-2">
                <use xlink:href="<?= base_url("public/vendors/@coreui/icons/svg/free.svg") ?>#cil-user"></use>
              </svg> Profile
            </a>
            <a class="dropdown-item" href="<?= base_url("account/log") ?>">
              <svg class="icon me-2">
                <use xlink:href="<?= base_url("public/vendors/@coreui/icons/svg/free.svg") ?>#cil-shield-alt"></use>
              </svg> Login Logs
            </a>
            <?php if ($can_change_session) { ?>
              <button class="dropdown-item" onclick="return show_session_switch(this);" href="<?= base_url("account/change_session/switcher") ?>">
                <svg class="icon me-2">
                  <use xlink:href="<?= base_url("public/vendors/@coreui/icons/svg/free.svg") ?>#cil-transfer"></use>
                </svg> Change Session
              </button>
            <?php }
            if ($this->session->has_userdata('sistms_uid_master') && $this->session->userdata('sistms_uid_master') != $this->session->userdata('sistms_uid')) {
            ?>
              <a class="dropdown-item" href="<?= base_url("account/change_session/back") ?>">
                <svg class="icon me-2">
                  <use xlink:href="<?= base_url("public/vendors/@coreui/icons/svg/free.svg") ?>#cil-transfer"></use>
                </svg> Return Session
              </a>
            <?php }
            ?>
            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
              <svg class="icon me-2">
                <use xlink:href="<?= base_url("public/vendors/@coreui/icons/svg/free.svg") ?>#cil-lock-locked"></use>
              </svg> Lock Account</a><a class="dropdown-item" href="<?= base_url("auth/logout") ?>">
              <svg class="icon me-2">
                <use xlink:href="<?= base_url("public/vendors/@coreui/icons/svg/free.svg") ?>#cil-account-logout"></use>
              </svg> Logout</a>
          </div>
        </li>
      </ul>
      <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#aside')).show()">
        <svg class="icon icon-lg">
          <use xlink:href="<?= base_url("public/vendors/@coreui/icons/svg/free.svg") ?>#cil-applications-settings"></use>
        </svg>
      </button>
  </div>
  <div class="header-divider"></div>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
          <!-- if breadcrumb is single--><span>Home</span>
        </li>
        <?php
        $total_segments = $this->uri->total_segments() + 1;
        if ($total_segments == 1) {
          echo '<li class="breadcrumb-item active"><span id="nav_seg1">Dashboard</span></li>';
        } else {
          for ($i = 1; $i < $total_segments; $i++) {
            if ($i == 1 && $total_segments > 2) {
              echo '<li class="breadcrumb-item ' . (($i + 1) == $total_segments ? "active" : "") . '"><span id="nav_seg' . $i . '"><a href="' . base_url($this->uri->segment($i)) . '">' . ucwords($this->uri->segment($i)) . "</a></span></li>";
              continue;
            }
            echo '<li class="breadcrumb-item ' . (($i + 1) == $total_segments ? "active" : "") . '"><span id="nav_seg' . $i . '">' . ucwords($this->uri->segment($i)) . "</span></li>";
          }
        }

        ?>

      </ol>
    </nav>
  </div>
</header>