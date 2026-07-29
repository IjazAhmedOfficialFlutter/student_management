<?= $this->include('layouts/header') ?>

<div class="main-wrapper">

    <?= $this->include('layouts/sidebar') ?>

    <?= $this->include('layouts/navbar') ?>

    <div class="content-wrapper">
        <?= $this->renderSection('content') ?>
    </div>

</div>

<?= $this->include('layouts/footer') ?>