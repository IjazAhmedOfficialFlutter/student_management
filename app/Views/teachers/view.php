<?= $this->extend('layouts/master') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- Cover -->
    <div class="card border-0 shadow rounded-4 overflow-hidden">

        <div style="
            height:240px;
            background:
            linear-gradient(135deg,#0d6efd,#3b82f6,#60a5fa);
        ">
        </div>

        <div class="card-body">

            <div class="row">

                <!-- Left -->

                <div class="col-lg-4 text-center">

                    <img src="<?= base_url('uploads/teachers/'.$teacher['Photo']) ?>"
                         class="rounded-circle border border-5 border-white shadow"
                         style="
                            width:170px;
                            height:170px;
                            object-fit:cover;
                            margin-top:-120px;
                         ">

                    <h3 class="fw-bold mt-3">

                        <?= esc($teacher['TeacherName']) ?>

                    </h3>

                    <div class="text-muted">

                        Employee #
                        <strong>
                            <?= esc($teacher['EmployeeNo']) ?>
                        </strong>

                    </div>

                    <div class="mt-2">

                        <?php if($teacher['Status']=='Active'): ?>

                            <span class="badge bg-success px-3 py-2">

                                Active

                            </span>

                        <?php else: ?>

                            <span class="badge bg-danger px-3 py-2">

                                Inactive

                            </span>

                        <?php endif; ?>

                    </div>

                    <hr>

                    <div class="text-start">

                        <p>

                            <i class="bi bi-mortarboard-fill text-primary me-2"></i>

                            <?= esc($teacher['Qualification']) ?>

                        </p>

                        <p>

                            <i class="bi bi-award-fill text-warning me-2"></i>

                            <?= esc($teacher['Experience']) ?>

                            Years Experience

                        </p>

                        <p>

                            <i class="bi bi-calendar-event text-success me-2"></i>

                            Joined

                            <?= date('d M Y',strtotime($teacher['JoiningDate'])) ?>

                        </p>

                    </div>

                </div>

                <!-- Right -->

                <div class="col-lg-8">

                    <h4 class="fw-bold mb-4">

                        Personal Information

                    </h4>

                    <div class="row g-4">

                        <div class="col-md-6">

                            <label class="text-muted small">

                                Father Name

                            </label>

                            <h6>

                                <?= esc($teacher['FatherName']) ?>

                            </h6>

                        </div>

                        <div class="col-md-6">

                            <label class="text-muted small">

                                Gender

                            </label>

                            <h6>

                                <?= esc($teacher['Gender']) ?>

                            </h6>

                        </div>

                        <div class="col-md-6">

                            <label class="text-muted small">

                                Date of Birth

                            </label>

                            <h6>

                                <?= date('d M Y',strtotime($teacher['DOB'])) ?>

                            </h6>

                        </div>

                        <div class="col-md-6">

                            <label class="text-muted small">

                                Phone

                            </label>

                            <h6>

                                <?= esc($teacher['Phone']) ?>

                            </h6>

                        </div>

                        <div class="col-md-6">

                            <label class="text-muted small">

                                Email

                            </label>

                            <h6>

                                <?= esc($teacher['Email']) ?>

                            </h6>

                        </div>

                        <div class="col-md-6">

                            <label class="text-muted small">

                                CNIC

                            </label>

                            <h6>

                                <?= esc($teacher['CNIC']) ?>

                            </h6>

                        </div>

                        <div class="col-12">

                            <label class="text-muted small">

                                Address

                            </label>

                            <h6>

                                <?= esc($teacher['Address']) ?>

                            </h6>

                        </div>

                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">

                        <a href="<?= site_url('teachers/edit/'.$teacher['TeacherID']) ?>"
                           class="btn btn-primary rounded-pill">

                            <i class="bi bi-pencil"></i>

                            Edit Profile

                        </a>

                        <a href="<?= site_url('teachers') ?>"
                           class="btn btn-outline-secondary rounded-pill">

                            Back

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>