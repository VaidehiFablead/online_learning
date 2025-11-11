<nav class="navbar navbar-expand-lg fixed-top" style="background-color:#a33939;">
    <div class="container-fluid text-white">
        <span class="toggle-btn me-3" id="menu-toggle" style="cursor:pointer;">
            <i class="bi bi-list"></i>
        </span>
        <a class="navbar-brand text-white fw-bold" href="<?= base_url('dashboard') ?>">Online Learning Portal</a>
        <div class="ms-auto d-flex align-items-center">
            <!-- <span class="me-3">Welcome, <b><?= ucfirst(session('name')) ?? 'Student' ?></b></span>
            <a href="<?= base_url('profile') ?>" class="nav-link">
                <i class="bi bi-person"></i> Profile
                 <i class="fa-solid fa-user"></i>Profile
            </a>
            <a href="<?= base_url('logout') ?>" class="btn btn-light btn-sm">Logout</a> -->
            <!-- Profile Dropdown -->
            <div class="dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" id="profileDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user me-2"></i>
                    <b><?= ucfirst(session('name')) ?? 'Student' ?></b>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="profileDropdown">
                    <li>
                        <a class="dropdown-item" href="<?= base_url('profile') ?>">
                            <i class="fa-solid fa-id-card me-2"></i> My Profile
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                            <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>