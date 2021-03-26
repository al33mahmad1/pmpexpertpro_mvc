<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=URLROOT?>/pages/home" class="brand-link text-center"><span class="brand-text">PMP EXPERT PRO</span></a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=URLROOT?>/public/img/profile/a.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?=URLROOT?>/users/profile" class="d-block"><?php echo (isset($_SESSION['PMP_USER_NAME']))? $_SESSION['PMP_USER_NAME']: "Hello Experts";?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?=URLROOT?>/pages/home" class="nav-link">
              <i class="nav-icon fas fa-house-user"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <?php if(isAdmin()):?>
          <li class="nav-item">
            <a href="<?=URLROOT?>/users/list" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <?php endif;?>

          <li class="nav-item">
            <a href="<?=URLROOT?>/assessments/list" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Exams
              </p>
            </a>
          </li>

          <?php if(isAdmin()):?>
          <li class="nav-item">
            <a href="<?=URLROOT?>/questions/list" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                Questions
              </p>
            </a>
          </li>
          <?php endif;?>

          <?php if(false):?>
          <li class="nav-item">
            <a href="<?=URLROOT?>/users/monitor" class="nav-link">
              <i class="nav-icon fas fa-eye"></i>
              <p>
                Monitor Users
              </p>
            </a>
          </li>
          <?php endif;?>

          <?php if(false):?>
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compose</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif;?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
