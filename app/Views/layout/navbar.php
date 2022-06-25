<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
    <div class="image">
                <img height=25pt width=25pt src="<?= base_url('assets'); ?>/images/default.png" class="img-circle elevation-2" alt="User Image">
            </div>
    </a>
    <div class="dropdown-menu">
    <div class="info">
                <a href="#" class="d-block"><?= session()->get('username'); ?></a>
            </div>
      <a class="dropdown-item" href="/Auth">Logout</a>
    </div>
  </li>
    </ul>
</nav>
<!-- /.navbar -->