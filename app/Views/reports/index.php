<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-bar-chart-fill text-primary"></i>
            Reports
        </h2>
        <p class="text-muted mb-0">Generate insights across students, classes, and attendance.</p>
    </div>

    <div class="row g-3">

        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body">
                    <i class="bi bi-building text-primary fs-2"></i>
                    <h5 class="mt-3">Class-wise Students</h5>
                    <p class="text-muted small">See how many students are enrolled per class.</p>
                    <a href="<?= site_url('reports/class-wise') ?>" class="btn btn-outline-primary btn-sm">
                        View Report
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body">
                    <i class="bi bi-calendar-check text-success fs-2"></i>
                    <h5 class="mt-3">Attendance Summary</h5>
                    <p class="text-muted small">Present/Absent totals per student over a date range.</p>
                    <a href="<?= site_url('reports/attendance-summary') ?>" class="btn btn-outline-primary btn-sm">
                        View Report
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>