<div class="row">

    <div class="col-md-3 mb-4">

        <div class="card shadow border-0 h-100">

            <div class="card-body text-center">

                <i class="bi bi-mortarboard-fill fs-1 text-primary"></i>

                <h5 class="mt-3">
                    <?= lang('App.totalStudents') ?>
                </h5>

                <h2 class="text-primary">
                    <?= $totalStudents ?>
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card shadow border-0 h-100">

            <div class="card-body text-center">

                <i class="bi bi-building fs-1 text-success"></i>

                <h5 class="mt-3">
                    <?= lang('App.totalClasses') ?>
                </h5>

                <h2 class="text-success">
                    <?= $totalClasses ?>
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card shadow border-0 h-100">

            <div class="card-body text-center">

                <i class="bi bi-book-fill fs-1 text-warning"></i>

                <h5 class="mt-3">
                    <?= lang('App.totalSubjects') ?>
                </h5>

                <h2 class="text-warning">
                    <?= $totalSubjects ?>
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-4">

        <div class="card shadow border-0 h-100">

            <div class="card-body text-center">

                <i class="bi bi-people-fill fs-1 text-danger"></i>

                <h5 class="mt-3">
                    <?= lang('App.totalUsers') ?>
                </h5>

                <h2 class="text-danger">
                    <?= $totalUsers ?>
                </h2>

            </div>

        </div>

    </div>

</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h6 class="text-muted mb-1">
                        <?= lang('App.teachers') ?>
                    </h6>

                    <h3 class="fw-bold">
                        <?= $totalTeachers ?>
                    </h3>

                    <small class="text-success">
                        <?= $activeTeachers ?>
                        <?= lang('App.active') ?>
                    </small>

                    <br>

                    <small class="text-danger">
                        <?= $archivedTeachers ?>
                        <?= lang('App.archived') ?>
                    </small>
                </div>

                <div class="rounded-circle bg-success bg-opacity-10 p-3">
                    <i class="bi bi-person-workspace fs-2 text-success"></i>
                </div>

            </div>
        </div>
    </div>
</div>