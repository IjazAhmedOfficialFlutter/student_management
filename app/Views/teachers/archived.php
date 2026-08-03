<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-archive-fill text-warning me-2"></i>

                <?= lang('App.archivedTeachers') ?>

            </h2>

            <p class="text-muted mb-0">

                <?= lang('App.archivedTeachersDescription') ?>

            </p>

        </div>

        <a href="<?= site_url('teachers') ?>"
           class="btn btn-secondary rounded-pill px-4">

            <i class="bi bi-arrow-left-circle me-2"></i>

            <?= lang('App.backToTeachers') ?>

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

                        <?= lang('App.archivedTeachersInfo') ?>

                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- Table -->
    <div class="card shadow-sm border-0 rounded-4">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <h5 class="mb-0">

                <i class="bi bi-archive-fill text-warning me-2"></i>

                <?= lang('App.archivedTeachers') ?>

            </h5>

            <span class="badge bg-warning text-dark">

                <?= count($teachers) ?>

                <?= lang('App.teachers') ?>

            </span>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                <tr>

                    <th><?= lang('App.photo') ?></th>

                    <th><?= lang('App.employeeNo') ?></th>

                    <th><?= lang('App.teacherName') ?></th>

                    <th><?= lang('App.qualification') ?></th>

                    <th><?= lang('App.phone') ?></th>

                    <th><?= lang('App.status') ?></th>

                    <th width="170"><?= lang('App.action') ?></th>

                </tr>

                </thead>

                <tbody>

                <?php if(!empty($teachers)): ?>

                    <?php foreach($teachers as $teacher): ?>

                        <tr>

                            <td width="70">

                                <?php if(!empty($teacher['Photo'])): ?>

                                    <img src="<?= base_url('uploads/teachers/'.$teacher['Photo']) ?>"
                                         class="rounded-circle border"
                                         width="50"
                                         height="50"
                                         style="object-fit:cover;">

                                <?php else: ?>

                                    <img src="<?= base_url('uploads/teachers/default.png') ?>"
                                         class="rounded-circle border"
                                         width="50"
                                         height="50">

                                <?php endif; ?>

                            </td>

                            <td>

                                <span class="badge bg-primary">

                                    <?= esc($teacher['EmployeeNo']) ?>

                                </span>

                            </td>

                            <td>

                                <strong>

                                    <?= esc($teacher['TeacherName']) ?>

                                </strong>

                            </td>

                            <td>

                                <?= esc($teacher['Qualification']) ?>

                            </td>

                            <td>

                                <?= esc($teacher['Phone']) ?>

                            </td>

                            <td>

                                <span class="badge bg-warning text-dark">

                                    <?= lang('App.archived') ?>

                                </span>

                            </td>

                            <td>

                                <button
                                    class="btn btn-success btn-sm restoreBtn"
                                    data-id="<?= $teacher['TeacherID'] ?>"
                                    data-name="<?= esc($teacher['TeacherName']) ?>">

                                    <i class="bi bi-arrow-counterclockwise"></i>

                                    <?= lang('App.restore') ?>

                                </button>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="7" class="text-center py-5">

                            <i class="bi bi-archive fs-1 text-secondary"></i>

                            <h5 class="mt-3">

                                <?= lang('App.noArchivedTeachers') ?>

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

        document.getElementById('restoreTeacherName').innerText = this.dataset.name;

        document.getElementById('restoreLink').href =
            "<?= site_url('teachers/restore/') ?>" + this.dataset.id;

        new bootstrap.Modal(document.getElementById('restoreModal')).show();

    });

});

</script>

<div class="modal fade" id="restoreModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">

                    <i class="bi bi-arrow-counterclockwise me-2"></i>

                    <?= lang('App.restoreTeacher') ?>

                </h5>

                <button class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <p>

                    <?= lang('App.restoreConfirmation') ?>

                    <strong id="restoreTeacherName"></strong> ?

                </p>

                <div class="alert alert-success mb-0">

                    <i class="bi bi-info-circle-fill me-2"></i>

                    <?= lang('App.restoreTeacherWarning') ?>

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