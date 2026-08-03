<?php

/** @var CodeIgniter\Pager\PagerRenderer $pager */

$pager->setSurroundCount(2);
?>

<nav>
    <ul class="pagination justify-content-end">

        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst() ?>">First</a>
            </li>

            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPrevious() ?>">Previous</a>
            </li>
        <?php endif; ?>

        <?php foreach ($pager->links() as $link) : ?>

            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>

        <?php endforeach; ?>

        <?php if ($pager->hasNext()) : ?>

            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNext() ?>">Next</a>
            </li>

            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() ?>">Last</a>
            </li>

        <?php endif; ?>

    </ul>
</nav>