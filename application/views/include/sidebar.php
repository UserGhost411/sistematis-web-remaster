<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
  <div class="sidebar-brand d-none d-md-flex">
    <img class="sidebar-brand-full" height="38" src="<?= base_url("public/assets/img/logo_text_light.png") ?>" alt="Sistematis Logo">
    <img class="sidebar-brand-narrow" height="38" src="<?= base_url("public/assets/img/logo.png") ?>" alt="Sistematis Logo">
  </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <?php

      $parents = $this->db->order_by("menu_position", "asc")->get_where("menu", ["menu_parent" => 0, "menu_privilege" => $this->userdata->account_level])->result();
      $childs = [];
      foreach ($this->db->get_where("menu", ["menu_parent !=" => 0])->result() as $val) {
        if (!isset($childs[$val->menu_parent])) $childs[$val->menu_parent] = [];
        $childs[$val->menu_parent][] = $val;
      }
      foreach ($parents as $val) {
        if ($val->menu_icon == "" && $val->menu_endpoint == "#") {
          echo "<li class=\"nav-title\">" . $val->menu_name . "</li>\n";
          continue;
        }
        $hasChild = isset($childs[$val->id]);
        echo "<li class=\"nav-" . ($hasChild ? "group" : "item") . "\"><a class=\"nav-link" . ($hasChild ? " nav-group-toggle" : "") . "\" href=\"" . base_url($val->menu_endpoint) . "\">
      <span class=\"nav-icon\"> " . $val->menu_icon . " </span> " . $val->menu_name . "
      </a>\n";
        if ($hasChild) {
          echo "<ul class=\"nav-group-items\">\n";
          foreach ($childs[$val->id] as $ch) {
            echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"" . base_url($ch->menu_endpoint) . "\"><span class=\"nav-icon\"></span> " . $ch->menu_name . "</a></li>\n";
          }
          echo "</ul>\n";
        }
        echo "</li>\n";
        $childs[$val->menu_parent][] = $val;
      }
      ?>
      <li class="nav-title mt-auto">Support</li>
      <li class="nav-item"><a class="nav-link" href="https://coreui.io/docs/templates/installation/" target="_blank">
          <span class="nav-icon">
            <i class="far fa-book-spells"></i>
          </span> Documentation</a></li>

    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
  </div>