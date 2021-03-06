
          <?php if(isset($_SESSION['user_id'])) : ?>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Fifth navbar example">
            <div class="container container-fluid">
            <a class="navbar-brand" href="<?php echo URLROOT.'bookings/index' ?>"><img src="<?php echo URLROOT ?>public/img/logo.png" alt="logo dreamRent" width="48" height="48"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample05">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="<?php echo URLROOT.'bookings/index' ?>">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo URLROOT ?>pages/about">About</a>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="#">Welcome <?php echo $_SESSION['user_firstName'] ?></a>
                </li>
                <?php if($_SESSION['user_email']=='zitouni.sd@gmail.com') : ?>
                  <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="<?php echo URLROOT ?>admins/logout">Log Out</a>
                  </li>
                <?php else : ?>
                  <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="<?php echo URLROOT ?>users/logout">Log Out</a>
                </li>
                <?php endif; ?>
      <?php else : ?>
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Fifth navbar example">
          <div class="container container-fluid">
          <a class="navbar-brand" href="<?php echo URLROOT ?>"><img src="<?php echo URLROOT ?>public/img/logo.png" alt="logo dreamRent" width="48" height="48"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

          <div class="collapse navbar-collapse" id="navbarsExample05">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?php echo URLROOT ?>">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT ?>pages/about">About</a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?php echo URLROOT ?>users/register">Register</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT ?>users/login">Login</a>
              </li>
        <?php endif; ?>
        </ul>
      </div>
    
    </div>
  </nav>
  <div class="container">
