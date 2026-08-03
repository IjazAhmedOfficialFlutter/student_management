<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">
            <i class="bi bi-people-fill"></i>
            Student Reports
        </h5>

    </div>

    <div class="card-body">

        <div class="row g-3">

            <div class="col-md-4">

                <div class="card border h-100">

                    <div class="card-body">

                        <h5>All Students</h5>

                        <p class="text-muted">
                            View all registered students.
                        </p>

                        <a href="<?= site_url('reports/students/all') ?>"
                           class="btn btn-outline-primary btn-sm">
                            Open Report
                        </a>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border h-100">

                    <div class="card-body">

                        <h5>Active Students</h5>

                        <p class="text-muted">
                            List of active students.
                        </p>

                        <a href="<?= site_url('reports/students/active') ?>"
                           class="btn btn-outline-success btn-sm">
                            Open Report
                        </a>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border h-100">

                    <div class="card-body">

                        <h5>Archived Students</h5>

                        <p class="text-muted">
                            View archived student records.
                        </p>

                        <a href="<?= site_url('reports/students/archive') ?>"
                           class="btn btn-outline-warning btn-sm">
                            Open Report
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>