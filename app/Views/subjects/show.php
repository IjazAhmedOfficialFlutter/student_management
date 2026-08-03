<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-book-fill text-primary"></i>
                Subject Details
            </h2>

            <p class="text-muted mb-0">
                View complete information about this subject.
            </p>
        </div>

        <a href="<?= site_url('subjects') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Back to Subjects
        </a>

    </div>

    <div class="row">

        <!-- Subject Information -->
        <div class="col-lg-6 mb-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-header bg-primary text-white">

                    <h5 class="mb-0">
                        <i class="bi bi-journal-bookmark-fill"></i>
                        Subject Information
                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless align-middle mb-0">

                        <tr>
                            <th width="40%">Subject Name</th>
                            <td><?= esc($subject['SubjectName']) ?></td>
                        </tr>

                        <tr>
                            <th>Class</th>
                            <td>
                                <span class="badge bg-info">
                                    <?= esc($subject['ClassName']) ?>
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Created Date</th>
                            <td>
                                <?= !empty($subject['CreatedAt'])
                                    ? date('d M Y', strtotime($subject['CreatedAt']))
                                    : '-' ?>
                            </td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

        <!-- Assignment Information -->
        <div class="col-lg-6 mb-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">
                        <i class="bi bi-person-workspace"></i>
                        Assignment Information
                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless align-middle mb-0">

                        <tr>
                            <th width="40%">Assigned Teacher</th>
                            <td>

                                <?php if(!empty($subject['TeacherName'])): ?>

                                    <?= esc($subject['TeacherName']) ?>

                                <?php else: ?>

                                    <span class="text-muted">Not Assigned</span>

                                <?php endif; ?>

                            </td>
                        </tr>

                        <tr>
                            <th>Employee No</th>
                            <td>

                                <?= esc($subject['EmployeeNo'] ?? '-') ?>

                            </td>
                        </tr>

                        <tr>
                            <th>Teacher Status</th>
                            <td>

                                <?php
                                $teacherStatus = $subject['TeacherStatus'] ?? '';

                                $teacherBadge = match($teacherStatus){

                                    'Active'   => 'success',
                                    'Archived' => 'danger',
                                    default    => 'secondary'

                                };
                                ?>

                                <span class="badge bg-<?= $teacherBadge ?>">
                                    <?= $teacherStatus ?: 'Not Assigned' ?>
                                </span>

                            </td>
                        </tr>

                        <tr>
                            <th>Assignment Status</th>
                            <td>

                                <?php
                                $assignmentStatus = $subject['AssignmentStatus'] ?? '';

                                $assignmentBadge = match($assignmentStatus){

                                    'Active'   => 'primary',
                                    'Archived' => 'danger',
                                    default    => 'secondary'

                                };
                                ?>

                                <span class="badge bg-<?= $assignmentBadge ?>">
                                    <?= $assignmentStatus ?: 'Not Assigned' ?>
                                </span>

                            </td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <!-- Notes -->

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-light">

            <h5 class="mb-0">

                <i class="bi bi-card-text"></i>

                Description / Notes

            </h5>

        </div>

        <div class="card-body">

            <?= !empty($subject['Description'])
                ? nl2br(esc($subject['Description']))
                : '<span class="text-muted">No description available.</span>' ?>

        </div>

    </div>

    <!-- Quick Actions -->

    <div class="card shadow-sm border-0">

        <div class="card-header bg-light">

            <h5 class="mb-0">

                <i class="bi bi-lightning-charge"></i>

                Quick Actions

            </h5>

        </div>

        <div class="card-body text-center">

            <a href="<?= site_url('subjects/edit/'.$subject['SubjectID']) ?>"
               class="btn btn-warning me-2">

                <i class="bi bi-pencil-square"></i>

                Edit Subject

            </a>

            <a href="<?= site_url('teacher-assignments/create') ?>"
               class="btn btn-success me-2">

                <i class="bi bi-person-plus-fill"></i>

                Assign Teacher

            </a>

        </div>

    </div>

</div>

<?= $this->endSection() ?>