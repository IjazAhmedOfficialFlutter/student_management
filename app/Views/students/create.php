<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>


<div class="container-fluid">



    <div class="row">
        <div class="col-lg-10 mx-auto">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
              <h4 class="mb-0"><?= lang('App.addNewStudent') ?></h4>
                </div>

                <div class="card-body">

                    <form action="<?= site_url('students/store') ?>" method="post" enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <!-- Row 1 -->
                        <div class="row">

                           <div class="col-md-6 mb-3">
                          <label class="form-label"><?= lang('App.rollNo') ?></label>

                        

                                <input
                                    type="text"
                                    name="RollNo"
                                    value="<?= old('RollNo') ?>"
                                    class="form-control <?= validation_show_error('RollNo') ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                  <?= validation_show_error('RollNo') ?>



                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                            <label class="form-label"><?= lang('App.studentName') ?></label>


                                <input
                                    type="text"
                                    name="StudentName"
                                    value="<?= old('StudentName') ?>"
                                                                      class="form-control <?= validation_show_error('StudentName') ? 'is-invalid' : '' ?>">

                                <div class="invalid-feedback">
                                     <?= validation_show_error('StudentName') ?>

                                  
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
                        </div>

                        <!-- Row 4 -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><?= lang('App.dateOfBirth') ?></label>

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
<label class="form-label"><?= lang('App.class') ?></label>

                                <select
    name="ClassID"
    class="form-control <?= validation_show_error('ClassID') ? 'is-invalid' : '' ?>">

    <option value="">
        <?= lang('App.selectClass') ?>
    </option>

    <?php foreach ($classes as $class): ?>
        <option
            value="<?= $class['ClassID'] ?>"
            <?= old('ClassID') == $class['ClassID'] ? 'selected' : '' ?>>
            <?= esc($class['ClassName']) ?>
        </option>
    <?php endforeach; ?>

</select>

                                <div class="invalid-feedback">
                                 <?= validation_show_error('ClassID') ?>

                                  
                                </div>
                            </div>
                           
                            <div class="row">
                            <div class="col-md-6 mb-3">
                             <label class="form-label"><?= lang('App.section') ?></label>

<select
    name="Section"
    class="form-select <?= validation_show_error('Section') ? 'is-invalid' : '' ?>">

    <option value="">
        <?= lang('App.selectSection') ?>
    </option>

    <option value="Section A" <?= old('Section') == 'Section A' ? 'selected' : '' ?>>
        <?= lang('App.sectionA') ?>
    </option>

    <option value="Section B" <?= old('Section') == 'Section B' ? 'selected' : '' ?>>
        <?= lang('App.sectionB') ?>
    </option>

    <option value="Section C" <?= old('Section') == 'Section C' ? 'selected' : '' ?>>
        <?= lang('App.sectionC') ?>
    </option>

</select>

<div class="invalid-feedback">
 <?= validation_show_error('Section') ?>
</div>
                            </div>
                          <div class="col-md-6 mb-3">
                               <label class="form-label"><?= lang('App.cnic') ?></label>

                                <input
                                    type="cnic"
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

                      <label class="form-label"><?= lang('App.studentPhoto') ?></label>

                            <input
                                type="file"
                                name="Photo"
                                class="form-control <?=  ($validation && $validation->getError('Photo')) ? 'is-invalid' : '' ?>">

                            <div class="invalid-feedback">
                            <?= $validation ? $validation->getError('Photo') : '' ?>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">
    <?= lang('App.saveStudent') ?>
</button>

<a href="<?= site_url('students') ?>" class="btn btn-secondary">
    <?= lang('App.back') ?>
</a>
                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>

