<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="row">
        <div class="col-lg-10 mx-auto">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Subject</h4>
                </div>

                <div class="card-body">

                    <form action="<?= site_url('subjects/update/'.$subject['SubjectID']) ?>" method="post">

                        <?= csrf_field() ?>

                        <div class="mb-3">

                            <label class="form-label">Subject Name</label>

                            <input
                                type="text"
                                name="SubjectName"
                                value="<?= old('SubjectName', $subject['SubjectName']) ?>"
                                class="form-control <?= validation_show_error('SubjectName') ? 'is-invalid' : '' ?>">

                            <div class="invalid-feedback">
                                <?= validation_show_error('SubjectName') ?>
                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Class</label>

                            <select
                                name="ClassID"
                                class="form-select <?= validation_show_error('ClassID') ? 'is-invalid' : '' ?>">

                                <option value="">Select Class</option>

                                <?php foreach ($classes as $class): ?>
                                    <option
                                        value="<?= $class['ClassID'] ?>"
                                        <?= old('ClassID', $subject['ClassID']) == $class['ClassID'] ? 'selected' : '' ?>>
                                        <?= esc($class['ClassName']) ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>

                            <div class="invalid-feedback">
                                <?= validation_show_error('ClassID') ?>
                            </div> 

                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update Subject
                        </button>

                        <a href="<?= site_url('subjects') ?>" class="btn btn-secondary">
                            Back
                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>