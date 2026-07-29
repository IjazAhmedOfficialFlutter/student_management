<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Attendance Summary Report</h2>
        <a href="<?= site_url('reports') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body">

            <form action="<?= site_url('reports/attendance-summary') ?>" method="get" class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">Class</label>
                    <select name="ClassID" class="form-select" required>
                        <option value="">Select Class</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['ClassID'] ?>" <?= $classID == $class['ClassID'] ? 'selected' : '' ?>>
                                <?= esc($class['ClassName']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">From</label>
                    <input type="date" name="FromDate" class="form-control" value="<?= esc($from) ?>" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label">To</label>
                    <input type="date" name="ToDate" class="form-control" value="<?= esc($to) ?>" required>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Generate</button>
                </div>

            </form>

        </div>
    </div>

    <?php if (!empty($summary)): ?>

        <div class="card border-0 shadow rounded-4">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Roll No</th>
                            <th>Student</th>
                            <th>Present</th>
                            <th>Absent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($summary as $row): ?>
                            <tr>
                                <td><?= esc($row['RollNo']) ?></td>
                                <td><?= esc($row['StudentName']) ?></td>
                                <td><span class="badge bg-success"><?= $row['Present'] ?></span></td>
                                <td><span class="badge bg-danger"><?= $row['Absent'] ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>