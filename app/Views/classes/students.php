<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">


    <!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold">
            <i class="bi bi-building text-primary"></i>
            <?= esc($class['ClassName']) ?>
        </h2>

        <p class="text-muted mb-0">
          <?= lang('App.classStudents') ?>
        </p>

    </div>

    <div class="d-flex gap-2">

        <a href="<?= site_url('classes/edit/'.$class['ClassID']) ?>" class="btn btn-outline-primary">
            <i class="bi bi-pencil-square"></i>
         <?= lang('App.editClass') ?>
        </a>

        <a href="<?= site_url('classes') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
         <?= lang('App.backToClasses') ?>
        </a>

    </div>

</div>

   

   

    <!-- Statistics -->
    <div class="row mb-4">

        <div class="col-md-3">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body">

                    <small class="text-muted">
                      <?= lang('App.studentList') ?>
                    </small>

                    <h2 class="fw-bold text-primary">

                        <?= count($students) ?>

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <!-- Student Table -->
    <div class="card border-0 shadow rounded-4">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="bi bi-people-fill text-primary"></i>

         <?= lang('App.studentList') ?>

            </h5>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                      <?= lang('App.photo') ?>
                      <?= lang('App.rollNo') ?>
                      <?= lang('App.student') ?>
                      <?= lang('App.father') ?>
                       <?= lang('App.email') ?>
                        <?= lang('App.phone') ?>
<?= lang('App.gender') ?>
<?= lang('App.actions') ?>

                    </tr>

                </thead>

                <tbody>

                <?php if(!empty($students)): ?>

                    <?php foreach($students as $student): ?>

                    <tr>

                        <td width="80">

                            <?php if(!empty($student['Photo'])): ?>

                                <img src="<?= base_url('uploads/students/'.$student['Photo']) ?>"
                                     class="rounded-circle border"
                                     width="55"
                                     height="55"
                                     style="object-fit:cover;">

                            <?php else: ?>

                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($student['StudentName']) ?>&background=0D6EFD&color=fff"
                                     class="rounded-circle"
                                     width="55">

                            <?php endif; ?>

                        </td>

                        <td>

                            <span class="badge bg-primary">

                                <?= esc($student['RollNo']) ?>

                            </span>

                        </td>

                        <td>

                            <strong>

                                <?= esc($student['StudentName']) ?>

                            </strong>

                        </td>

                        <td>

                            <?= esc($student['FatherName']) ?>

                        </td>

                        <td>

                            <?= esc($student['Email']) ?>

                        </td>

                        <td>

                            <?= esc($student['Phone']) ?>

                        </td>

                        <td>

                            <?php if($student['Gender']=="Male"): ?>

                                <span class="badge bg-info">

                               <?= lang('App.male') ?>
                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">

                          <?= lang('App.female') ?>

                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <a href="<?= site_url('students/edit/'.$student['StudentID']) ?>"
                               class="btn btn-warning btn-sm">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <a href="<?= site_url('students/delete/'.$student['StudentID']) ?>"
onclick="return confirm('<?= lang('App.deleteStudentConfirm') ?>')"
                               class="btn btn-danger btn-sm">

                                <i class="bi bi-trash"></i>

                            </a>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="8" class="text-center py-5">

                            <i class="bi bi-people fs-1 text-secondary"></i>

                            <h5 class="mt-3">

                               <?= lang('App.noStudentsFound') ?>

                            </h5>

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>