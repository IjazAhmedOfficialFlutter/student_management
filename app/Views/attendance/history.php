<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold">
            <i class="bi bi-clock-history text-primary"></i>
            Attendance History
        </h2>
    </div>

    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">

            <form action="<?= site_url('attendance/history') ?>" method="get" class="row g-3">

                <div class="col-md-5">
                    <label class="form-label">Class</label>
                    <select name="ClassID" class="form-select">
                        <option value="">Select Class</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['ClassID'] ?>" <?= $classID == $class['ClassID'] ? 'selected' : '' ?>>
                                <?= esc($class['ClassName']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-5">
                    <label class="form-label">Date</label>
                    <input type="date" name="AttendanceDate" class="form-control" value="<?= esc($date) ?>">
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">View</button>
                </div>

            </form>

        </div>
    </div>

    <?php if (!empty($records)): ?>

        <div class="card border-0 shadow rounded-4">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Roll No</th>
                            <th>Student</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $record): ?>
                            <tr>
                                <td><?= esc($record['RollNo']) ?></td>
                                <td><?= esc($record['StudentName']) ?></td>
                                <td>
                                    <?php if ($record['Status'] == 'Present'): ?>
                                        <span class="badge bg-success">Present</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Absent</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>