<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('error')): ?>
<div class="alert alert-danger">
    <?= session()->getFlashdata('error') ?>
</div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>
<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2><?= lang('App.students') ?></h2>

        <a href="<?= site_url('students/create') ?>" class="btn btn-primary">
           <?= lang('App.addStudent') ?>
        </a>
    </div>

    <?php if(session()->getFlashdata('success')): ?>

<div class="alert alert-success">

    <?= session()->getFlashdata('success') ?>

</div>

<?php endif; ?>


<div class="card shadow-sm mb-3">

    <div class="card-body">

        <form method="get" action="<?= site_url('students') ?>">

            <div class="row g-2 align-items-center">

                <div class="col-md-8">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by Roll No, Student Name or Father Name"
                        value="<?= esc($search ?? '') ?>">

                </div>

                <div class="col-md-2">

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i>
                        Search
                    </button>

                </div>

                <div class="col-md-2">

                    <a href="<?= site_url('students') ?>"
                       class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-clockwise"></i>
                        Clear
                    </a>

                </div>

            </div>

        </form>

    </div>

</div>
    <table class="table table-bordered table-striped">

        <thead class="table-dark">

        <tr>
            <th><?= 'Sr.' ?></th>
            
            <th><?= lang('App.rollNo') ?></th>
            <th><?= lang('App.studentName') ?></th>
            <th><?= lang('App.fatherName') ?></th> 
            <th><?= lang('App.email') ?></th>
            <th><?= lang('App.phone') ?></th>
             <th><?= lang('App.cnic') ?></th>

            <th><?= lang('App.gender') ?></th>
            <th><?= lang('App.action') ?></th>
        </tr>

        </thead>

        <tbody>

        <?php if(!empty($students)): ?>

            <?php foreach ($students as $index => $student): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                    <td><?= esc($student['RollNo']) ?></td>

                    <td><?= esc($student['StudentName']) ?></td>

                    <td><?= esc($student['FatherName']) ?></td>

                    <td><?= esc($student['Email']) ?></td>

                    <td><?= esc($student['Phone']) ?></td>
                      <td><?= esc($student['CNIC']) ?></td>

                    <td><?= esc($student['Gender']) ?></td>

                    <td>

        
          <a href="<?= site_url('students/edit/'.$student['StudentID']) ?>"
               class="btn btn-primary btn-sm"
                   title="Edit">
                <i class="bi bi-pencil-square"></i>
                  </a>

                  <button class="btn btn-warning btn-sm archiveBtn"
                        title="Archive">
                            <i class="bi bi-archive-fill"></i>
                      </button>  
                    </td>
                    

                </tr>

                

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td colspan="8" class="text-center">
                    No Students Found
                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>
<div class="d-flex justify-content-between align-items-center mt-3">

    <div>
        Showing <?= count($students) ?> records
    </div>

    <div>


<?= $pager->links('students', 'bootstrap') ?>
    </div>

</div>
<script>

document.querySelectorAll('.statusBtn').forEach(function(button){

    button.addEventListener('click', function(){

        let id = this.dataset.id;
        let name = this.dataset.name;
        let status = this.dataset.status;

        if(confirm("Do you want to change " + name + " to " + status + "?")){

            window.location.href =
            "<?= site_url('students/changeStatus/') ?>" +
            id + "/" + status;

        }

    });

});
document.querySelectorAll('.archiveBtn').forEach(function(btn){

    btn.addEventListener('click', function(){

        let id = this.dataset.id;
        let name = this.dataset.name;

        document.getElementById('archiveStudentName').innerText = name;

        document.getElementById('archiveLink').href =
            "<?= site_url('students/archiveStudent/') ?>" + id;

        let modal = new bootstrap.Modal(
            document.getElementById('archiveModal')
        );

        modal.show();

    });

});

</script>

<div class="modal fade" id="archiveModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <h5 class="modal-title">
                    <?= lang('App.archiveStudent') ?>
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <p>
                    <?= lang('App.archiveConfirmation') ?>
                    <strong id="archiveStudentName"></strong>?
                </p>

                <div class="alert alert-warning mb-0">
                    <?= lang('App.archiveWarning') ?>
                </div>

            </div>

            <div class="modal-footer">

                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    <?= lang('App.cancel') ?>
                </button>

                <a href=""
                   id="archiveLink"
                   class="btn btn-warning">
                    <i class="bi bi-archive-fill"></i>
                    <?= lang('App.archive') ?>
                </a>

            </div>

        </div>

    </div>

</div>
<?= $this->endSection() ?>

