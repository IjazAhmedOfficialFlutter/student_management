```php
<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-2 px-md-3">

    <div class="row">
        <div class="col-12">

            <!-- Main Card -->
            <div class="card shadow-sm border-0">

                <!-- Card Header -->
                <div class="card-header bg-primary text-white py-3">

                    <div
                        class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

                        <div>
                            <h4 class="mb-1">
                                <i class="bi bi-people-fill me-1"></i>
                                Students List
                            </h4>

                            <small class="opacity-75">
                                View and manage student records.
                            </small>
                        </div>

                        <a href="<?= site_url('students/create') ?>" class="btn btn-light w-100 w-md-auto">

                            <i class="bi bi-plus-circle me-1"></i>

                            <?= lang('App.addStudent') ?>

                        </a>

                    </div>

                </div>


                <!-- Card Body -->
                <div class="card-body">

                    <!-- =========================
                         SEARCH / FILTER
                    ========================== -->

                    <form method="get" action="<?= site_url('students') ?>" class="mb-4">

                        <div class="row g-3">

                            <!-- Search -->
                            <div class="col-12 col-lg-6">

                                <label class="form-label fw-semibold">
                                    Search Students
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        <i class="bi bi-search"></i>
                                    </span>

                                    <input type="text" id="studentSearch" name="search" class="form-control"
                                        placeholder="Search by Roll No, Student Name or Father Name"
                                        value="<?= esc($search ?? '') ?>">

                                </div>

                            </div>


                            <!-- Status -->
                            <div class="col-12 col-sm-6 col-lg-2">

                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <select id="studentStatus" name="status" class="form-select">

                                    <option value="">
                                        All Status
                                    </option>

                                    <option value="Active" <?= ($status ?? '') === 'Active' ? 'selected' : '' ?>>
                                        Active
                                    </option>

                                    <option value="Inactive" <?= ($status ?? '') === 'Inactive' ? 'selected' : '' ?>>
                                        Archived
                                    </option>

                                </select>

                            </div>


                            <!-- Search -->
                            <div class="col-6 col-sm-3 col-lg-2 d-flex align-items-end">

                                <button type="submit" class="btn btn-primary w-100">

                                    <i class="bi bi-search me-1"></i>

                                    <span class="d-none d-sm-inline">
                                        Search
                                    </span>

                                </button>

                            </div>


                            <!-- Clear -->
                            <div class="col-6 col-sm-3 col-lg-2 d-flex align-items-end">

                                <a href="<?= site_url('students') ?>" class="btn btn-secondary w-100">

                                    <i class="bi bi-arrow-clockwise me-1"></i>

                                    <span class="d-none d-sm-inline">
                                        Clear
                                    </span>

                                </a>

                            </div>

                        </div>

                    </form>


                    <!-- =========================
                         SUMMARY CARDS
                    ========================== -->

                    <div class="row g-3 mb-4">

                        <!-- Total -->
                        <div class="col-12 col-sm-4">

                            <div class="card border-0 bg-light h-100">

                                <div class="card-body text-center py-3">

                                    <i class="bi bi-people-fill fs-2 text-primary"></i>

                                    <h4 class="mt-2 mb-0">
                                        <?= count($students ?? []) ?>
                                    </h4>

                                    <small class="text-muted">
                                        Total Students
                                    </small>

                                </div>

                            </div>

                        </div>


                        <!-- Active -->
                        <div class="col-12 col-sm-4">

                            <div class="card border-0 bg-light h-100">

                                <div class="card-body text-center py-3">

                                    <i class="bi bi-person-check-fill fs-2 text-success"></i>

                                    <h4 class="mt-2 mb-0">

                                        <?php

                                        $activeStudents = 0;

                                        foreach ($students ?? [] as $student) {

                                            if (($student['status'] ?? '') === 'Active') {
                                                $activeStudents++;
                                            }

                                        }

                                        echo $activeStudents;

                                        ?>

                                    </h4>

                                    <small class="text-muted">
                                        Active Students
                                    </small>

                                </div>

                            </div>

                        </div>


                        <!-- Archived -->
                        <div class="col-12 col-sm-4">

                            <div class="card border-0 bg-light h-100">

                                <div class="card-body text-center py-3">

                                    <i class="bi bi-person-x-fill fs-2 text-warning"></i>

                                    <h4 class="mt-2 mb-0">

                                        <?php

                                        $archivedStudents = 0;

                                        foreach ($students ?? [] as $student) {

                                            if (($student['status'] ?? '') === 'Inactive') {
                                                $archivedStudents++;
                                            }

                                        }

                                        echo $archivedStudents;

                                        ?>

                                    </h4>

                                    <small class="text-muted">
                                        Archived Students
                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =========================
                         STUDENT TABLE
                    ========================== -->

                    <div class="table-responsive student-table-wrapper">

                        <table class="table table-bordered table-hover align-middle mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th class="text-center" style="min-width:60px;">
                                        #
                                    </th>

                                    <th style="min-width:100px;">
                                        <?= lang('App.rollNo') ?>
                                    </th>

                                    <th style="min-width:160px;">
                                        <?= lang('App.studentName') ?>
                                    </th>

                                    <th style="min-width:160px;">
                                        <?= lang('App.fatherName') ?>
                                    </th>

                                    <th style="min-width:220px;">
                                        <?= lang('App.email') ?>
                                    </th>

                                    <th style="min-width:130px;">
                                        <?= lang('App.phone') ?>
                                    </th>

                                    <th style="min-width:150px;">
                                        <?= lang('App.cnic') ?>
                                    </th>

                                    <th class="text-center" style="min-width:110px;">
                                        <?= lang('App.gender') ?>
                                    </th>

                                    <th class="text-center" style="min-width:110px;">
                                        Status
                                    </th>

                                    <th class="text-center" style="min-width:130px;">
                                        <?= lang('App.action') ?>
                                    </th>

                                </tr>

                            </thead>


                            <tbody id="studentTableBody">

                                <?php if (!empty($students)): ?>

                                <?php $i = 1; ?>

                                <?php foreach ($students as $student): ?>

                                <?php

                                        $status = $student['status'] ?? 'Active';

                                        if ($status === 'Active') {

                                            $badge = 'success';
                                            $displayStatus = 'Active';

                                        } elseif ($status === 'Inactive') {

                                            $badge = 'warning';
                                            $displayStatus = 'Archived';

                                        } else {

                                            $badge = 'secondary';
                                            $displayStatus = $status;

                                        }

                                        ?>

                                <tr class="student-row">

                                    <td class="text-center">
                                        <?= $i++ ?>
                                    </td>


                                    <td>
                                        <strong>
                                            <?= esc($student['rollNo'] ?? '') ?>
                                        </strong>
                                    </td>


                                    <td>
                                        <?= esc($student['studentName'] ?? '') ?>
                                    </td>


                                    <td>
                                        <?= esc($student['fatherName'] ?? '') ?>
                                    </td>


                                    <td>
                                        <span class="text-break">
                                            <?= esc($student['email'] ?? '') ?>
                                        </span>
                                    </td>


                                    <td>
                                        <?= esc($student['phone'] ?? '') ?>
                                    </td>


                                    <td>
                                        <?= esc($student['cnic'] ?? '') ?>
                                    </td>


                                    <td class="text-center">

                                        <?php if (($student['gender'] ?? '') === 'Male'): ?>

                                        <span class="badge bg-primary">
                                            <i class="bi bi-gender-male"></i>
                                            Male
                                        </span>

                                        <?php elseif (($student['gender'] ?? '') === 'Female'): ?>

                                        <span class="badge bg-danger">
                                            <i class="bi bi-gender-female"></i>
                                            Female
                                        </span>

                                        <?php else: ?>

                                        <span class="badge bg-secondary">
                                            Unknown
                                        </span>

                                        <?php endif; ?>

                                    </td>


                                    <td class="text-center">

                                        <span class="badge bg-<?= esc($badge) ?>">

                                            <?= esc($displayStatus) ?>

                                        </span>

                                    </td>


                                    <td class="text-center">

                                        <div class="d-flex justify-content-center gap-1">

                                            <!-- Edit -->

                                            <a href="<?= site_url(
                                                        'students/edit/' . $student['studentID']
                                                    ) ?>" class="btn btn-sm btn-warning" title="Edit">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            <!-- Archive -->

                                            <?php if ($status === 'Active'): ?>

                                            <button type="button" class="btn btn-sm btn-danger archiveBtn"
                                                data-id="<?= esc($student['studentID']) ?>"
                                                data-name="<?= esc($student['studentName']) ?>" title="Archive">

                                                <i class="bi bi-archive"></i>

                                            </button>

                                            <?php endif; ?>

                                        </div>

                                    </td>

                                </tr>

                                <?php endforeach; ?>

                                <?php else: ?>

                                <tr>

                                    <td colspan="10" class="text-center py-5">

                                        <i class="bi bi-people fs-1 text-muted"></i>

                                        <p class="text-muted mb-0 mt-2">
                                            No students found.
                                        </p>

                                    </td>

                                </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>


                    <!-- Footer -->

                    <div
                        class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mt-3">

                        <small class="text-muted">

                            Showing

                            <strong id="visibleStudentCount">
                                <?= count($students ?? []) ?>
                            </strong>

                            students

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- =========================
     ARCHIVE MODAL
========================== -->

<div class="modal fade" id="archiveModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-sm">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <h5 class="modal-title">

                    <i class="bi bi-archive-fill me-1"></i>

                    <?= lang('App.archiveStudent') ?>

                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>

            </div>


            <div class="modal-body">

                <p>

                    <?= lang('App.archiveConfirmation') ?>

                    <strong id="archiveStudentName"></strong>?

                </p>


                <div class="alert alert-warning mb-0">

                    <i class="bi bi-exclamation-triangle-fill me-1"></i>

                    <?= lang('App.archiveWarning') ?>

                </div>

            </div>


            <div class="modal-footer d-flex">

                <button type="button" class="btn btn-secondary flex-fill" data-bs-dismiss="modal">

                    <i class="bi bi-x-circle me-1"></i>

                    <?= lang('App.cancel') ?>

                </button>


                <button type="button" id="archiveLink" class="btn btn-warning flex-fill">

                    <i class="bi bi-archive-fill me-1"></i>

                    <?= lang('App.archive') ?>

                </button>

            </div>

        </div>

    </div>

</div>


<!-- =========================
     RESPONSIVE CSS
========================== -->

<style>
/* Table horizontal scrolling on smaller screens */
.student-table-wrapper {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}


/* Keep table readable */
.student-table-wrapper table {
    min-width: 1200px;
}


/* Prevent action buttons from wrapping */
.student-table-wrapper td:last-child {
    white-space: nowrap;
}


/* Better mobile table experience */
@media (max-width: 767.98px) {

    .card-header h4 {
        font-size: 1.15rem;
    }


    .card-body {
        padding: 0.75rem;
    }


    .form-label {
        font-size: 0.875rem;
    }


    .summary-card {
        margin-bottom: 0.75rem;
    }


    .student-table-wrapper {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
    }


    .student-table-wrapper table {
        font-size: 0.875rem;
    }


    .modal-footer {
        flex-direction: column;
    }


    .modal-footer .btn {
        width: 100%;
    }

}


/* Tablet */
@media (min-width: 768px) and (max-width: 991.98px) {

    .student-table-wrapper table {
        min-width: 1100px;
    }

}


/* Desktop */
@media (min-width: 992px) {

    .student-table-wrapper {
        overflow-x: auto;
    }

}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    console.log('========== STUDENTS JS LOADED ==========');


    /*
    |--------------------------------------------------------------------------
    | SEARCH / STATUS FILTER
    |--------------------------------------------------------------------------
    */

    const searchInput =
        document.getElementById('studentSearch');

    const statusSelect =
        document.getElementById('studentStatus');


    if (searchInput && statusSelect) {

        const searchForm =
            searchInput.closest('form');

        let searchTimer;


        /*
        |--------------------------------------------------------------------------
        | Live Search
        |--------------------------------------------------------------------------
        | User types → wait 400ms → submit form
        */

        searchInput.addEventListener('input', function () {

            clearTimeout(searchTimer);

            searchTimer = setTimeout(function () {

                searchForm.submit();

            }, 400);

        });


        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        | Active / Archived / All Status
        */

        statusSelect.addEventListener('change', function () {

            searchForm.submit();

        });

    }


    /*
    |--------------------------------------------------------------------------
    | ARCHIVE BUTTONS
    |--------------------------------------------------------------------------
    | DO NOT CHANGE - WORKING FUNCTIONALITY
    |--------------------------------------------------------------------------
    */

    const archiveButtons =
        document.querySelectorAll('.archiveBtn');


    const archiveModalElement =
        document.getElementById('archiveModal');


    const archiveNameElement =
        document.getElementById('archiveStudentName');


    const archiveConfirmButton =
        document.getElementById('archiveLink');


    console.log(
        'Archive buttons found:',
        archiveButtons.length
    );


    /*
    |--------------------------------------------------------------------------
    | Check required archive elements
    |--------------------------------------------------------------------------
    */

    if (!archiveModalElement) {

        console.error(
            'Archive modal not found.'
        );

        return;
    }


    if (!archiveNameElement) {

        console.error(
            'Archive student name element not found.'
        );

        return;
    }


    if (!archiveConfirmButton) {

        console.error(
            'Archive confirmation button not found.'
        );

        return;
    }



    const archiveModal =
        bootstrap.Modal.getOrCreateInstance(
            archiveModalElement
        );



    archiveButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            console.log(
                '========== ARCHIVE BUTTON CLICKED =========='
            );

            const studentId =
                this.dataset.id;



            const studentName =
                this.dataset.name;


            console.log(
                'Student ID:',
                studentId
            );


            console.log(
                'Student Name:',
                studentName
            );



            if (!studentId) {

                console.error(
                    'Student ID is missing.'
                );

                return;
            }


            const archiveUrl =
                "<?= site_url('students/archiveStudent/') ?>" +
                studentId;


            console.log(
                'Archive URL:',
                archiveUrl
            );


            archiveNameElement.textContent =
                studentName;



            archiveConfirmButton.dataset.url =
                archiveUrl;


            archiveModal.show();

        });

    });


   

    archiveConfirmButton.addEventListener(
        'click',
        function () {

            console.log(
                '========== CONFIRM ARCHIVE =========='
            );


            /*
             * Get stored URL
             */

            const archiveUrl =
                this.dataset.url;


            console.log(
                'Archive URL:',
                archiveUrl
            );


            /*
             * Validate URL
             */

            if (!archiveUrl) {

                console.error(
                    'Archive URL is missing.'
                );

                return;
            }


            /*
             * Navigate to Controller
             */

            console.log(
                'Navigating to:',
                archiveUrl
            );


            window.location.href =
                archiveUrl;

        }
    );

});
</script>
```

<?= $this->endSection() ?>