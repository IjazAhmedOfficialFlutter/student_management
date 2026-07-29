<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">
                <i class="bi bi-calendar-check text-primary"></i>
                <?= esc($class['ClassName']) ?>
            </h2>
            <p class="text-muted mb-0">
                Marking attendance for <?= esc($date) ?>
            </p>
        </div>

        <a href="<?= site_url('attendance') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Back
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow rounded-4">

        <div class="card-body">

            <form action="<?= site_url('attendance/store') ?>" method="post">

                <?= csrf_field() ?>

                <input type="hidden" name="ClassID" value="<?= $class['ClassID'] ?>">
                <input type="hidden" name="AttendanceDate" value="<?= esc($date) ?>">

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>Roll No</th>
                                <th>Student</th>
                                <th width="260">Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($students)): ?>

                                <?php foreach ($students as $student): ?>

                                    <?php $current = $existingMap[$student['StudentID']] ?? 'Present'; ?>

                                    <tr>
                                        <td><span class="badge bg-primary"><?= esc($student['RollNo']) ?></span></td>
                                        <td><?= esc($student['StudentName']) ?></td>
                                        <td>

                                            <div class="btn-group" role="group">

                                                <input type="radio"
                                                       class="btn-check"
                                                       name="Status[<?= $student['StudentID'] ?>]"
                                                       id="present_<?= $student['StudentID'] ?>"
                                                       value="Present"
                                                       <?= $current == 'Present' ? 'checked' : '' ?>>
                                                <label class="btn btn-outline-success btn-sm" for="present_<?= $student['StudentID'] ?>">
                                                    Present
                                                </label>

                                                <input type="radio"
                                                       class="btn-check"
                                                       name="Status[<?= $student['StudentID'] ?>]"
                                                       id="absent_<?= $student['StudentID'] ?>"
                                                       value="Absent"
                                                       <?= $current == 'Absent' ? 'checked' : '' ?>>
                                                <label class="btn btn-outline-danger btn-sm" for="absent_<?= $student['StudentID'] ?>">
                                                    Absent
                                                </label>

                                            </div>

                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        No students found in this class.
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

                <?php if (!empty($students)): ?>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i>
                        Save Attendance
                    </button>
                <?php endif; ?>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>