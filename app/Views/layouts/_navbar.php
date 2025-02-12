<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white fw-bold text-sm">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white fw-bold text-sm active" aria-current="page"><?= $this->renderSection('pages') ?></li>
            </ol>
        </nav>
        <div class="collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex align-items-center justify-content-end" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown px-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white font-weight-bold p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user mx-2"></i>
                        <span class="d-sm-inline d-none"><?= ucwords(session()->get('user_name')) ?></span>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item border-radius-md" href="<?= base_url('logout') ?>">
                                <div class="d-flex py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <p class="text-xs text-danger mb-0">
                                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
