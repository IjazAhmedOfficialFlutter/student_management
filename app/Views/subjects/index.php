<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">
                <i class="bi bi-book-fill text-primary"></i>
                Subject List
            </h2>

            <p class="text-muted mb-0">
                View and manage all academic subjects.
            </p>

        </div>

        <a href="<?= site_url('subjects/create') ?>" class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>
            Add Subject

        </a>

    </div>
<div class="row mb-4">

    <div class="col-md-4">

        <div class="card shadow-sm border-0">

            <div class="card-body text-center">

                <i class="bi bi-journal-bookmark-fill fs-1 text-primary"></i>

                <h3><?= count($subjects) ?></h3>

                <small>Total Subjects</small>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow-sm border-0">

            <div class="card-body text-center">

                <i class="bi bi-building fs-1 text-success"></i>

                <h3><?= count($classes) ?></h3>

                <small>Total Classes</small>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card shadow-sm border-0">

            <div class="card-body text-center">

                <i class="bi bi-link-45deg fs-1 text-warning"></i>

                <h3><?= count($subjects) ?></h3>

                <small>Class Assignments</small>

            </div>

        </div>

    </div>

</div>

    <div class="card shadow border-0 rounded-4">

        <div class="card-header bg-white">

            <div class="row">

                <div class="col-md-4">

                    <input type="text"
                           id="searchSubject"
                           class="form-control"
                           placeholder="Search Subject">

                </div>

                <div class="col-md-3">
<!--  -->
<select id="classFilter" class="form-select">

    <option value="">All Classes</option>

    <?php foreach($classes as $class): ?>

        <option value="<?= esc($class['ClassName']) ?>">

            <?= esc($class['ClassName']) ?>

        </option>

    <?php endforeach; ?>

</select>
                </div>

                <div class="col-md-3">

                    <select class="form-select">

                        <option>All Status</option>
                        <option>Active</option>
                        <option>Inactive</option>

                    </select>

                </div>

            </div>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="70">#</th>
<th>Subject Name</th>
<th>Class</th>
<th>Teacher</th>
<th>Status</th>
<th class="text-center">Action</th>
                        </tr>

                    </thead>
                    <tbody>

<?php if (!empty($subjects)): ?>

    <?php $i = 1; ?>

    <?php foreach ($subjects as $subject): ?>

        <tr class="subject-row">
            <td><?= $i++ ?></td>

<td>
    <?= esc($subject['SubjectName']) ?>
</td>

<td>
    <span class="badge bg-info">
        <?= esc($subject['ClassName']) ?>
    </span>
</td>

<td>
<?= !empty($subject['TeacherName'])
        ? esc($subject['TeacherName'])
        : 'Not Assigned'; ?>
</td>

<td>
<?php
$status = $subject['TeacherStatus'];

$badge = match ($status) {
    'Active'   => 'success',
    'Archived' => 'danger',
    default    => 'secondary',
};
?>

<span class="badge bg-<?= $badge ?>">
    <?= esc($status) ?>
</span>
            <td class="text-center">
<a href="<?= site_url('subjects/show/'.$subject['SubjectID']) ?>"
   class="btn btn-sm btn-primary">
    <i class="bi bi-eye"></i>
</a>

                <a href="<?= site_url('subjects/edit/'.$subject['SubjectID']) ?>"
                   class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i>
                </a>

            </td>

        </tr>

    <?php endforeach; ?>

<?php else: ?>

<tr>

    <td colspan="7" class="text-center">
        No subjects found.
    </td>

</tr>

<?php endif; ?>

</tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script>

const rows = document.querySelectorAll('.subject-row');

document.getElementById('classFilter').addEventListener('change', function () {

    const selected = this.value.toLowerCase();

    rows.forEach(row => {

        const cls = row.querySelector('.subject-class')
                       .innerText
                       .toLowerCase();

        row.style.display =
            selected === '' || cls === selected
                ? ''
                : 'none';

    });

});


document.getElementById('classFilter').addEventListener('change', function(){

    let value = this.value.toLowerCase();

    document.querySelectorAll('.subject-row').forEach(function(row){

        let cls = row.children[2].innerText.toLowerCase();

        if(value=='' || cls.includes(value))
        {
            row.style.display='';
        }
        else
        {
            row.style.display='none';
        }

    });

});


</script>

<?= $this->endSection() ?>