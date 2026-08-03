<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
<div class="row mb-4 align-items-center">

    <div class="col-md-6">

        <h2 class="fw-bold mb-0">
            <i class="bi bi-person-vcard-fill text-primary"></i>
            Student Profile
        </h2>

    </div>

    <div class="col-md-6 text-md-end mt-3 mt-md-0">

    <a href="<?= !empty($return)
        ? esc($return)
        : site_url('reports/students/all') ?>"
   class="btn btn-outline-secondary">

    <i class="bi bi-arrow-left"></i>
    Back

</a>

    </div>

</div>

    <div class="card shadow border-0">

        <div class="card-body">

            <div class="text-center mb-4">
<?php if (!empty($student['Photo'])): ?>

<img
    src="<?= base_url('uploads/students/' . $student['Photo']) ?>"
    class="shadow"
    width="160"
    height="200"
    style="object-fit:cover;border-radius:15px;cursor:pointer;"
    data-bs-toggle="modal"
    data-bs-target="#photoModal">

<?php else: ?>

<img
    src="<?= base_url('assets/images/no-image.png') ?>"
    class="shadow"
    width="160"
    height="200"
    style="object-fit:cover;border-radius:15px;cursor:pointer;"
    data-bs-toggle="modal"
    data-bs-target="#photoModal">

<?php endif; ?>
                <h3 class="mt-3 fw-bold">

                    <?= esc($student['StudentName']) ?>

                </h3>

                <span class="badge bg-success">

                    <?= esc($student['Status']) ?>

                </span>

            </div>

            <hr>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <strong>Roll No</strong>

                    <p><?= esc($student['RollNo']) ?></p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Class</strong>

                    <p><?= esc($student['ClassName']) ?></p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Father Name</strong>

                    <p><?= esc($student['FatherName']) ?></p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Gender</strong>

                    <p><?= esc($student['Gender']) ?></p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Date of Birth</strong>

                    <p><?= esc($student['DOB']) ?></p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Phone</strong>

                    <p><?= esc($student['Phone']) ?></p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>Email</strong>

                    <p><?= esc($student['Email']) ?></p>

                </div>

                <div class="col-md-6 mb-3">

                    <strong>CNIC</strong>

                    <p><?= esc($student['CNIC']) ?></p>

                </div>

                <div class="col-12 mb-3">

                    <strong>Address</strong>

                    <p><?= esc($student['Address']) ?></p>

                </div>

                <div class="col-md-6">

                    <strong>Created At</strong>

                    <p><?= esc($student['CreatedAt']) ?></p>

                </div>

                <div class="col-md-6">

                    <strong>Updated At</strong>

                    <p><?= esc($student['UpdatedAt']) ?></p>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="modal fade" id="photoModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-xl">

        <div class="modal-content border-0 bg-transparent">

            <div class="text-end">

                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">

                    <i class="bi bi-x-lg"></i>

                </button>

            </div>

            <div class="modal-body text-center">

                <img
                    src="<?= !empty($student['Photo'])
                        ? base_url('uploads/students/' . $student['Photo'])
                        : base_url('assets/images/no-image.png') ?>"
                    class="img-fluid rounded shadow">

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>