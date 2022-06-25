<?= $this->extend('layout/index'); ?>
<?= $this->section('content'); ?>
<body>
    <div class="container">
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addModal">Tambah Data</button>
 
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Alternatif</th>
                    <th>Nama Alternatif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            <?php foreach($alternatif as $row):?>
                <tr>
                    <td><?= $no++;?></td>
                    <td><?= $row['kode_alternatif'];?></td>
                    <td><?= $row['alternatif'];?></td>
                    <td>
                        <a href="#" class="btn btn-dark btn-sm btn-edit" data-id="<?= $row['id'];?>" data-kode="<?= $row['kode_alternatif'];?>" data-alternatif="<?= $row['alternatif'];?>" ><i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url('alternatif/delete/'.$row['id']); ?>" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a> 
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
 
    </div>

    <!-- Modal Add Data-->
    <form action="/alternatif/store" method="post">
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Alternatif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                 
                <div class="form-group">
                    <label>Kode Alternatif</label>
                    <input required type="text" class="form-control" name="kode_alternatif" placeholder="Kode Alternatif">
                </div>
 
                <div class="form-group">
                    <label>Alternatif</label>
                    <input required type="text" class="form-control" name="alternatif" placeholder="Kode Alternatif">
                </div>
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </div>
        </div>
        </div>
    </form>
    <!-- End Modal Add Data-->


        <!-- Modal Edit Data-->
        <form action="/alternatif/update" method="post">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Alternatif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                 
                <div class="form-group">
                    <label>Kode Alternatif</label>
                    <input type="text" class="form-control kode" name="kode" placeholder="Kode Alternatif">
                </div>
 
                <div class="form-group">
                    <label>Alternatif</label>
                    <input type="text" class="form-control alternatif" name="alternatif" placeholder="Kode Alternatif">
                </div>
             
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" class="id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </div>
        </div>
        </div>
    </form>
    <!-- End Modal Edit Data-->
    
    <script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function(){
 
        // get Edit Product
        $('.btn-edit').on('click',function(){
            console.log('test');
            // get data from button edit
            const id = $(this).data('id');
            const kode = $(this).data('kode');
            const alternatif = $(this).data('alternatif');

            // Set data to Form Edit
            $('.id').val(id);
            $('.kode').val(kode);
            $('.alternatif').val(alternatif);

            // Call Modal Edit
            $('#editModal').modal('show');
        });
 
         
    });
    </script>
            
<?= $this->endSection(); ?>