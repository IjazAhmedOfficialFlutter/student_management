<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="row mb-4">

        <div class="col">

            <h2 class="fw-bold">
                <i class="bi bi-speedometer2"></i>
                <?= lang('App.dashboard') ?>
            </h2>

            <p class="text-muted">
                <?= lang('App.welcome') ?>
            </p>

        </div>

    </div>

    <!-- Summary Cards -->
    <?= view('dashboard/partials/_cards') ?>

    <!-- Quick Actions -->
    <?= view('dashboard/partials/_quickActions') ?>

    <!-- Recent Students -->
    <?= view('dashboard/partials/_recentStudents',  
     ['recentStudents' => $recentStudents]) ?>

    <!-- Attendance -->
    <?= view('dashboard/partials/_attendanceChart') ?>

    <!-- Statistics -->
    <?= view('dashboard/partials/_statistics') ?>

</div>

<?= $this->endSection() ?>