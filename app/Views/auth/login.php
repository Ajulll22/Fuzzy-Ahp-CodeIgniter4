<!doctype html>
<html lang="en">

<head>
    <title>FAHP - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/login'); ?>/css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(<?= base_url('assets/login'); ?>/images/askha.jpg);">
                        </div>
                        <div class="login-wrap p-4 p-md-5" style="background-color : #000000 ">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4 text-white">Sistem Pendukung Keputusan Penilaian Kualitas Produk</h3>
                                </div>
                            </div>
                            <?php if (session()->getFlashdata('errlog') == TRUE) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session()->getFlashdata('errlog') ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?= base_url('Auth/validasi'); ?>" method="post" class="signin-form">
                                <div class="form-group mb-3">
                                    <label class="label text-white" for="email">Email</label>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label text-white" for="password">Password</label>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="<?= base_url('assets/login'); ?>/js/jquery.min.js"></script>
    <script src="<?= base_url('assets/login'); ?>/js/popper.js"></script>
    <script src="<?= base_url('assets/login'); ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/login'); ?>/js/main.js"></script>

</body>

</html>