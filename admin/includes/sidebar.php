<aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="index.php">
                <img
                  alt="image"
                  src="assets/images/logo.png"
                  class="header-logo"
                />
                <span class="logo-name">AL-ASAS</span>
              </a>
            </div>
            <ul class="sidebar-menu">
              <li class="menu-header">Main</li>
              <li class="dropdown <?php  echo isset($variable['dashboard']) ? $variable['dashboard'] : ""; ?>">
                <a href="index.php" class="nav-link"
                  ><i data-feather="monitor"></i><span>Dashboard</span></a
                >
              </li>
              <li class="dropdown <?php  echo isset($variable['exams']) ? $variable['exams'] : ""; ?>">
                <a href="exams.php" class="nav-link"
                  ><i data-feather="book"></i><span>Exams</span></a
                >
              </li>

              <li class="dropdown <?php  echo isset($variable['questions']) ? $variable['questions'] : ""; ?>">
                <a href="questions.php" class="nav-link"
                  ><i data-feather="archive"></i><span>Questions</span></a
                >
              </li>

              <li class="menu-header">Actions</li>
              <li class="dropdown <?php  echo isset($variable['students']) ? $variable['students'] : ""; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"
                  ><i data-feather="users"></i><span>Students</span></a
                >
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="add_student.php">Add Student</a></li>
                  <li>
                    <a class="nav-link" href="view_students.php">View Students</a>
                  </li>
                  <li>
                    <a class="nav-link" href="manage_students.php">Manage Students</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown <?php  echo isset($variable['subjects']) ? $variable['subjects'] : ""; ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"
                  ><i data-feather="book-open"></i><span>Subjects</span></a
                >
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="add_subject.php">Add Subject</a></li>
                  <li>
                    <a class="nav-link" href="manage_subjects.php">Manage Subjects</a>
                  </li>
                </ul>
              </li>
              <li class="menu-header">Others</li>
              <li class="dropdown">
                <a href="#" class="nav-link"
                  ><i data-feather="inbox"></i><span>Complains</span></a
                >
              </li>

              <li class="dropdown">
                <a href="#" class="nav-link"
                  ><i data-feather="user"></i><span>Profile</span></a
                >
              </li>

              <li class="dropdown">
                <a href="#" class="nav-link"
                  ><i data-feather="settings"></i><span>Settings</span></a
                >
              </li>

              <li class="dropdown">
                <a href="logout.php" class="nav-link"
                  ><i data-feather="log-out"></i><span>Log out</span></a
                >
              </li>
            </ul>
          </aside>