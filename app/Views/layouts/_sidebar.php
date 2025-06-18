  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
      <div class="sidenav-header">
          <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
          <a class="navbar-brand m-0 mt-3" href="<?= site_url('/') ?>">
              <span class="font-weight-bold d-flex align-items-center text-sm gap-2"><i class="fas fa-map-marker-alt text-sm" style="color: #344767;"></i> Geografis Sekolah Tangsel</span>
          </a>
      </div>
      <hr class="horizontal dark mt-0">
      <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link <?= url_is('dashboard*') ? 'active' : '' ?>" href="<?= site_url('dashboard') ?>">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="fas fa-columns text-dark text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1 font-weight-bold text-dark text-sm">Dashboard</span>
                  </a>
              </li>
              <?php if (session()->get('user_akses') == 'admin') : ?>
                  <li class="nav-item">
                      <a class="nav-link <?= url_is('user*') ? 'active' : '' ?>" href="<?= site_url('user') ?>">
                          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                              <i class="fas fa-users text-dark text-sm opacity-10"></i>
                          </div>
                          <span class="nav-link-text ms-1 font-weight-bold text-dark text-sm">Data Login</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link <?= url_is('chatbot*') ? 'active' : '' ?>" href="<?= site_url('chatbot') ?>">
                          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                              <i class="fas fa-robot text-dark text-sm opacity-10"></i>
                          </div>
                          <span class="nav-link-text ms-1 font-weight-bold text-dark text-sm">Pengaturan Chatbot</span>
                      </a>
                  </li>
              <?php endif; ?>

              <?php if (session()->get('user_akses') != 'sekolah') : ?>
                  <li class="nav-item">
                      <a class="nav-link <?= url_is('kec*') ? 'active' : '' ?>" href="<?= site_url('kec') ?>">
                          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                              <i class="fas fa-building text-dark text-sm opacity-10"></i>
                          </div>
                          <span class="nav-link-text ms-1 font-weight-bold text-dark text-sm">Data Kecamatan</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link <?= url_is('kel*') ? 'active' : '' ?>" href="<?= site_url('kel') ?>">
                          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                              <i class="fas fa-landmark text-dark text-sm opacity-10"></i>
                          </div>
                          <span class="nav-link-text ms-1 font-weight-bold text-dark text-sm">Data Kelurahan</span>
                      </a>
                  </li>
              <?php endif; ?>

              <li class="nav-item">
                  <a class="nav-link <?= url_is('sekolah*') ? 'active' : '' ?>" href="<?= site_url('sekolah') ?>">
                      <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="fas fa-school text-dark text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1 font-weight-bold text-dark text-sm">Data Sekolah</span>
                  </a>
              </li>
          </ul>
      </div>
  </aside>
