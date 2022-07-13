<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <center>
            <span class="brand-text font-weight-light"><b>SPK</b></span><br>
            <span class="brand-text font-weight-light"><b>Penilaian Kualitas Produk</b></span>
        </center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/Dashboard" class="nav-link <?php if ($head == "Dashboard") echo "active"; ?>">
                        <i class=" nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
            <a href="#" class="nav-link" >
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="/kriteria" class="nav-link <?php if ($head == "Data Kriteria") echo "active"; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kriteria</p>
                </a>
              </li>
                <li class="nav-item">
                    <a href="/Subkriteria" class="nav-link <?php if ($head == "Data Subkriteria") echo "active"; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Subkriteria</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Alternatif" class="nav-link <?php if ($head == "Data Alternatif") echo "active"; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Alternatif</p>
                    </a>
                </li>
            </ul>
            <li>
                    <hr style="border-top:0.5px solid grey;">
                </li>
                <li class="nav-item">
                    <a href="/Hitung" class="nav-link <?php if ($head == "Perhitungan Fuzzy AHP") echo "active"; ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Hasil Perhitungan</p>
                    </a>
                </li>
                
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>