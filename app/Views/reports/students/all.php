<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">
                <i class="bi bi-people-fill text-primary"></i>
                All Students
            </h2>

            <p class="text-muted mb-0">
                List of all registered students.
            </p>

        </div>

        <a href="<?= site_url('reports') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Back
        </a>

    </div>

    <div class="card shadow border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="70">Photo</th>

                            <th>Roll No</th>

                            <th>Name</th>

                            <th>Class</th>

                            <th>Gender</th>

                            <th>Status</th>

                            <th width="120">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if (! empty($students)): ?>

                        <?php foreach ($students as $student): ?>

                        <tr>

                            <td>

                                <a href="<?= site_url('reports/students/detail/' . $student['StudentID']) ?>">

                                    <?php if (! empty($student['Photo'])): ?>

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

                                </a>

                            </td>

                            <td><?= esc($student['RollNo']) ?></td>

                            <td><?= esc($student['StudentName']) ?></td>

                            <td><?= esc($student['ClassName']) ?></td>

                            <td><?= esc($student['Gender']) ?></td>

                            <td>

                                <?php if ($student['Status'] == 'Active'): ?>

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-warning">
                                        Archived
                                    </span>

                                <?php endif; ?>

                            </td>
                            <td>
<a href="<?= site_url('reports/students/detail/'.$student['StudentID'].'?return='.urlencode(current_url())) ?>"
   class="btn btn-sm btn-primary">
    <i class="bi bi-eye"></i> View
</a>

</td>

                

                        </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="7" class="text-center py-5">

                                No students found.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="mt-3">

        <?= $pager->links('students', 'bootstrap') ?>

    </div>

</div>

<?= $this->endSection() ?>