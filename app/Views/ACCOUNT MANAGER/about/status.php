<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<script>
    document.title = "ABOUT";
</script>

<style>
    .content-wrapper {
        background-color: #ffffff !important;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .col-md-3 {
        flex: 1 1 calc(25% - 20px);
        /* 4 kolom per row */
        max-width: calc(25% - 20px);
    }

    @media (max-width: 992px) {
        .col-md-3 {
            flex: 1 1 calc(50% - 20px);
            /* Tablet - 2 kolom */
            max-width: calc(50% - 20px);
        }
    }

    @media (max-width: 576px) {
        .col-md-3 {
            flex: 1 1 100%;
            /* Mobile - 1 kolom */
            max-width: 100%;
        }
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        padding: 15px;
        min-height: 100%;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-color-1 {
        background-color: #f8d7da;
    }

    .card-color-2 {
        background-color: #d1ecf1;
    }

    .card-color-3 {
        background-color: #c3e6cb;
    }

    .card img {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }

    /* CSS untuk Dark Mode */
    body.dark-mode .content-wrapper {
        background-color: #121212 !important;
        /* Background gelap untuk content-wrapper */
    }

    body.dark-mode .row {
        background-color: #1e1e1e !important;
        /* Latar belakang gelap untuk row */
    }

    body.dark-mode .card {
        background-color: #2c2c2c !important;
        /* Latar belakang gelap untuk card */
        color: white;
        /* Pastikan teks terlihat */
    }

    body.dark-mode .card-header {
        background-color: #1cc88a !important;
        /* Warna header card tetap hijau */
        color: white;
        /* Warna teks putih */
    }

    body.dark-mode .card-color-1 {
        background-color: #6c757d !important;
        /* Ubah warna card agar gelap pada dark mode */
    }

    body.dark-mode .card-color-2 {
        background-color: #5a6268 !important;
        /* Ubah warna card agar gelap pada dark mode */
    }

    body.dark-mode .card-color-3 {
        background-color: #4e555b !important;
        /* Ubah warna card agar gelap pada dark mode */
    }

    body.dark-mode .card img {
        filter: brightness(0.7);
        /* Menurunkan kecerahan gambar untuk kesan lebih gelap */
    }
</style>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <?php foreach ($pics as $index => $pic): ?>
                <div class="col-md-3 mb-4">
                    <span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
                    <span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>
                    <div class="card <?= 'card-color-' . ($index % 3 + 1) ?>">
                        <div class="card-header text-white text-center" style="background-color: #1cc88a;">
                            <h5 class="mb-0">Kinerja PIC</h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="<?= base_url($pic['profile_picture'] ?? 'dist/img/avatar5.png') ?>"
                                alt="Profile Picture" class="rounded-circle mb-2">
                            <h6><?= esc($pic['name'] ?? 'Nama Tidak Ditemukan') ?></h6>
                            <small><?= esc($pic['email'] ?? 'Email Tidak Ditemukan') ?></small>
                            <p class="mt-2"><strong>Role:</strong> <?= esc($pic['role'] ?? '-') ?></p>
                            <div class="mt-2">
                                <p><strong>Total Tiket:</strong> <?= esc($total_tickets[$pic['id']] ?? 0) ?></p>
                                <p><strong>Rata-rata Penyelesaian:</strong>
                                    <?= esc($avg_resolution_time[$pic['id']] ?? 0) ?> jam</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>