<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-calendar-check text-primary"></i>
            Attendance
        </h2>
        <p class="text-muted mb-0">Select a class and date to mark or view attendance.</p>
    </div>

    <div class="row">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">

                    <form action="<?= site_url('attendance/mark') ?>" method="get">

                        <div class="mb-3">
                            <label class="form-label">Class</label>
                            <select name="ClassID" class="form-select" required>
                                <option value="">Select Class</option>
                                <?php foreach ($classes as $class): ?>
                                    <option value="<?= $class['ClassID'] ?>">
                                        <?= esc($class['ClassName']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="AttendanceDate" class="form-control"
                                   value="<?= date('Y-m-d') ?>" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i>
                            Mark Attendance
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>