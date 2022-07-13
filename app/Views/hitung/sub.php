<div class="col-12">
  <div class="card mt-5">
    <!-- /.card-header -->
    <center>
      <h5>List Data Subkriteria</h5>
    </center>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Kode Subkriteria</th>
          <th scope="col">Nama Subkriteria</th>
          <th scope="col">Kriteria</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        <?php foreach ($subkriteria as $row) : ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['kode_subkriteria']; ?></td>
            <td><?= $row['subkriteria']; ?></td>
            <td><?= $row['kriteria']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<form method="post" name="hitungSub" id="hitungSub">
  <input type="text" id="hasil_kriteria" name="hasil_kriteria" hidden >
<?php $tot = 0; ?>
<?php $sub=0; ?>
  <?php foreach($totalSub as $totsub) : ?>
    
  <div class="col-12">
    <div class="card mt-5">
      <!-- /.card-header -->
      <center>
        <h5>Matriks Perbandingan Subkriteria (<?= $subkriteria[$tot]['kriteria']; ?>)</h5>
      </center>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <?php for ($xx = $tot; $xx < $tot + $totsub; $xx++) : ?>
              <th scope="col"><?= $subkriteria[$xx]['kode_subkriteria']; ?></th>
            <?php endfor; ?>
          </tr>
        </thead>
        <tbody>
          <?php for ($k=0; $k<$totsub; $k++) : ?>
            <?php $cek = false; ?>
            <tr>
              <th scope="row"><?= $subkriteria[$tot + $k]['kode_subkriteria']; ?></th>
              <?php for ($l = 0; $l < $totsub; $l++) : ?>
                <?php if ($cek == false) : ?>
                  <?php if ($k == $l) : ?>
                    <?php $cek = true; ?>
                    <td><input type="number" name="<?=$sub. '_'. $k . '_' . $l; ?>" min=1 step="0.01" max=9 style="width:35px;" readonly value="1" id="<?= $sub. '_'. $k . '_' . $l; ?>" /></td>
                    <?php continue; ?>
                  <?php endif; ?>
                  <td><input type="text" name="<?= $sub. '_'. $k . '_' . $l; ?>" min=1 step="0.01" max=9 style="width:35px;" readonly id="<?= $sub. '_'. $k . '_' . $l; ?>" /></td>
                <?php else : ?>
                  <td><input type="text" name="<?= $sub. '_'. $k . '_' . $l; ?>" min=1 step="0.01" max=9 style="width:35px;" id="<?= $sub. '_'. $k . '_' . $l; ?>" onkeyup="getInversSub(this, event)" /></td>
                <?php endif; ?>
              <?php endfor; ?>
            </tr>
          <?php endfor; ?>
      </table>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <?php $tot += $totsub ; ?>
  
  <?php $sub++; ?>

  <?php endforeach; ?>
  <center>
    <button type="submit" class="btn btn-primary btn-lg">Hitung</button>
  </center>
  </form>

  <script>    
  $( "#hitungSub" ).submit(function( event ) {
      event.preventDefault();
      
      $.ajax({
        type: "POST",
        url: '<?php echo base_url('hitung/matrix_sub'); ?>',
        data: new FormData(this), 
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function(){
          $("#matriks").html('<div class="text-center" >Processed</div>');
        },
        complete: function() {},
        success: function(subKriteria)
        {
          var hasil = jQuery.parseJSON(subKriteria);
          console.log(JSON.stringify(hasil.hasil_sub))
          console.log(hasil.hasil_krit)
          $("#matriks").html(hasil.view);
          document.getElementById("hasil_krit").value = hasil.hasil_krit
          document.getElementById("hasil_sub").value = JSON.stringify(hasil.hasil_sub)
        },
        error: function(xhr, ajaxOptions, thrownError){
          alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError)
        }
    });
    });
  </script>