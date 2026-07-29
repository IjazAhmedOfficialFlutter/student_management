<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-archive-fill text-warning me-2"></i>
                <?= lang('App.archivedStudents') ?>
            </h2>

            <p class="text-muted mb-0">
                <?= lang('App.archivedStudentsDescription') ?>
            </p>
        </div>

        <a href="<?= site_url('students') ?>"
           class="btn btn-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left-circle me-2"></i>
            <?= lang('App.backToStudents') ?>
        </a>

    </div>

    <!-- Information Card -->
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <div class="d-flex align-items-start">

                <div class="me-3">

                    <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                         style="width:55px;height:55px;">

                        <i class="bi bi-info-circle-fill text-warning fs-3"></i>

                    </div>

                </div>

                <div>

                    <h5 class="fw-semibold mb-2">
                        <?= lang('App.note') ?>
                    </h5>

                    <p class="text-muted mb-0">
                        <?= lang('App.archivedStudentsInfo') ?>
                    </p>

                </div>

            </div>

        </div>

    </div>
<!-- Archived Students Table -->
<div class="card shadow-sm border-0 rounded-4">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="bi bi-archive-fill text-warning me-2"></i>
            <?= lang('App.archivedStudents') ?>
        </h5>

        <span class="badge bg-warning text-dark">
            <?= count($students) ?> <?= lang('App.students') ?>
        </span>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th><?= lang('App.photo') ?></th>
                    <th><?= lang('App.rollNo') ?></th>
                    <th><?= lang('App.studentName') ?></th>
                    <th><?= lang('App.fatherName') ?></th>
                    <th><?= lang('App.class') ?></th>
                    <th><?= lang('App.phone') ?></th>
                    <th><?= lang('App.cnic') ?></th>
                    <th><?= lang('App.status') ?></th>
                    <th width="170"><?= lang('App.action') ?></th>

                </tr>

            </thead>

            <tbody>

            <?php if(!empty($students)): ?>

                <?php foreach($students as $student): ?>

                <tr>

                    <td width="70">

                        <?php if(!empty($student['Photo'])): ?>

                            <img src="<?= base_url('uploads/students/'.$student['Photo']) ?>"
                                 class="rounded-circle border"
                                 width="50"
                                 height="50"
                                 style="object-fit:cover;">

                        <?php else: ?>

                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($student['StudentName']) ?>&background=6c757d&color=fff"
                                 class="rounded-circle"
                                 width="50">

                        <?php endif; ?>

                    </td>

                    <td>
                        <span class="badge bg-primary">
                            <?= esc($student['RollNo']) ?>
                        </span>
                    </td>

                    <td>
                        <strong><?= esc($student['StudentName']) ?></strong>
                    </td>

                    <td><?= esc($student['FatherName']) ?></td>

                    <td>
                        <span class="badge bg-info">
                            <?= esc($student['ClassName']) ?>
                        </span>
                    </td>

                    <td><?= esc($student['Phone']) ?></td>

                    <td><?= esc($student['CNIC']) ?></td>

                    <td>
                        <span class="badge bg-warning text-dark">
                            <?= lang('App.archived') ?>
                        </span>
                    </td>

                    <td>

                  <button
    class="btn btn-success btn-sm restoreBtn"
    data-id="<?= $student['StudentID'] ?>"
    data-name="<?= esc($student['StudentName']) ?>">

    <i class="bi bi-arrow-counterclockwise"></i>
    <?= lang('App.restore') ?>

</button>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="9" class="text-center py-5">

                        <i class="bi bi-archive fs-1 text-secondary"></i>

                        <h5 class="mt-3">
                            <?= lang('App.noArchivedStudents') ?>
                        </h5>

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</div>

<script>

document.querySelectorAll('.restoreBtn').forEach(function(btn){

    btn.addEventListener('click', function(){

        let id   = this.dataset.id;
        let name = this.dataset.name;

        document.getElementById('restoreStudentName').innerText = name;

        document.getElementById('restoreLink').href =
            "<?= site_url('students/restore/') ?>" + id;

        let modal = new bootstrap.Modal(
            document.getElementById('restoreModal')
        );

        modal.show();

    });

});

</script>

<div class="modal fade" id="restoreModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">
                    <i class="bi bi-arrow-counterclockwise me-2"></i>
                    <?= lang('App.restoreStudent') ?>
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <p>

                    <?= lang('App.restoreConfirmation') ?>

                    <strong id="restoreStudentName"></strong> ?

                </p>

                <div class="alert alert-success mb-0">

                    <i class="bi bi-info-circle-fill me-2"></i>

                    <?= lang('App.restoreWarning') ?>

                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    <?= lang('App.cancel') ?>

                </button>

                <a href=""
                   id="restoreLink"
                   class="btn btn-success">

                    <i class="bi bi-arrow-counterclockwise"></i>

                    <?= lang('App.restore') ?>

                </a>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>