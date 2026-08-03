<nav class="topbar">

<div class="dropdown me-3">

    <button class="btn btn-outline-primary dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown">

        🌐 <?= strtoupper(service('request')->getLocale()) ?>

    </button>

    <ul class="dropdown-menu">

        <?php foreach (config('App')->supportedLocales as $locale): ?>

            <li>
                <a class="dropdown-item"
                   href="<?= site_url('language/' . $locale) ?>">
                    <?= strtoupper($locale) ?>
                </a>
            </li>

        <?php endforeach; ?>

    </ul>

</div>
    <div class="d-flex align-items-center">

        <h4 class="mb-0 fw-bold text-dark">
            <?= esc($title ?? 'Dashboard') ?>
        </h4>

    </div>

    <!-- <div class="search-box">

        <i class="bi bi-search"></i>

        <input type="text"
               placeholder=<?= lang('App.searchHere') ?>>

    </div> -->

    <div class="top-right">

        <button class="icon-btn">

            <i class="bi bi-bell"></i>

            <span class="notify-dot"></span>

        </button>

        <button class="icon-btn">

            <i class="bi bi-envelope"></i>

            <span class="notify-dot"></span>

        </button>

        <div class="profile">

            <img src="https://ui-avatars.com/api/?name=Admin&background=2563eb&color=fff"
                 alt="Admin">

            <div>

                <h6 class="mb-0"><?= lang('App.administrator') ?></h6>

                <small class="text-muted"><?= lang('App.systemAdmin') ?></small>

            </div>

        </div>

    </div>

</nav>