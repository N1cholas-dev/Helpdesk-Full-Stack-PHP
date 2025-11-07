<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= (isset($pageTitle)) ? $pageTitle : 'Menu' ?></title>
  <base href="/">
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">
</head>

<style>
  body {
    font-family: 'Source Sans Pro', sans-serif;
  }
</style>

<style>
  /* Hapus efek loop hover */
  .navbar .nav-link[data-widget="pushmenu"]:hover {
    transform: scale(1.2);
    transition: transform 0.3s ease-in-out;
  }

  .navbar .nav-item .nav-link {
    color: inherit !important;
  }

  .navbar .nav-item .nav-link.text-danger {
    color: red !important;
  }
</style>

<style>
  /* Hover biasa untuk ikon */
  .nav-item a:hover .nav-icon {
    transform: scale(1.2);
    transition: transform 0.3s ease-in-out;
  }

  /* Efek loop saat menu diklik (tetap dipertahankan) */
  .nav-item.active .nav-icon {
    animation: zoomLoop 0.7s infinite alternate, blinkLoop 0.5s infinite alternate;
  }

  @keyframes zoomLoop {
    0% {
      transform: scale(1);
    }

    100% {
      transform: scale(1.3);
    }
  }

  @keyframes blinkLoop {
    0% {
      filter: brightness(1.5);
    }

    100% {
      filter: brightness(0.5);
    }
  }
</style>

<style>
  .nav-header {
    position: relative;
    padding-bottom: 5px;
    margin-bottom: 10px;
  }

  .nav-header::after {
    content: "";
    display: block;
    width: 100%;
    height: 1px;
    background: rgba(255, 255, 255, 0.2);
    /* Garis tipis warna putih */
    margin-top: 5px;
  }
</style>

<style>
  /* Efek hover untuk semua link dalam navbar */
  .nav-link {
    transition: color 0.3s ease, transform 0.2s ease;
  }

  .nav-link:hover {
    color: #007bff !important;
    /* Warna biru Bootstrap */
    transform: scale(1.05);
    /* Sedikit membesar saat hover */
  }

  /* Efek hover khusus untuk tombol Logout */
  .nav-link.text-danger:hover {
    color: #dc3545 !important;
    /* Warna merah lebih cerah */
    transform: scale(1.1);
    /* Membesar sedikit lebih besar */
  }
</style>

<style>
  /* Hover efek pada brand link (Helpdesk) */
  .brand-link {
    transition: background 0.3s ease, transform 0.2s ease;
  }

  .brand-link:hover {
    background: rgba(255, 255, 255, 0.1);
    /* Efek transparan */
    transform: scale(1.02);
    /* Sedikit membesar */
  }

  /* Efek hover pada user profile */
  .user-panel .info a {
    transition: color 0.3s ease, transform 0.2s ease;
  }

  .user-panel .info a:hover {
    color: #007bff !important;
    /* Warna biru saat hover */
    transform: scale(1.05);
    /* Sedikit membesar */
  }

  /* Efek hover pada gambar profil */
  .user-panel .image a img {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .user-panel .image a img:hover {
    transform: scale(1.1);
    /* Membesar sedikit */
    box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.5);
    /* Glow effect */
  }

  /* Animasi goyang saat hover */
  .notif-hover:hover i {
    animation: bell-shake 0.8s;
  }

  #themeToggle {
    transition: transform 0.5s ease, background-color 0.5s ease;
    outline: none;
    /* Menghilangkan efek outline biru */
  }

  #themeToggle:hover {
    transform: rotate(360deg);
    /* Rotasi 360 derajat */
    background-color: rgba(0, 0, 0, 0.1);
    /* Menambahkan sedikit efek background saat hover */
  }

  @keyframes bell-shake {
    0% {
      transform: rotate(0);
    }

    15% {
      transform: rotate(15deg);
    }

    30% {
      transform: rotate(-15deg);
    }

    45% {
      transform: rotate(10deg);
    }

    60% {
      transform: rotate(-10deg);
    }

    75% {
      transform: rotate(5deg);
    }

    100% {
      transform: rotate(0);
    }
  }

  body.dark-mode {
    background-color: #1e1e2f;
    color: #f0f0f0;
  }

  body.dark-mode .main-header,
  body.dark-mode .main-sidebar,
  body.dark-mode .content-wrapper {
    background-color: #2c2c3e;
    color: white;
  }

  body.dark-mode .nav-link,
  body.dark-mode .form-control,
  body.dark-mode .table {
    background-color: #343a40;
    color: #fff;
  }

  body.dark-mode .dropdown-menu {
    background-color: #3a3a4a;
    color: #fff;
  }

  body.dark-mode .navbar {
    background-color: #1f1f1f !important;
    color: white;
  }

  body.dark-mode .dropdown-header {
    color: #ccc !important;
  }

  .skeleton {
    background-color: #ccc;
    border-radius: 4px;
    animation: pulse 1.2s infinite ease-in-out;
  }

  @keyframes pulse {
    0% {
      opacity: 1;
    }

    50% {
      opacity: 0.4;
    }

    100% {
      opacity: 1;
    }
  }

  /* Skeleton Loader Styles */
  .skeleton {
    background-color: #ccc;
    color: transparent !important;
    border-radius: 4px;
    animation: shimmer 1.2s infinite linear;
  }

  /* Skeleton untuk gambar */
  .skeleton-img {
    width: 2.1rem;
    height: 2.1rem;
    border-radius: 50%;
  }

  /* Skeleton untuk teks */
  .skeleton-text {
    height: 1.2rem;
    width: 100%;
  }

  /* Animasi shimmer untuk efek loading */
  @keyframes shimmer {
    0% {
      background-position: -1000px 0;
    }

    100% {
      background-position: 1000px 0;
    }
  }

  /* Efek loading untuk ikon - spinner */
  .skeleton-icon {
    width: 20px;
    height: 20px;
    border: 2px solid #ddd;
    /* Warna border untuk efek loading */
    border-top-color: transparent;
    /* Hanya top border yang terlihat */
    border-radius: 50%;
    margin-right: 10px;
    animation: spin 0.5s infinite linear;
    /* Animasi muter */
  }

  /* Animasi spin untuk ikon (muter) */
  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  /* Menonaktifkan skeleton setelah data dimuat */
  .loaded .skeleton-icon {
    animation: none;
    /* Menghentikan animasi setelah selesai dimuat */
    border-color: transparent;
    /* Menghilangkan border setelah selesai */
  }

  /* Efek loading pada teks (warna latar belakang berubah perlahan) */
  .skeleton-text {
    width: 100px;
    height: 20px;
    background-color: #ddd;
    border-radius: 5px;
    animation: loading 1.5s infinite ease-in-out;
  }

  /* Animasi loading untuk teks */
  @keyframes loading {
    0% {
      background-color: #ddd;
    }

    50% {
      background-color: #e0e0e0;
    }

    100% {
      background-color: #ddd;
    }
  }
</style>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <div class="container-fluid d-flex justify-content-between align-items-center">

        <!-- Kiri -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
              <i class="fas fa-bars"></i>
            </a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="DOCUMENTATION IT/dashboard/home" class="nav-link">Beranda</a>
          </li>
        </ul>

        <!-- Tengah -->
        <div class="d-flex align-items-center gap-3">
          <!-- Toggle Tema -->
          <button class="btn nav-link bg-transparent border-0" id="themeToggle" title="Toggle Theme">
            <i class="fas fa-moon" id="themeIcon"></i>
          </button>

          <!-- Tips Fullscreen -->
          <small class="text-muted">
            Tekan <strong>F11</strong> untuk fullscreen.
          </small>
        </div>

        <!-- Kanan -->
        <ul class="navbar-nav d-flex align-items-center">
          <!-- Notifikasi -->
          <li class="nav-item dropdown">
            <a href="#" class="nav-link notif-hover" role="button" data-toggle="dropdown">
              <i class="fas fa-bell"></i>
              <span class="badge badge-warning navbar-badge" id="notification-badge">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg" style="left: auto; right: 25%;">
              <div id="notification-list" class="dropdown-header">No new notifications</div>
            </div>
          </li>

          <!-- Logout -->
          <li class="nav-item">
            <a href="<?= base_url('logout'); ?>" class="nav-link text-danger">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="https://codeigniter.com/" class="brand-link" target="_blank">
        <img src="<?= base_url('dist/img/24.jpg'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">Helpdesk</span>
      </a>

      <div class="sidebar">
        <?php
        $admin = null;
        $role = session()->get('role');
        if ($role === 'ADMIN') {
          $adminModel = new \App\Models\AdminModel();
          $adminId = session()->get('admin_id');
          $admin = $adminModel->find($adminId);
        } elseif ($role === 'USER') {
          $userModel = new \App\Models\UserModel();
          $adminId = session()->get('user_id');
          $admin = $userModel->find($adminId);
        } elseif ($role === 'PICUser') {
          $picUserModel = new \App\Models\PicUserModel();
          $adminId = session()->get('user_id');
          $admin = $picUserModel->find($adminId);
        }

        $profileImage = isset($_SESSION['profile_picture']) && !empty($_SESSION['profile_picture'])
          ? base_url('uploads/profile_pictures/' . $_SESSION['profile_picture'])
          : (isset($admin['profile_picture']) && !empty($admin['profile_picture'])
            ? base_url('uploads/profile_pictures/' . $admin['profile_picture'])
            : base_url('dist/img/25.jpg'));
        ?>

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <a href="<?= site_url('PROFILE ADMIN/profile'); ?>">
              <img id="sidebarProfileImage" src="<?= esc($profileImage); ?>"
                class="img-circle elevation-2 <?= empty($profileImage) ? 'skeleton skeleton-img' : ''; ?>"
                alt="User Image" onload="this.classList.remove('skeleton', 'skeleton-img');"
                onerror="this.onerror=null; this.src='<?= base_url('dist/img/25.jpg'); ?>';">
            </a>
          </div>
          <div class="info">
            <a href="<?= base_url('PROFILE ADMIN/profile'); ?>" class="d-block"
              style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%;" id="profileName">
              <span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span>
              Loading...
            </a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Documentation IT -->
            <li class="nav-header" style="color: #32cd32;">Documentation IT</li> <!-- Warna hijau terang -->
            <!-- Home -->
            <li class="nav-item">
              <a href="<?= base_url('DOCUMENTATION IT/dashboard/home') ?>" class="nav-link">
                <?php if (empty($homeIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon text-danger" id="homeIconSpinner"></i>
                  <i class="fas fa-home nav-icon text-danger d-none" id="homeIconFinal"></i>
                <?php else: ?>
                  <i class="fas fa-home nav-icon text-danger"></i>
                <?php endif; ?>
                <p>Beranda</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('DOCUMENTATION IT/helpdesk/helpdesk-admin') ?>" class="nav-link">
                <?php if (empty($helpdeskIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" style="color: #1e90ff;" id="helpdeskIconSpinner"></i>
                  <i class="fas fa-headset nav-icon d-none" style="color: #1e90ff;" id="helpdeskIconFinal"></i>
                <?php else: ?>
                  <i class="fas fa-headset nav-icon" style="color: #1e90ff;"></i>
                <?php endif; ?>
                <p>Tiket</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="DOCUMENTATION IT/invoice/bill" class="nav-link">
                <?php if (empty($invoiceIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon text-warning" id="invoiceIconSpinner"></i>
                  <i class="fas fa-file-invoice nav-icon text-warning d-none" id="invoiceIconFinal"></i>
                <?php else: ?>
                  <i class="fas fa-file-invoice nav-icon text-warning"></i>
                <?php endif; ?>
                <p>Invoice</p>
              </a>
            </li>

            <!-- Employee -->
            <li class="nav-header" style="color: #32cd32;">Organize</li>

            <li class="nav-item">
              <a href="ORGANIZE/employee/new" class="nav-link">
                <?php if (empty($newEmployeeIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="newEmployeeIconSpinner" style="color: #6a5acd;"></i>
                  <!-- Warna ungu slate blue -->
                  <i class="fas fa-user-plus nav-icon d-none" id="newEmployeeIconFinal" style="color: #6a5acd;"></i>
                  <!-- Warna ungu slate blue -->
                <?php else: ?>
                  <i class="fas fa-user-plus nav-icon" style="color: #6a5acd;"></i>
                <?php endif; ?>
                <p>Karyawan Baru</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="ORGANIZE/employee/exit" class="nav-link">
                <?php if (empty($exitEmployeeIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="exitEmployeeIconSpinner" style="color: #ff4500;"></i>
                  <!-- Warna oranye -->
                  <i class="fas fa-user-times nav-icon d-none" id="exitEmployeeIconFinal" style="color: #ff4500;"></i>
                  <!-- Warna oranye -->
                <?php else: ?>
                  <i class="fas fa-user-times nav-icon" style="color: #ff4500;"></i> <!-- Warna oranye -->
                <?php endif; ?>
                <p>Karyawan Keluar</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="ORGANIZE/pic/pic-IT" class="nav-link">
                <?php if (empty($picIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="picIconSpinner" style="color: #32cd32;"></i>
                  <!-- Warna hijau lime -->
                  <i class="fas fa-user-check nav-icon d-none" id="picIconFinal" style="color: #32cd32;"></i>
                  <!-- Warna hijau lime -->
                <?php else: ?>
                  <i class="fas fa-user-check nav-icon" style="color: #32cd32;"></i> <!-- Warna hijau lime -->
                <?php endif; ?>
                <p>Daftar Karyawan</p>
              </a>
            </li>

            <!-- Task -->
            <li class="nav-header" style="color: #32cd32;">Task</li>

            <li class="nav-item">
              <a href="TASK/categories/category" class="nav-link">
                <?php if (empty($categoryIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="categoryIconSpinner" style="color: #ff4500;"></i>
                  <!-- Warna oranye merah -->
                  <i class="fas fa-list nav-icon d-none" id="categoryIconFinal" style="color: #ff4500;"></i>
                  <!-- Warna oranye merah -->
                <?php else: ?>
                  <i class="fas fa-list nav-icon" style="color: #ff4500;"></i> <!-- Warna oranye merah -->
                <?php endif; ?>
                <p>Kategori</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="TASK/subcategories/subcategory" class="nav-link">
                <?php if (empty($subcategoryIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="subcategoryIconSpinner" style="color: #4682b4;"></i>
                  <!-- Warna biru steel -->
                  <i class="fas fa-tags nav-icon d-none" id="subcategoryIconFinal" style="color: #4682b4;"></i>
                  <!-- Warna biru steel -->
                <?php else: ?>
                  <i class="fas fa-tags nav-icon" style="color: #4682b4;"></i> <!-- Warna biru steel -->
                <?php endif; ?>
                <p>Sub Kategori</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="TASK/departments/department-company" class="nav-link">
                <?php if (empty($departmentIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="departmentIconSpinner" style="color: #9400d3;"></i>
                  <!-- Warna ungu gelap -->
                  <i class="fas fa-building nav-icon d-none" id="departmentIconFinal" style="color: #9400d3;"></i>
                  <!-- Warna ungu gelap -->
                <?php else: ?>
                  <i class="fas fa-building nav-icon" style="color: #9400d3;"></i> <!-- Warna ungu gelap -->
                <?php endif; ?>
                <p>Departemen</p>
              </a>
            </li>

            <!-- Account Manager -->
            <li class="nav-header" style="color: #32cd32;">Account Manager</li>

            <!-- ADMIN -->
            <li class="nav-item">
              <a href="ACCOUNT MANAGER/admin/admin-manager" class="nav-link">
                <?php if (empty($adminIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="adminIconSpinner" style="color: #ffcc00;"></i>
                  <!-- Warna kuning -->
                  <i class="fas fa-user-shield nav-icon d-none" id="adminIconFinal" style="color: #ffcc00;"></i>
                  <!-- Warna kuning -->
                <?php else: ?>
                  <i class="fas fa-user-shield nav-icon" style="color: #ffcc00;"></i> <!-- Warna kuning -->
                <?php endif; ?>
                <p>Akun Admin</p>
              </a>
            </li>

            <!-- PIC Manager -->
            <li class="nav-item">
              <a href="ACCOUNT MANAGER/pic/pic-manager" class="nav-link">
                <?php if (empty($picManagerIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="picManagerIconSpinner"
                    style="color: rgb(21, 194, 191);"></i> <!-- Warna hijau tosca -->
                  <i class="fas fa-user-cog nav-icon d-none" id="picManagerIconFinal"
                    style="color: rgb(21, 194, 191);"></i> <!-- Warna hijau tosca -->
                <?php else: ?>
                  <i class="fas fa-user-cog nav-icon" style="color: rgb(21, 194, 191);"></i> <!-- Warna hijau tosca -->
                <?php endif; ?>
                <p>Akun Pic</p>
              </a>
            </li>

            <!-- USER -->
            <li class="nav-item">
              <a href="ACCOUNT MANAGER/user/user-manager" class="nav-link">
                <?php if (empty($userIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="userIconSpinner" style="color: rgb(99, 234, 139);"></i>
                  <!-- Warna hijau muda -->
                  <i class="fas fa-user nav-icon d-none" id="userIconFinal" style="color: rgb(99, 234, 139);"></i>
                  <!-- Warna hijau muda -->
                <?php else: ?>
                  <i class="fas fa-user nav-icon" style="color: rgb(99, 234, 139);"></i> <!-- Warna hijau muda -->
                <?php endif; ?>
                <p>Akun User</p>
              </a>
            </li>

            <!-- STATUS -->
            <li class="nav-item">
              <a href="ACCOUNT MANAGER/about/status" class="nav-link">
                <?php if (empty($statusIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="statusIconSpinner" style="color: rgb(13, 232, 65);"></i>
                  <!-- Warna hijau -->
                  <i class="fas fa-signal nav-icon d-none" id="statusIconFinal" style="color: rgb(13, 232, 65);"></i>
                  <!-- Warna hijau -->
                <?php else: ?>
                  <i class="fas fa-signal nav-icon" style="color: rgb(13, 232, 65);"></i> <!-- Warna hijau -->
                <?php endif; ?>
                <p>Profil Pic</p>
              </a>
            </li>

            <!-- STAR -->
            <li class="nav-item">
              <a href="ACCOUNT MANAGER/rating/star" class="nav-link">
                <?php if (empty($starIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="starIconSpinner" style="color: rgb(255, 230, 0);"></i>
                  <!-- Warna kuning -->
                  <i class="fas fa-star nav-icon d-none" id="starIconFinal" style="color: rgb(255, 230, 0);"></i>
                  <!-- Warna kuning -->
                <?php else: ?>
                  <i class="fas fa-star nav-icon" style="color: rgb(255, 230, 0);"></i> <!-- Warna kuning -->
                <?php endif; ?>
                <p>Grafik Pic</p>
              </a>
            </li>

            <!-- ACHIEVEMENT -->
            <li class="nav-item">
              <a href="ACCOUNT MANAGER/reward/achievement" class="nav-link">
                <?php if (empty($achievementIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="achievementIconSpinner"
                    style="color: rgb(250, 156, 4);"></i> <!-- Warna kuning keemasan -->
                  <i class="fas fa-trophy nav-icon d-none" id="achievementIconFinal" style="color: rgb(250, 156, 4);"></i>
                  <!-- Warna kuning keemasan -->
                <?php else: ?>
                  <i class="fas fa-trophy nav-icon" style="color: rgb(250, 156, 4);"></i> <!-- Warna kuning keemasan -->
                <?php endif; ?>
                <p>Pencapaian</p>
              </a>
            </li>

            <!-- TRACKING -->
            <li class="nav-item">
              <a href="<?= base_url('ACCOUNT MANAGER/progress/tracking') ?>" class="nav-link">
                <?php if (empty($trackingIcon)): ?>
                  <i class="fas fa-spinner fa-spin nav-icon" id="trackingIconSpinner"
                    style="color: rgb(4, 197, 250);"></i> <!-- Warna biru muda -->
                  <i class="fas fa-clipboard-list nav-icon d-none" id="trackingIconFinal"
                    style="color: rgb(4, 197, 250);"></i> <!-- Warna biru muda -->
                <?php else: ?>
                  <i class="fas fa-clipboard-list nav-icon" style="color: rgb(4, 197, 250);"></i> <!-- Warna biru muda -->
                <?php endif; ?>
                <p>Lacak Status tiket</p>
              </a>
            </li>

        </nav>
        </ul>
        </li>
        </ul>
        </nav>
      </div>
    </aside>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
        </div>
      </div>

      <?= $this->renderSection('content'); ?>

      <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
      <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
          Beginner Full-Stack
        </div>
        <strong>Copyright &copy; 2025 <a href="<?= base_url(); ?>"> Helpdesk WebApp </a>.</strong> All
        rights reserved.
      </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script>
      window.addEventListener('DOMContentLoaded', function () {
        var nameEl = document.getElementById('userName');
        var roleEl = document.getElementById('userRole');
        var profileName = document.getElementById('profileName');

        // Cek agar tidak error jika elemen tidak ada
        if (nameEl && roleEl && profileName) {
          var nameFromSession = nameEl.innerText;
          var roleFromSession = roleEl.innerText;
          profileName.innerHTML = `${nameFromSession} (${roleFromSession})`;
        }
      });

      window.addEventListener('DOMContentLoaded', function () {
        setTimeout(() => {
          const homeSpinner = document.getElementById('homeIconSpinner');
          const homeFinalIcon = document.getElementById('homeIconFinal');
          if (homeSpinner && homeFinalIcon) {
            homeSpinner.classList.add('d-none');
            homeFinalIcon.classList.remove('d-none');
          }

          const helpdeskSpinner = document.getElementById('helpdeskIconSpinner');
          const helpdeskFinalIcon = document.getElementById('helpdeskIconFinal');
          if (helpdeskSpinner && helpdeskFinalIcon) {
            helpdeskSpinner.classList.add('d-none');
            helpdeskFinalIcon.classList.remove('d-none');
          }

          const invoiceSpinner = document.getElementById('invoiceIconSpinner');
          const invoiceFinalIcon = document.getElementById('invoiceIconFinal');
          if (invoiceSpinner && invoiceFinalIcon) {
            invoiceSpinner.classList.add('d-none');
            invoiceFinalIcon.classList.remove('d-none');
          }

          const newEmployeeSpinner = document.getElementById('newEmployeeIconSpinner');
          const newEmployeeFinalIcon = document.getElementById('newEmployeeIconFinal');
          if (newEmployeeSpinner && newEmployeeFinalIcon) {
            newEmployeeSpinner.classList.add('d-none');
            newEmployeeFinalIcon.classList.remove('d-none');
          }

          const exitEmployeeSpinner = document.getElementById('exitEmployeeIconSpinner');
          const exitEmployeeFinalIcon = document.getElementById('exitEmployeeIconFinal');
          if (exitEmployeeSpinner && exitEmployeeFinalIcon) {
            exitEmployeeSpinner.classList.add('d-none');
            exitEmployeeFinalIcon.classList.remove('d-none');
          }

          const historyEmployeeSpinner = document.getElementById('historyEmployeeIconSpinner');
          const historyEmployeeFinalIcon = document.getElementById('historyEmployeeIconFinal');
          if (historyEmployeeSpinner && historyEmployeeFinalIcon) {
            historyEmployeeSpinner.classList.add('d-none');
            historyEmployeeFinalIcon.classList.remove('d-none');
          }

          const picSpinner = document.getElementById('picIconSpinner');
          const picFinalIcon = document.getElementById('picIconFinal');
          if (picSpinner && picFinalIcon) {
            picSpinner.classList.add('d-none');
            picFinalIcon.classList.remove('d-none');
          }

          const categorySpinner = document.getElementById('categoryIconSpinner');
          const categoryFinalIcon = document.getElementById('categoryIconFinal');
          if (categorySpinner && categoryFinalIcon) {
            categorySpinner.classList.add('d-none');
            categoryFinalIcon.classList.remove('d-none');
          }

          const subcategorySpinner = document.getElementById('subcategoryIconSpinner');
          const subcategoryFinalIcon = document.getElementById('subcategoryIconFinal');
          if (subcategorySpinner && subcategoryFinalIcon) {
            subcategorySpinner.classList.add('d-none');
            subcategoryFinalIcon.classList.remove('d-none');
          }

          const departmentSpinner = document.getElementById('departmentIconSpinner');
          const departmentFinalIcon = document.getElementById('departmentIconFinal');
          if (departmentSpinner && departmentFinalIcon) {
            departmentSpinner.classList.add('d-none');
            departmentFinalIcon.classList.remove('d-none');
          }

          const adminSpinner = document.getElementById('adminIconSpinner');
          const adminFinalIcon = document.getElementById('adminIconFinal');
          if (adminSpinner && adminFinalIcon) {
            adminSpinner.classList.add('d-none');
            adminFinalIcon.classList.remove('d-none');
          }

          // Untuk PIC Manager
          const picManagerSpinner = document.getElementById('picManagerIconSpinner');
          const picManagerFinalIcon = document.getElementById('picManagerIconFinal');
          if (picManagerSpinner && picManagerFinalIcon) {
            picManagerSpinner.classList.add('d-none');
            picManagerFinalIcon.classList.remove('d-none');
          }

          const userSpinner = document.getElementById('userIconSpinner');
          const userFinalIcon = document.getElementById('userIconFinal');
          if (userSpinner && userFinalIcon) {
            userSpinner.classList.add('d-none');
            userFinalIcon.classList.remove('d-none');
          }

          const groupSpinner = document.getElementById('groupIconSpinner');
          const groupFinalIcon = document.getElementById('groupIconFinal');
          if (groupSpinner && groupFinalIcon) {
            groupSpinner.classList.add('d-none');
            groupFinalIcon.classList.remove('d-none');
          }

          const statusSpinner = document.getElementById('statusIconSpinner');
          const statusFinalIcon = document.getElementById('statusIconFinal');
          if (statusSpinner && statusFinalIcon) {
            statusSpinner.classList.add('d-none');
            statusFinalIcon.classList.remove('d-none');
          }

          const starSpinner = document.getElementById('starIconSpinner');
          const starFinalIcon = document.getElementById('starIconFinal');
          if (starSpinner && starFinalIcon) {
            starSpinner.classList.add('d-none');
            starFinalIcon.classList.remove('d-none');
          }

          const achievementSpinner = document.getElementById('achievementIconSpinner');
          const achievementFinalIcon = document.getElementById('achievementIconFinal');
          if (achievementSpinner && achievementFinalIcon) {
            achievementSpinner.classList.add('d-none');
            achievementFinalIcon.classList.remove('d-none');
          }

          const trackingSpinner = document.getElementById('trackingIconSpinner');
          const trackingFinalIcon = document.getElementById('trackingIconFinal');
          if (trackingSpinner && trackingFinalIcon) {
            trackingSpinner.classList.add('d-none');
            trackingFinalIcon.classList.remove('d-none');
          }

          const historySpinner = document.getElementById('historyIconSpinner');
          const historyFinalIcon = document.getElementById('historyIconFinal');
          if (historySpinner && historyFinalIcon) {
            historySpinner.classList.add('d-none');
            historyFinalIcon.classList.remove('d-none');
          }
        }, 500); // Simulasi load selesai setelah 1 detik
      });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const profileName = document.getElementById("profileName");

        // Ambil dari session PHP
        const nameFromSession = "<?= session()->get('name'); ?>";
        const roleFromSession = "<?= session()->get('role'); ?>";

        // Tambahkan efek delay loading
        setTimeout(() => {
          if (nameFromSession && roleFromSession) {
            profileName.textContent = `${nameFromSession} (${roleFromSession})`;
          } else {
            profileName.textContent = "User";
          }
        }, 500); // 0.5 detik untuk simulasi loading
      });
    </script>

    <script>
      // Terapkan dark mode saat halaman dimuat
      window.addEventListener('DOMContentLoaded', function () {
        const savedTheme = localStorage.getItem('theme');
        const icon = document.getElementById('themeIcon');

        if (savedTheme === 'dark') {
          document.body.classList.add('dark-mode');
          icon?.classList.remove('fa-moon');
          icon?.classList.add('fa-sun');
        } else {
          document.body.classList.remove('dark-mode');
          icon?.classList.remove('fa-sun');
          icon?.classList.add('fa-moon');
        }
      });

      // Toggle dark mode on click
      document.getElementById('themeToggle').addEventListener('click', function (e) {
        e.preventDefault(); // Mencegah default action (klik link)

        document.body.classList.toggle('dark-mode');

        const icon = document.getElementById('themeIcon');
        icon.classList.toggle('fa-moon');
        icon.classList.toggle('fa-sun');

        // Simpan preferensi user
        const isDark = document.body.classList.contains('dark-mode');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
      });
    </script>

    <script>
      document.querySelector('.nav-link[data-toggle="dropdown"]').addEventListener('click', function () {
        fetch('/notifications/mark-all-as-read', { // Sesuai route baru
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          }
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              console.log("All notifications marked as read");
              document.getElementById("notification-badge").textContent = "0"; // Reset badge
            }
          })
          .catch(error => console.error('Error marking all notifications as read:', error));
      });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        fetchNotifications(); // Ambil notifikasi saat halaman dimuat

        // Fungsi untuk mengambil notifikasi dari server
        function fetchNotifications() {
          fetch('/notifications/get-admin') // Pastikan endpoint ini benar
            .then(response => {
              if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
              }
              return response.json();
            })
            .then(data => {
              let notificationBadge = document.getElementById("notification-badge");
              let notificationList = document.getElementById("notification-list");

              if (!notificationBadge || !notificationList) {
                console.error("Elemen notifikasi tidak ditemukan di halaman!");
                return;
              }

              // Pastikan data.notifications ada sebelum diakses
              if (!data || !data.notifications) {
                console.error("Data notifications tidak ditemukan dalam respons server:", data);
                return;
              }

              let unreadNotifications = data.notifications.filter(notification => notification.status === 'unread');

              if (unreadNotifications.length > 0) {
                notificationBadge.textContent = unreadNotifications.length; // Update jumlah notifikasi
                notificationBadge.style.display = "inline"; // Tampilkan badge

                notificationList.innerHTML = ""; // Bersihkan daftar notifikasi sebelumnya

                unreadNotifications.forEach(notification => {
                  let item = document.createElement("a");
                  item.href = "#"; // Bisa diubah ke halaman detail jika ada
                  item.classList.add("dropdown-item");
                  item.textContent = notification.message;

                  // Tambahkan event untuk mengarahkan ke tiket terkait
                  item.onclick = function () {
                    let ticketId = notification.message.match(/#(\d+)/);
                    if (ticketId) {
                      highlightTicketInTable(ticketId[1]);
                    }

                    // Tandai notifikasi sebagai dibaca setelah diklik
                    if (notification.id) {
                      markNotificationAsRead(notification.id);
                    }
                  };

                  notificationList.appendChild(item);
                });

                // Panggil fungsi auto-hide setelah 15 detik
                autoHideNotifications();
              } else {
                notificationBadge.style.display = "none"; // Sembunyikan badge jika tidak ada notifikasi
                notificationList.innerHTML = "<div class='dropdown-item'>No new notifications</div>";
              }
            })
            .catch(error => console.error("Error fetching notifications:", error));
        }

        // Fungsi untuk menandai notifikasi sebagai dibaca
        function markAllNotificationsAsRead() {
          fetch('/notifications/mark-all-as-read', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            }
          })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                console.log("All notifications marked as read");
                fetchNotifications(); // Refresh daftar notifikasi
              }
            })
            .catch(error => console.error('Error marking all notifications as read:', error));
        }

        // Fungsi untuk menghilangkan notifikasi setelah 15 detik
        function autoHideNotifications() {
          setTimeout(() => {
            let notificationList = document.getElementById("notification-list");
            let notificationBadge = document.getElementById("notification-badge");

            console.log("Auto-hide notifications triggered"); // Debug log

            if (notificationList && notificationBadge) {
              notificationList.innerHTML = "<div class='dropdown-item'>No new notifications</div>";
              notificationBadge.textContent = "0";
              notificationBadge.style.display = "none";

              console.log("Notifications hidden"); // Debug log
            }
          }, 10000); // 30 detik (sesuaikan jika perlu)
        }

        // Fungsi untuk menyorot tiket di DataTable
        function highlightTicketInTable(ticketId) {
          let table = document.querySelector("#ticketTable"); // Ganti dengan ID tabel
          let rows = table.getElementsByTagName("tr");

          for (let row of rows) {
            if (row.innerHTML.includes(`#${ticketId}`)) {
              row.style.backgroundColor = "#ffeb3b"; // Highlight warna kuning
              row.scrollIntoView({ behavior: "smooth", block: "center" });
              setTimeout(() => row.style.backgroundColor = "", 3000); // Kembalikan warna setelah 3 detik
              break;
            }
          }
        }

        // Update notifikasi setiap 30 detik
        setInterval(fetchNotifications, 30000);
      });
    </script>

    <script>
      // Fungsi untuk memperbarui gambar profil di sidebar setelah upload
      function updateSidebarProfile(imageUrl) {
        document.getElementById('sidebarProfileImage').src = imageUrl;
      }

      // Cek jika ada session storage yang menyimpan gambar terbaru
      document.addEventListener("DOMContentLoaded", function () {
        let newProfileImage = sessionStorage.getItem('newProfileImage');
        if (newProfileImage) {
          updateSidebarProfile(newProfileImage);
          sessionStorage.removeItem('newProfileImage'); // Hapus setelah digunakan
        }
      });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        let navLinks = document.querySelectorAll(".nav-item a");

        navLinks.forEach(link => {
          link.addEventListener("click", function (e) {
            // Hapus efek dari semua menu lain
            document.querySelectorAll(".nav-item").forEach(item => item.classList.remove("active"));

            // Tambahkan efek hanya ke menu yang diklik
            this.parentElement.classList.add("active");
          });
        });
      });
    </script>

    <script>
      $(document).ready(function () {
        // Cek status dropdown dari localStorage
        let dropdownState = localStorage.getItem("dropdownSettings");

        if (dropdownState === "open") {
          $(".has-treeview").addClass("menu-open");
          $(".has-treeview > .nav-link").addClass("active");
          $(".has-treeview .nav-treeview").css("display", "block");
        }

        // Toggle dropdown dan simpan status ke localStorage
        $(".has-treeview > .nav-link").click(function () {
          if ($(this).parent().hasClass("menu-open")) {
            localStorage.setItem("dropdownSettings", "closed");
          } else {
            localStorage.setItem("dropdownSettings", "open");
          }
        });
      });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Ambil path halaman saat ini
        const page = window.location.pathname;

        // Cek apakah ada posisi scroll yang tersimpan untuk halaman ini
        const savedScrollPosition = localStorage.getItem(`scrollPosition-${page}`);
        if (savedScrollPosition) {
          window.scrollTo(0, savedScrollPosition); // Gulir ke posisi yang tersimpan
        }

        // Simpan posisi scroll sebelum berpindah halaman
        window.addEventListener("beforeunload", function () {
          localStorage.setItem(`scrollPosition-${page}`, window.scrollY);
        });
      });

      document.addEventListener("DOMContentLoaded", function () {
        let sessionData = {
          unique_session_id: "<?= session()->get('unique_session_id'); ?>",
          name: "<?= session()->get('name'); ?>",
          role: "<?= session()->get('role'); ?>",
          email: "<?= session()->get('email'); ?>"
        };

        // Simpan sesi ini dalam localStorage dengan key unik
        localStorage.setItem(sessionData.unique_session_id, JSON.stringify(sessionData));

        // Ambil data dari localStorage dan tampilkan sesuai sesi di tab ini
        let storedData = localStorage.getItem(sessionData.unique_session_id);
        if (storedData) {
          storedData = JSON.parse(storedData);
          document.getElementById("userDisplay").innerText = storedData.name + " - " + storedData.role;
        }
      });

      document.addEventListener("DOMContentLoaded", function () {
        let sessionId = "<?= session()->get('unique_session_id'); ?>";

        if (sessionId) {
          let storedData = localStorage.getItem(sessionId);
          if (storedData) {
            storedData = JSON.parse(storedData);
            document.getElementById("userDisplay").innerText = storedData.name + " - " + storedData.role;
          }
        }
      });
    </script>

    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js?v=3.2.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

</body>

</html>