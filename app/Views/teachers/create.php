<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>


<div class="container-fluid">



    <div class="row">
        <div class="col-lg-10 mx-auto">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><?= lang('App.addTeacher') ?></h4>
                </div>

                <div class="card-body">

                    <form action="<?= site_url('teachers/store') ?>" method="post" enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <!-- Row 1 -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?= lang('App.employeeNo') ?></label>

                                <input
                                    type="text"
                                    name="EmployeeNo"
                                    value="<?= old('EmployeeNo') ?>"
                                    class="form-control <?= validation_show_error('EmployeeNo') ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('EmployeeNo') ?>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?= lang('App.teacherName') ?></label>

                                <input
                                    type="text"
                                    name="TeacherName"
                                    value="<?= old('TeacherName') ?>"
                                    class="form-control <?= validation_show_error('TeacherName') ? 'is-invalid' : '' ?>">

                                <div class="invalid-feedback">
                                    <?= validation_show_error('TeacherName') ?>
                                </div>
                            </div>

                        </div>

                        <!-- Row 2 -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?= lang('App.fatherName') ?></label>

                                <input
                                    type="text"
                                    name="FatherName"
                                    value="<?= old('FatherName') ?>"
                                    class="form-control <?= validation_show_error('FatherName') ? 'is-invalid' : '' ?>">

                                <div class="invalid-feedback">
                                    <?= validation_show_error('FatherName') ?>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?= lang('App.email') ?></label>

                                <input
                                    type="email"
                                    name="Email"
                                    value="<?= old('Email') ?>"
                                    class="form-control <?= validation_show_error('Email') ? 'is-invalid' : '' ?>">

                                <div class="invalid-feedback">
                                    <?= validation_show_error('Email') ?>
                                </div>
                            </div>

                        </div>

                        <!-- Row 3 -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?= lang('App.phone') ?></label>

                                <input
                                    type="text"
                                    name="Phone"
                                    value="<?= old('Phone') ?>"
                                    class="form-control <?= validation_show_error('Phone') ? 'is-invalid' : '' ?>">

                                <div class="invalid-feedback">
                                    <?= validation_show_error('Phone') ?>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?= lang('App.gender') ?></label>

                                <select
                                    name="Gender"
                                    class="form-select <?= validation_show_error('Gender') ? 'is-invalid' : '' ?>">

                                    <option value="">
                                        <?= lang('App.selectGender') ?>
                                    </option>

                                    <option value="Male" <?= old('Gender') == 'Male' ? 'selected' : '' ?>>
                                        <?= lang('App.male') ?>
                                    </option>

                                    <option value="Female" <?= old('Gender') == 'Female' ? 'selected' : '' ?>>
                                        <?= lang('App.female') ?>
                                    </option>

                                </select>

                                <div class="invalid-feedback">
                                    <?= validation_show_error('Gender') ?>
                                </div>
                            </div>

                        </div>

                        <!-- Row 4 -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?= lang('App.dob') ?></label>

                                <input
                                    type="date"
                                    name="DOB"
                                    value="<?= old('DOB') ?>"
                                    class="form-control <?= validation_show_error('DOB') ? 'is-invalid' : '' ?>">

                                <div class="invalid-feedback">
                                    <?= validation_show_error('DOB') ?>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?= lang('App.joiningDate') ?></label>

                                <input
                                    type="date"
                                    name="JoiningDate"
                                    value="<?= old('JoiningDate') ?>"
                                    class="form-control <?= validation_show_error('JoiningDate') ? 'is-invalid' : '' ?>">

                                <div class="invalid-feedback">
                                    <?= validation_show_error('JoiningDate') ?>
                                </div>
                            </div>

                        </div>

                        <!-- Row 5 -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?= lang('App.qualification') ?></label>

                                <input
                                    type="text"
                                    name="Qualification"
                                    value="<?= old('Qualification') ?>"
                                    class="form-control <?= validation_show_error('Qualification') ? 'is-invalid' : '' ?>">

                                <div class="invalid-feedback">
                                    <?= validation_show_error('Qualification') ?>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?= lang('App.experience') ?></label>

                                <input
                                    type="text"
                                    name="Experience"
                                    value="<?= old('Experience') ?>"
                                    class="form-control <?= validation_show_error('Experience') ? 'is-invalid' : '' ?>">

                                <div class="invalid-feedback">
                                    <?= validation_show_error('Experience') ?>
                                </div>
                            </div>

                        </div>

                        <!-- Row 6 -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?= lang('App.cnic') ?></label>

                                <input
                                    type="text"
                                    name="CNIC"
                                    value="<?= old('CNIC') ?>"
                                    class="form-control <?= validation_show_error('CNIC') ? 'is-invalid' : '' ?>">

                                <div class="invalid-feedback">
                                    <?= validation_show_error('CNIC') ?>
                                </div>
                            </div>

                        </div>

                        <!-- Address -->
                        <div class="mb-3">

                            <label class="form-label"><?= lang('App.address') ?></label>
                            <textarea
                                name="Address"
                                rows="3"
                                class="form-control <?= validation_show_error('Address') ? 'is-invalid' : '' ?>"><?= old('Address') ?></textarea>

                            <div class="invalid-feedback">
                                <?= validation_show_error('Address') ?>
                            </div>
                        </div>

                        <!-- Photo -->
                        <div class="mb-4">

                            <label class="form-label"><?= lang('App.teacherPhoto') ?></label>

                            <input
                                type="file"
                                name="Photo"
                                    id="Photo"

                                class="form-control <?= ($validation && $validation->getError('Photo')) ? 'is-invalid' : '' ?>">

                            <div class="invalid-feedback">
                                <?= $validation ? $validation->getError('Photo') : '' ?>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">
                            <?= lang('App.save') ?>
                        </button>

                        <a href="<?= site_url('teachers') ?>" class="btn btn-secondary">
                            <?= lang('App.back') ?>
                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
<script src="<?= base_url('assets/js/image-preview.js') ?>"></script>

<script>

previewImage('Photo', 'photoPreview');

</script>

<?= $this->endSection() ?>