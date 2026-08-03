
<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between">

               <h4><?= lang('App.teacherAssignments') ?></h4>
            <a href="<?= site_url('teacher-assignments/create') ?>"
               class="btn btn-primary">

            
                <?= lang('App.addTeacherAssignment') ?>
            </a>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>#</th>

                        <th><?= lang('App.teacher') ?></th>

                        <th><?= lang('App.subject') ?></th>

                        <th><?= lang('App.class') ?></th>

                        <th><?= lang('App.status') ?></th>
                    </tr>

                </thead>

                <tbody>

                  <?php if (!empty($assignments)): ?>

                    <?php $i = 1; ?>

                    <?php foreach ($assignments as $row): ?>

                        <tr>

                            <td><?= $i++ ?></td>

                            <td><?= esc($row['TeacherName']) ?></td>

                            <td><?= esc($row['SubjectName']) ?></td>

                            <td><?= esc($row['ClassName']) ?></td>

                            <td><?= esc($row['Status']) ?></td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="5" class="text-center">

                            <?= lang('App.noAssignmentsFound') ?>

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>