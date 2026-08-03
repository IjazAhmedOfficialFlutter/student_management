<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">
                <i class="bi bi-calendar-check text-primary"></i>
                <?= esc($class['ClassName']) ?>
            </h2>
            <p class="text-muted mb-0">
                Marking attendance for <?= esc($date) ?>
            </p>
        </div>

        <a href="<?= site_url('attendance') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Back
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow rounded-4">

        <div class="card-body">
            <div class="row mb-4">

    <div class="col-md-3">

        <div class="card border-0 shadow-sm text-center">

            <div class="card-body">

                <i class="bi bi-people-fill fs-2 text-primary"></i>

                <h3 class="mt-2 mb-0">
                    <?= count($students) ?>
                </h3>

                <small class="text-muted">
                    Total Students
                </small>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-sm text-center">

            <div class="card-body">

                <i class="bi bi-check-circle-fill fs-2 text-success"></i>

  <h3 id="presentCount" class="mt-2 mb-0">
    <?= $presentCount ?>
</h3>

                <small class="text-muted">
                    Present
                </small>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-sm text-center">

            <div class="card-body">

                <i class="bi bi-x-circle-fill fs-2 text-danger"></i>

              <h3 id="absentCount" class="mt-2 mb-0">
    <?= $absentCount ?>
</h3>

                <small class="text-muted">
                    Absent
                </small>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-sm text-center">

            <div class="card-body">

                <i class="bi bi-clock-fill fs-2 text-warning"></i>

              <h3 id="lateCount" class="mt-2 mb-0">
    <?= $lateCount ?>
</h3>

                <small class="text-muted">
                    Late
                </small>

            </div>

        </div>

    </div>

</div>


        <div class="mt-3">

            <small class="text-muted">

                <span id="markedStudents">0</span>
                of
                <strong><?= count($students) ?></strong>
                students marked.

            </small>

        </div>

    </div>


            <form action="<?= site_url('attendance/store') ?>" method="post">

                <?= csrf_field() ?>

                <input type="hidden" name="ClassID" value="<?= $class['ClassID'] ?>">
                <input type="hidden" name="AttendanceDate" value="<?= esc($date) ?>">
                <div class="d-flex justify-content-between align-items-center mb-3">

 <div class="btn-group">

    <button type="button"
            class="btn btn-success"
            id="presentAll">

        <i class="bi bi-check-all"></i>
        Present All

    </button>

    <button type="button"
            class="btn btn-danger"
            id="absentAll">

        <i class="bi bi-x-circle"></i>
        Absent All

    </button>

    <button type="button"
            class="btn btn-warning"
            id="lateAll">

        <i class="bi bi-clock"></i>
        Late All

    </button>

</div>

    <div>

        <input type="text"
               id="searchStudent"
               class="form-control"
               placeholder="Search Student">

    </div>

</div>

                <div class="table-responsive">

                    <table class="table align-middle">

                     <thead class="table-light">

<tr>

    <th width="70">Photo</th>

    <th>Roll No</th>

    <th>Student Name</th>

    <th width="300">Attendance</th>

</tr>

</thead>

                        <tbody>

                            <?php if (!empty($students)): ?>

                                <?php foreach ($students as $student): ?>

                                    <?php $current = $existingMap[$student['StudentID']] ?? 'Present'; ?>

                                 <tr class="student-row">
                                       <td>

<?php if(!empty($student['Photo'])): ?>

<img src="<?= base_url('uploads/students/'.$student['Photo']) ?>"
     width="45"
     height="45"
     class="rounded-circle"
     style="object-fit:cover;">

<?php else: ?>

<img src="<?= base_url('assets/images/no-image.png') ?>"
     width="45"
     height="45"
     class="rounded-circle">

<?php endif; ?>

</td>

<td class="student-roll">

<span class="badge bg-primary">
    <?= esc($student['RollNo']) ?>
</span>

</td>

<td class="student-name">

<?= esc($student['StudentName']) ?>

</td>

<td>

                                          <div class="btn-group">

    <input
        type="radio"
        class="btn-check attendance-radio"
        name="Status[<?= $student['StudentID'] ?>]"
        id="present<?= $student['StudentID'] ?>"
        value="Present"
        <?= $current=='Present'?'checked':'' ?>>

    <label class="btn btn-outline-success"
           for="present<?= $student['StudentID'] ?>">

        Present

    </label>


    <input
        type="radio"
        class="btn-check attendance-radio"
        name="Status[<?= $student['StudentID'] ?>]"
        id="absent<?= $student['StudentID'] ?>"
        value="Absent"
        <?= $current=='Absent'?'checked':'' ?>>

    <label class="btn btn-outline-danger"
           for="absent<?= $student['StudentID'] ?>">

        Absent

    </label>


    <input
        type="radio"
        class="btn-check attendance-radio"
        name="Status[<?= $student['StudentID'] ?>]"
        id="late<?= $student['StudentID'] ?>"
        value="Late"
        <?= $current=='Late'?'checked':'' ?>>

    <label class="btn btn-outline-warning"
           for="late<?= $student['StudentID'] ?>">

        Late

    </label>

</div>

                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        No students found in this class.
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

                <?php if (!empty($students)): ?>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i>
                        Save Attendance
                    </button>
                <?php endif; ?>

            </form>

        </div>

    </div>

</div>


<script>

const searchBox = document.getElementById('searchStudent');

searchBox.addEventListener('keydown', function(e){

    if(e.key === 'Enter'){
        e.preventDefault();
    }

});

searchBox.addEventListener('keyup', function(){

    let value = this.value.toLowerCase().trim();

    document.querySelectorAll('.student-row').forEach(function(row){

        let name = row.querySelector('.student-name').innerText.toLowerCase();

        let roll = row.querySelector('.student-roll').innerText.toLowerCase();

        if(name.includes(value) || roll.includes(value))
        {
            row.style.display = '';
        }
        else
        {
            row.style.display = 'none';
        }

    });

});

</script>
<script>

function updateAttendanceCount()
{
    let totalStudents = <?= count($students) ?>;

    let present = document.querySelectorAll('input[value="Present"]:checked').length;
    let absent  = document.querySelectorAll('input[value="Absent"]:checked').length;
    let late    = document.querySelectorAll('input[value="Late"]:checked').length;

    let marked = present + absent + late;


    // Cards
    document.getElementById('presentCount').textContent = present;
    document.getElementById('absentCount').textContent  = absent;
    document.getElementById('lateCount').textContent    = late;

    // Progress info
    document.getElementById('markedStudents').textContent = marked;

    
}

// Individual change
document.querySelectorAll('.attendance-radio').forEach(radio => {
    radio.addEventListener('change', updateAttendanceCount);
});

// Present All
document.getElementById('presentAll').addEventListener('click', function () {

    document.querySelectorAll('input[value="Present"]').forEach(radio => {
        radio.checked = true;
    });

    updateAttendanceCount();
});

// Absent All
document.getElementById('absentAll').addEventListener('click', function () {

    document.querySelectorAll('input[value="Absent"]').forEach(radio => {
        radio.checked = true;
    });

    updateAttendanceCount();
});

// Late All
document.getElementById('lateAll').addEventListener('click', function () {

    document.querySelectorAll('input[value="Late"]').forEach(radio => {
        radio.checked = true;
    });

    updateAttendanceCount();
});

// Initial page load
window.addEventListener('load', updateAttendanceCount);

// Initial load
updateAttendanceCount();


</script>
<?= $this->endSection() ?>