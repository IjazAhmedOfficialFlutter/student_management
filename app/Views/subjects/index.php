<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-book-half text-primary"></i>
                Subjects
            </h2>
            <p class="text-muted mb-0">
                Manage subjects assigned to each class.
            </p>
        </div>

        <a href="<?= site_url('subjects/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Add Subject
        </a>

    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow rounded-4">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Subject Name</th>
                        <th>Class</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($subjects)): ?>

                        <?php foreach ($subjects as $subject): ?>
                            <tr>
                                <td><?= esc($subject['SubjectID']) ?></td>
                                <td><strong><?= esc($subject['SubjectName']) ?></strong></td>
                                <td>
                                    <span class="badge bg-primary">
                                        <?= esc($subject['ClassName'] ?? 'Unassigned') ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= site_url('subjects/edit/'.$subject['SubjectID']) ?>"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a href="<?= site_url('subjects/delete/'.$subject['SubjectID']) ?>"
                                       onclick="return confirm('Delete this subject?')"
                                       class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-book fs-1 text-secondary"></i>
                                <h5 class="mt-3">No Subjects Found</h5>
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>