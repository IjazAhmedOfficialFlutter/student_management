<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-8 mx-auto">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">
                     <?= lang('App.addTeacherAssignment') ?>
                    </h4>

                </div>

                <div class="card-body">

                    <form action="<?= site_url('teacher-assignments/store') ?>" method="post">

                        <?= csrf_field() ?>


                        <div class="mb-3">

    <label class="form-label">
<?= lang('App.teacher') ?>

    </label>

    <select
        name="TeacherID"
        class="form-select <?= validation_show_error('TeacherID') ? 'is-invalid' : '' ?>">

        <option value="">
        <?= lang('App.selectTeacher') ?>
        </option>

        <?php foreach ($teachers as $teacher): ?>

            <option
                value="<?= $teacher['TeacherID'] ?>"
                <?= old('TeacherID') == $teacher['TeacherID'] ? 'selected' : '' ?>>

                <?= esc($teacher['TeacherName']) ?>

            </option>

        <?php endforeach; ?>

    </select>

    <div class="invalid-feedback">

        <?= validation_show_error('TeacherID') ?>

    </div>

</div>
<div class="mb-3">

    <label class="form-label">

<?= lang('App.subject') ?>

    </label>

    <select
        name="SubjectID"
        class="form-select <?= validation_show_error('SubjectID') ? 'is-invalid' : '' ?>">

        <option value="">
        <?= lang('App.class') ?>
        </option>

        <?php foreach ($subjects as $subject): ?>

            <option
                value="<?= $subject['SubjectID'] ?>"
                <?= old('SubjectID') == $subject['SubjectID'] ? 'selected' : '' ?>>

                <?= esc($subject['SubjectName']) ?>

            </option>

        <?php endforeach; ?>

    </select>

    <div class="invalid-feedback">

        <?= validation_show_error('SubjectID') ?>

    </div>

</div>

<div class="mb-3">

    <label class="form-label">

  <?= lang('App.class') ?>

    </label>

    <select
        name="ClassID"
        class="form-select <?= validation_show_error('ClassID') ? 'is-invalid' : '' ?>">

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

<div class="d-flex justify-content-end">

    <a
        href="<?= site_url('teacher-assignments') ?>"
        class="btn btn-secondary me-2">

       <?= lang('App.back') ?>

    </a>

    <button
        type="submit"
        class="btn btn-primary">
<?= lang('App.saveAssignment') ?>

    </button>

</div>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>