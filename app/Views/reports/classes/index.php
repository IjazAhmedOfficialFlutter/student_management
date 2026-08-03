<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

<div class="row mb-4 align-items-center">

    <div class="col-md-6">

        <h2 class="fw-bold">

            <i class="bi bi-building text-success"></i>

            Class Reports

        </h2>

        <p class="text-muted mb-0">

            View all classes and student counts.

        </p>

    </div>

    <div class="col-md-6 text-md-end">

        <a href="<?= site_url('reports') ?>"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left"></i>

            Back to Reports

        </a>

    </div>

</div>

<div class="card shadow border-0">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            <i class="bi bi-building"></i>

            Class Summary

        </h5>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th>#</th>
                    <th>Class</th>
                    <th>Total Students</th>
                    <th width="120">Action</th>

                </tr>

            </thead>

            <tbody>

            <?php if(!empty($classes)): ?>

                <?php $i = 1; ?>

                <?php foreach($classes as $class): ?>

                <tr>

                    <td><?= $i++ ?></td>

                    <td>

                        <?= esc($class['ClassName']) ?>

                    </td>

                    <td>

                        <span class="badge bg-primary">

                            <?= $class['StudentCount'] ?>

                        </span>

                    </td>

                    <td>

                        <a href="<?= site_url('reports/classes/detail/'.$class['ClassID']) ?>"
                           class="btn btn-success btn-sm">

                            <i class="bi bi-eye"></i>

                            View

                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="4" class="text-center py-5">

                        No Classes Found

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</div>

<?= $this->endSection() ?>