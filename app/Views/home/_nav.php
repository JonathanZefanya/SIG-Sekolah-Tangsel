<div class="container position-sticky z-index-sticky top-0">
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid px-0">
                    <a class="navbar-brand font-weight-bolder ms-sm-3" href="<?= base_url('/') ?>">
                        <i class="fas fa-map-marker-alt me-1" style="color: #344767;"></i> Geografis Sekolah Tangsel
                    </a>
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                        <ul class="navbar-nav navbar-nav-hover ms-auto">
                            <li class="nav-item ms-lg-auto me-2">
                                <a class="nav-link nav-link-icon" href="#beranda">
                                    <p class="d-inline text-sm z-index-1 font-weight-bold">Beranda</p>
                                </a>
                            </li>

                            <li class="nav-item ms-lg-auto me-2">
                                <a class="nav-link nav-link-icon" href="#tentang">
                                    <p class="d-inline text-sm z-index-1 font-weight-bold">Tentang</p>
                                </a>
                            </li>

                            <li class="nav-item ms-lg-auto me-2">
                                <a class="nav-link nav-link-icon" href="#sekolah">
                                    <p class="d-inline text-sm z-index-1 font-weight-bold">Data Sekolah</p>
                                </a>
                            </li>

                            <li class="nav-item ms-lg-auto me-2">
                                <a class="nav-link nav-link-icon" href="#peta">
                                    <p class="d-inline text-sm z-index-1 font-weight-bold">Peta Sekolah</p>
                                </a>
                            </li>

                            <?php if (!empty($chatbot_enabled)) : ?>
                                <li class="nav-item ms-lg-auto me-2">
                                    <a class="nav-link nav-link-icon" href="<?= base_url('/chatme') ?>">
                                        <p class="d-inline text-sm z-index-1 font-weight-bold">Chatbot</p>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <li class="nav-item my-auto ms-3 ms-lg-4">
                                <?php if (!session()->get('logged_in')) : ?>
                                    <a href="<?= site_url('/login') ?>" class="btn btn-sm bg-gradient-primary mb-0 me-1 mt-2 mt-md-0">Masuk</a>
                                <?php else : ?>
                                    <a href="<?= site_url('/dashboard') ?>" class="text-sm text-primary fw-bold mb-0 me-1 mt-2 mt-md-0"><?= ucwords(session()->get('user_name')) ?></a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>
