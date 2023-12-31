<?php
$adminData = getAdminByUsername($_SESSION['s_adminUsername']);
?>

<nav class="navbar navbar-expand-lg main-navbar sticky">
          <div class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
              <li>
                <a
                  href="#"
                  data-toggle="sidebar"
                  class="nav-link nav-link-lg collapse-btn"
                >
                  <i data-feather="align-justify"></i
                ></a>
              </li>
              <li>
                <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                  <i data-feather="maximize"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
              <li class="text-bold" style="font-size: 1.2rem">
                AL-ASAS Administrator
              </li>
            </ul>
          </div>

          <ul class="navbar-nav navbar-right">
            <li class="dropdown">
              <a
                href="#"
                data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"
              >
                <img
                  alt="image"
                  src="<?php echo $adminData['avatar'] ?>"
                  class="user-img-radious-style" />
                <span class="d-sm-none d-lg-inline-block"></span
              ></a>
              <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Hello, <b><?php echo $adminData['fullname'] ?></b></div>
                <a href="profile.html" class="dropdown-item has-icon">
                  <i class="far fa-user"></i> Profile
                </a>
                <a href="#" class="dropdown-item has-icon">
                  <i class="fas fa-cog"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a
                  href="logout.php"
                  class="dropdown-item has-icon text-danger"
                >
                  <i class="fas fa-sign-out-alt"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>