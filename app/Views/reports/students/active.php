<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="row mb-4 align-items-center">

        <div class="col-md-6">

            <h2 class="fw-bold">
                <i class="bi bi-person-check-fill text-success"></i>
                Active Students Report
            </h2>

            <p class="text-muted mb-0">
                List of all active students.
            </p>

        </div>

        <div class="col-md-6 text-md-end mt-3 mt-md-0">

            <a href="<?= site_url('reports') ?>" class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left"></i>
                Back to Reports

            </a>

        </div>

    </div>

    <div class="card shadow border-0">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">

                <i class="bi bi-person-check-fill"></i>
                Active Students

            </h5>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="70">Photo</th>
                            <th>Roll No</th>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th width="120">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if (!empty($students)): ?>

                        <?php foreach ($students as $student): ?>

                            <tr>

                                <td>

                                    <?php if (!empty($student['Photo'])): ?>

                                        <img
                                            src="<?= base_url('uploads/students/' . $student['Photo']) ?>"
                                            class="rounded-circle"
                                            width="50"
                                            height="50"
                                            style="object-fit:cover;">

                                    <?php else: ?>

                                        <img
                                            src="<?= base_url('assets/images/no-image.png') ?>"
                                            class="rounded-circle"
                                            width="50"
                                            height="50">

                                    <?php endif; ?>

                                </td>

                                <td><?= esc($student['RollNo']) ?></td>

                                <td><?= esc($student['StudentName']) ?></td>

                                <td><?= esc($student['ClassName']) ?></td>

                                <td><?= esc($student['Gender']) ?></td>

                                <td>

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                </td>

                                <td>

                                   <a href="<?= site_url('reports/students/detail/'.$student['StudentID'].'?return='.urlencode(current_url())) ?>"
   class="btn btn-sm btn-success">
    <i class="bi bi-eye"></i> View
</a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="7" class="text-center py-5">

                                <i class="bi bi-person-check fs-1 text-muted"></i>

                                <h5 class="mt-3">
                                    No Active Students Found
                                </h5>

                                <p class="text-muted">
                                    There are currently no active student records.
                                </p>

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

        <?php if (!empty($students)): ?>

        <div class="card-footer">

            <?= $pager->links('students') ?>

        </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>