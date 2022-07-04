<?= $this->extend('layout/index'); ?>
<?= $this->section('content'); ?>

<div id="matriks" >
  <div class="col-12">
    <div class="card mt-5">
      <!-- /.card-header -->
      <center>
        <h5>Hasil Akhir Perhitungan</h5>
      </center>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Kode Alternatif</th>
            <th scope="col">Nama Alternatif</th>
            <th scope="col">Nilai Alternatif</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php foreach ($alternatif as $row) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $row['kode_alternatif']; ?></td>
              <td><?= $row['alternatif']; ?></td>
              <td><?= $row['hasil']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
  
  