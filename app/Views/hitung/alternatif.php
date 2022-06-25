<form action="/hitung/hasil_akhir" method="post">

<input type="text" id="hasil_sub" name="hasil_sub" hidden >
<input type="text" id="hasil_krit" name="hasil_krit" hidden >

    
  <div class="col-12">
    <div class="card mt-5">
      <!-- /.card-header -->

      <table class="table">
      <?php $tot = 0; ?>
      <?php $sub=0; ?>
      <?php foreach($totalSub as $totsub) : ?>
        <thead>
          <tr>
            <th scope="col">#</th>
            <?php foreach ($alternatif as $row) : ?>
                <th scope="col"><?= $row['alternatif']; ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>

        <tbody>
          <?php for ($k=0; $k<$totsub; $k++) : ?>
            <?php $cek = false; ?>
            <tr>
              <th scope="row"><?= $subkriteria[$tot + $k]['kode_subkriteria']; ?></th>
              <?php for ($l = 0; $l < count($alternatif); $l++) : ?>
                <td><select class="form-select" name="<?=$sub. '_'. $k . '_' . $l; ?>">
                  <option selected>--Pilih Nilai--</option>
                  <option value="0">Sangat Kurang</option>
                  <option value="0.25">Kurang</option>
                  <option value="0.5">Cukup</option>
                  <option value="0.75">Baik</option>
                  <option value="1">Sangat Baik</option>
                </select></td>
              <?php endfor; ?>

            </tr>
          <?php endfor; ?>

      <?php $tot += $totsub ; ?>
  
      <?php $sub++; ?>

      <?php endforeach; ?>
      </table>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

  <center>
    <button type="submit" class="btn btn-primary btn-lg">Hitung</button>
  </center>
  </form>