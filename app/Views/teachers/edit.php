<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                <i class="bi bi-person-workspace text-warning"></i>
                Edit Teacher
            </h2>

            <p class="text-muted mb-0">
                Update teacher information.
            </p>
        </div>

        <a href="<?= site_url('teachers') ?>"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>
            Back

        </a>

    </div>

    <form action="<?= site_url('teachers/update/'.$teacher['TeacherID']) ?>"
          method="post"
          enctype="multipart/form-data">

        <?= csrf_field() ?>

        <div class="card border-0 shadow rounded-4">

            <div class="card-body">

                <div class="row">

                    <!-- Photo -->
                    <div class="col-md-3 text-center">
<?php if (!empty($teacher['Photo'])): ?>

    <img
        id="photoPreview"
        src="<?= base_url('uploads/teachers/'.$teacher['Photo']) ?>"
        class="rounded-circle border shadow"
        width="170"
        height="170"
        style="object-fit:cover;">

<?php else: ?>

    <img
        id="photoPreview"
        src="<?= base_url('uploads/teachers/default.png') ?>"
        class="rounded-circle border shadow"
        width="170"
        height="170"
        style="object-fit:cover;">

<?php endif; ?>

                        <div class="mt-3">

                            <input
    type="file"
    id="Photo"
    name="Photo"
    class="form-control"
    accept="image/*">

                        </div>

                    </div>

                    <!-- Details -->
                    <div class="col-md-9">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Employee No
                                </label>

                                <input
                                    type="text"
                                    name="EmployeeNo"
                                    class="form-control"
                                    value="<?= old('EmployeeNo',$teacher['EmployeeNo']) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Teacher Name
                                </label>

                                <input
                                    type="text"
                                    name="TeacherName"
                                    class="form-control"
                                    value="<?= old('TeacherName',$teacher['TeacherName']) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Father Name
                                </label>

                                <input
                                    type="text"
                                    name="FatherName"
                                    class="form-control"
                                    value="<?= old('FatherName',$teacher['FatherName']) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    CNIC
                                </label>

                                <input
                                    type="text"
                                    name="CNIC"
                                    class="form-control"
                                    value="<?= old('CNIC',$teacher['CNIC']) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="Phone"
                                    class="form-control"
                                    value="<?= old('Phone',$teacher['Phone']) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="Email"
                                    class="form-control"
                                    value="<?= old('Email',$teacher['Email']) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Gender
                                </label>

                                <select
                                    name="Gender"
                                    class="form-select">

                                    <option value="Male"
                                        <?= $teacher['Gender']=='Male'?'selected':'' ?>>
                                        Male
                                    </option>

                                    <option value="Female"
                                        <?= $teacher['Gender']=='Female'?'selected':'' ?>>
                                        Female
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Date of Birth
                                </label>

                                <input
                                    type="date"
                                    name="DOB"
                                    class="form-control"
                                    value="<?= old('DOB',$teacher['DOB']) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Qualification
                                </label>

                                <input
                                    type="text"
                                    name="Qualification"
                                    class="form-control"
                                    value="<?= old('Qualification',$teacher['Qualification']) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Experience (Years)
                                </label>

                                <input
                                    type="number"
                                    name="Experience"
                                    class="form-control"
                                    value="<?= old('Experience',$teacher['Experience']) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Joining Date
                                </label>

                                <input
                                    type="date"
                                    name="JoiningDate"
                                    class="form-control"
                                    value="<?= old('JoiningDate',$teacher['JoiningDate']) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Status
                                </label>

                                <select
                                    name="Status"
                                    class="form-select">

                                    <option value="Active"
                                        <?= $teacher['Status']=='Active'?'selected':'' ?>>
                                        Active
                                    </option>

                                    <option value="Archived"
                                        <?= $teacher['Status']=='Archived'?'selected':'' ?>>
                                        Inactive
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-12 mb-3">

                                <label class="form-label">
                                    Address
                                </label>

                                <textarea
                                    name="Address"
                                    rows="3"
                                    class="form-control"><?= old('Address',$teacher['Address']) ?></textarea>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer bg-white text-end">

                <a href="<?= site_url('teachers') ?>"
                   class="btn btn-light">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="btn btn-warning">

                    <i class="bi bi-check-circle"></i>

                    Update Teacher

                </button>

            </div>

        </div>

    </form>

</div>

<script src="<?= base_url('assets/js/image-preview.js') ?>"></script>

<script>

previewImage('Photo', 'photoPreview');

</script>

<?= $this->endSection() ?>