<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
Locale: <?= service('request')->getLocale(); ?>
<br>
Dashboard: <?= lang('App.dashboard'); ?>
<br>
Students: <?= lang('App.students'); ?>
<div class="container-fluid">

    <div class="row mb-4">

        <div class="col">

            <h2 class="fw-bold">
                <i class="bi bi-speedometer2"></i>
              <?= lang('App.dashboard') ?>
            </h2>

            <p class="text-muted">
               <?= lang('App.welcome') ?>
            </p>

        </div>

    </div>

    <div class="row">

        <div class="col-md-3 mb-4">

            <div class="card shadow border-0">

                <div class="card-body">

              <h5><?= lang('App.totalStudents') ?></h5>

<h2 class="text-primary">
    <?= $totalStudents ?>
</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card shadow border-0">

                <div class="card-body">

           <h5><?= lang('App.totalClasses') ?></h5>

<h2 class="text-success">
    <?= $totalClasses ?>
</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card shadow border-0">

                <div class="card-body">

                   <h5><?= lang('App.totalSubjects') ?></h5>

<h2 class="text-warning">
    <?= $totalSubjects ?>
</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card shadow border-0">

                <div class="card-body">
<h5><?= lang('App.totalUsers') ?></h5>

<h2 class="text-danger">
    <?= $totalUsers ?>
</h2>
                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>