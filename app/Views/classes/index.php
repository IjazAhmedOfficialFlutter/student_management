<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-building text-primary"></i>
                <?= lang('App.classes') ?>
            </h2>

            <p class="text-muted mb-0">
                 <?= lang('App.manageClassesDescription') ?>
            </p>
        </div>

        <a href="<?= site_url('classes/create') ?>" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-circle"></i>
            <?= lang('App.addClass') ?>
        </a>

    </div>

    <!-- Cards -->
    <div class="row">

        <?php if(!empty($classes)): ?>

            <?php foreach($classes as $class): ?>

      <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">

                <div class="card shadow-sm border-0 rounded-4 class-card">

                 <div class="card-body p-3">

    <div class="d-flex justify-content-between align-items-center">

        <div class="icon-circle bg-primary text-white">
            <i class="bi bi-building"></i>
        </div>

        <span class="badge bg-success">
           <?= lang('App.active') ?>
        </span>

    </div>

    <h5 class="fw-bold mt-3 mb-1">
        <?= esc($class['ClassName']) ?>
    </h5>

    <small class="text-muted d-block mb-3">
      <?= lang('App.studentManagementClass') ?>
    </small>

    <div class="row text-center">

        <div class="col-6 border-end">

            <small class="text-muted d-block">
              <?= lang('App.students') ?>
            </small>

            <h5 class="mb-0 fw-bold text-primary">
                <?= $class['StudentCount'] ?? 0 ?>
            </h5>

        </div>

        <div class="col-6">

            <small class="text-muted d-block">
                <?= lang('App.status') ?>
            </small>

            <h6 class="mb-0 text-success">
               <?= lang('App.running') ?>
            </h6>

        </div>

    </div>

</div>

           <div class="card-footer bg-white border-0 p-3">

    <a href="<?= site_url('classes/'.$class['ClassID'].'/students') ?>"
       class="btn btn-primary btn-sm w-100 rounded-pill">

        <i class="bi bi-people-fill me-2"></i>
     <?= lang('App.viewStudents') ?>

    </a>

</div>

                </div>

            </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-12">

                <div class="alert alert-info">

                     <?= lang('App.noClassesFound') ?>

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>