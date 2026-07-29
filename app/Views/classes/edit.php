<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>


<div class="container-fluid">

    <div class="row">
        <div class="col-lg-10 mx-auto">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><?= lang('App.editClass') ?> </h4>
                </div>

                <div class="card-body">

                    <form action="<?= site_url('classes/update/'.$class['ClassID']) ?>" method="post">

                        <?= csrf_field() ?>

                        <div class="mb-3">

                            <label class="form-label"><?= lang('App.className') ?></label>

                            <input
                                type="text"
                                name="ClassName"
                                value="<?= old('ClassName', $class['ClassName']) ?>"
                                class="form-control <?= validation_show_error('ClassName') ? 'is-invalid' : '' ?>">

                            <div class="invalid-feedback">
                                <?= validation_show_error('ClassName') ?>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">
                          <?= lang('App.updateClass') ?>
                        </button>

                        <a href="<?= site_url('classes') ?>" class="btn btn-secondary">
                          <?= lang('App.back') ?>
                        </a>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>