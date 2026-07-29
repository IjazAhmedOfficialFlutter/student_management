<div class="sidebar">

    <?php $request = service('request'); ?>

    <!-- Brand -->
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="bi bi-mortarboard-fill"></i>
        </div>
        <div class="brand-text">
            <h5>StudentMS</h5>
            <small> <?= lang('App.studentManagementSystem') ?></small>
        </div>
    </div>

    <!-- Navigation -->
    <div class="sidebar-nav">

        <p class="nav-label"><?= lang('App.main') ?></p>

        <ul>
            <li>
                <a href="<?= site_url('dashboard') ?>"
                   class="<?= $request->getUri()->getSegment(1) == 'dashboard' ? 'active' : '' ?>">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span><?= lang('App.dashboard') ?></span>
                </a>
            </li>
        </ul>

        <p class="nav-label"><?= lang('App.academics') ?></p>

        <ul>
            <li>
                <a href="<?= site_url('students') ?>"
                   class="<?= $request->getUri()->getSegment(1) == 'students' ? 'active' : '' ?>">
                    <i class="bi bi-people-fill"></i>
                    <span><?= lang('App.students') ?></span>
                </a>
            </li>

            <li>
                <a href="<?= site_url('classes') ?>"
                   class="<?= $request->getUri()->getSegment(1) == 'classes' ? 'active' : '' ?>">
                    <i class="bi bi-building"></i>
                    <span><?= lang('App.classes') ?></span>
                </a>
            </li>

            <li>
                <a href="<?= site_url('subjects') ?>"
                   class="<?= $request->getUri()->getSegment(1) == 'subjects' ? 'active' : '' ?>">
                    <i class="bi bi-book-half"></i>
                    <span><?= lang('App.subjects') ?></span>
                </a>
            </li>

            <li class="nav-item">
    <a href="<?= site_url('students/archive') ?>" class="nav-link">
        <i class="bi bi-archive"></i>
        Archived Students
    </a>
</li>
        </ul>

        <p class="nav-label"><?= lang('App.insights') ?></p>

        <ul>
            <li>
    <a href="<?= site_url('attendance') ?>"
       class="<?= $request->getUri()->getSegment(1) == 'attendance' ? 'active' : '' ?>">
        <i class="bi bi-calendar-check"></i>
        <span><?= lang('App.attendance') ?></span>
    </a>
</li>

<li>
    <a href="<?= site_url('reports') ?>"
       class="<?= $request->getUri()->getSegment(1) == 'reports' ? 'active' : '' ?>">
        <i class="bi bi-bar-chart-fill"></i>
        <span><?= lang('App.reports') ?></span>
    </a>
</li>

            <li>
                <a href="#">
                    <i class="bi bi-gear-fill"></i>
                    <span><?= lang('App.settings') ?></span>
                </a>
            </li>
        </ul>

    </div>

    <!-- Bottom -->
    <div class="sidebar-footer">
        <a href="<?= site_url('logout') ?>" class="logout-link">
            <i class="bi bi-box-arrow-right"></i>
            <span><?= lang('App.logout') ?></span>
        </a>
    </div>

</div>