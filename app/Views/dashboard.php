<?= $this->extend('layout/index'); ?>
<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h4><?php echo $count_krit ; ?></h4>
                        <p>Data Kriteria</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h4><?php echo $count_sub ; ?></h4>
                        <p>Data Subkriteria</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h4><?php echo $count_alternatif ; ?></h4>
                        <p>Data Alternatif</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12">
            <div class="card mt-10">
                <center>
                    <h4>Tentang Askha Jaya</h4>
                </center>
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
    <center>  
    <img class="d-block w-90" src="/assets/images/askha1.jpg" alt="First slide">
</center>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Second slide">
    </div>
  </div>
</div>
            </div>
        </div>   
        
    </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('myscript'); ?>
<script>
    $(function() {
        $('#example2').DataTable();
    });
</script>
<?= $this->endSection(); ?>