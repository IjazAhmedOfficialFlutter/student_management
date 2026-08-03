<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="row mb-4">

        <div class="col">

            <h2 class="fw-bold">
                <i class="bi bi-bar-chart-fill text-primary"></i>
                Reports Dashboard
            </h2>

            <p class="text-muted">
                Select a report category to view detailed information.
            </p>

        </div>

    </div>

    <!-- Student Reports -->
    <?= view('reports/partials/_studentReports') ?>

    <!-- Class Reports -->
    <?= view('reports/partials/_classReports') ?>

    <!-- Attendance Reports -->
    <?= view('reports/partials/_attendanceReports') ?>

    <!-- Subject Reports -->
    <?= view('reports/partials/_subjectReports') ?>

</div>

<?= $this->endSection() ?>