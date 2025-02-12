<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.png') ?>">
    <title>Geografis Sekolah Tangsel</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?= base_url('assets/css/nucleo-svg.css') ?>" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url('assets/css/argon-dashboard.css?v=2.0.4') ?>" rel="stylesheet" />
</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-lg-5 col-12 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Masuk</h4>
                                    <p class="mb-0">Masukkan <i>Email</i> dan <i>Password</i> yang benar.</p>
                                </div>

                                <div class="card-body">
                                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                        <div class="alert alert-danger alert-dismissible fade show border-0" role="alert">
                                            <span class="alert-text text-white fw-bold text-sm"><i>Email</i> atau <i>password</i> anda salah!</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>

                                    <form role="form" method="POST" action="<?= base_url('login/process') ?>">
                                        <?= csrf_field(); ?>
                                        <div class="mb-3">
                                            <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" name="user_email" value="<?= old('user_email') ?>">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="user_password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Masuk</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('./assets/images/bg-sign-in.jpg'); background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <img src="<?= base_url('/assets/images/logo.png') ?>" alt="" width="100" class="mx-auto position-relative" style="opacity: 0.8;">
                                <h4 class="mt-3 text-white font-weight-bolder position-relative" style="opacity: 0.9;"><i class="fas fa-map-marker-alt me-1" style="color: #ffffff;"></i> Geografis Sekolah Tangsel</h4>
                                <p class="text-white position-relative text-sm font-weight-bold" style="opacity: 0.9;">Sistem informasi ini merupakan aplikasi pemetaan geografis sekolah di wilayah Kota Tangsel. Aplikasi ini memuat informasi dan lokasi dari sekolah di Kota Tangsel.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url('assets/js/argon-dashboard.min.js?v=2.0.4') ?>"></script>
</body>

</html>
