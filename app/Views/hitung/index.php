<?= $this->extend('layout/index'); ?>
<?= $this->section('content'); ?>

<div id="matriks" >
  <div class="col-12">
    <div class="card mt-5">
      <!-- /.card-header -->
      <center>
        <h5>List Data Kriteria</h5>
      </center>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Kode Kriteria</th>
            <th scope="col">Nama Kriteria</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php foreach ($kriteria as $row) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $row['kode_kriteria']; ?></td>
              <td><?= $row['kriteria']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <form action="/hitung/matrix" id="hitungMat" method="post">
    <div class="col-12">
      <div class="card mt-5">
        <!-- /.card-header -->
        <center>
          <h5>Matriks Perbandingan Kriteria</h5>
        </center>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <?php foreach ($kriteria as $row) : ?>
                <th scope="col"><?= $row['kode_kriteria']; ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0; ?>
            <?php foreach ($kriteria as $row) : ?>
              <?php $cek = false; ?>
              <tr>
                <th scope="row">K<?= ($i + 1 < 10) ? '0' . ($i + 1) : ($i + 1); ?></th>
                <?php for ($j = 0; $j < count($kriteria); $j++) : ?>
                  <?php if ($cek == false) : ?>
                    <?php if ($i == $j) : ?>
                      <?php $cek = true; ?>
                      <td><input type="number" name="<?= $i . '_' . $j; ?>" min=0 step="0.01" max=9 style="width:35px;" readonly value="1" id="<?= $i . '_' . $j; ?>" require/></td>
                      <?php continue; ?>
                    <?php endif; ?>
                    <td><input type="text" name="<?= $i . '_' . $j; ?>" min=0 step="0.01" max=9 style="width:35px;" readonly id="<?= $i . '_' . $j; ?>" require /></td>
                  <?php else : ?>
                    <td><input type="number" name="<?= $i . '_' . $j; ?>" min=0 step="0.01" max=9 style="width:35px;" id="<?= $i . '_' . $j; ?>" onkeyup="getInverse(this, event)" require /></td>
                  <?php endif; ?>
                <?php endfor; ?>
              </tr>
              <?php $i++; ?>
            <?php endforeach; ?>
        </table>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->

    <center>
      <button type="submit" class="btn btn-primary btn-lg">Hitung</button>
    </center>
  </form>
</div>

  <!-- /.col -->



  <?= $this->endSection(); ?>

  <?= $this->section('myscript'); ?>
  <script>
    $(function() {
      $('#example2').DataTable();
    });

    function getInverse(element, e) {
      let id = element.id;
      id = id.split("_");
      const inverseId = `#${id[1]}_${id[0]}`;
      const newValue = e.target.value;
      if (newValue == "" || newValue == 0) {
        $(inverseId).val('');
      } else {
        $(inverseId).val(1 / newValue);
      }
    }

    function getInversSub(element, e) {
      let id = element.id;
      id = id.split("_");
      const inverseId = `#${id[0]}_${id[2]}_${id[1]}`;
      const newValue = e.target.value;
      if (newValue == "" || newValue == 0) {
        $(inverseId).val('');
      } else {
        $(inverseId).val(1 / newValue);
      }
    }

    function getInverseAl(element, e) {
      let id = element.id;
      id = id.split("_");
      const inverseId = `#${id[1]}_${id[0]}_a`;
      const newValue = e.target.value;
      if (newValue == "" || newValue == 0) {
        $(inverseId).val('');
      } else {
        $(inverseId).val(1 / newValue);
      }
    }


    $(document).ready(function() {
    $("#hitungMat").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    $.ajax({
        type: "POST",
        url: '<?php echo base_url('hitung/matrix'); ?>',
        data: new FormData(this), 
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function(){
          $("#matriks").html('<div class="text-center" >Processed</div>');
        },
        complete: function() {},
        success: function(kriteria)
        {
          
          var data = jQuery.parseJSON(kriteria);
          console.log(JSON.stringify(data.kriteria))
          $("#matriks").html(data.view);
          document.getElementById("hasil_kriteria").value = JSON.stringify(data.kriteria)
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError)
        }
    });
    });
    });

  </script>
  <?= $this->endSection(); ?>