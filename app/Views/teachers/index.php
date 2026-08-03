<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold">

            <i class="bi bi-person-workspace text-primary"></i>
<?= lang('App.teachers') ?>
        </h2>

        <p class="text-muted">

          <?= lang('App.manageTeachers') ?>
        </p>

    </div>

    <a href="<?= site_url('teachers/create') ?>"
       class="btn btn-primary">

        <i class="bi bi-plus-circle"></i>

    <?= lang('App.addTeacher') ?>

    </a>

</div>

<div class="card shadow-sm border-0 rounded-4 mt-4">

    <div class="card-header bg-white">

        <div class="row">

            <div class="col-md-6">

                <h5 class="mb-0">

                    <i class="bi bi-person-lines-fill text-primary"></i>

               <?= lang('App.teacherList') ?>

                </h5>

            </div>

            <div class="col-md-3">

                <input
                    type="text"
                    id="searchTeacher"
                    class="form-control"
                    placeholder=<?= lang('App.searchTeacher') ?>>

            </div>

            <div class="col-md-3">

                <select id="statusFilter" class="form-select">

                    <option value=""><?= lang('App.allStatus') ?></option>

                    <option value="Active"><?= lang('App.active') ?> </option>

                    <option value="Archived"><?= lang('App.archived') ?></option>

                </select>

            </div>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

            <tr>

                <th>#</th>

                <th><?= lang('App.photo') ?></th>

                <th><?= lang('App.employeeNo') ?></th>

                <th><?= lang('App.teacherName') ?></th>

                <th><?= lang('App.qualification') ?></th>

                <th><?= lang('App.phone') ?></th>

                <th><?= lang('App.status') ?></th>

                <th width="180"><?= lang('App.action') ?></th>

            </tr>

            </thead>

            <tbody>

            <?php if(!empty($teachers)): ?>

            <?php $i=1; foreach($teachers as $teacher): ?>

            <tr class="teacher-row">

                <td><?= $i++ ?></td>

                <td width="70">

                    <img
                        src="<?= base_url('uploads/teachers/'.$teacher['Photo']) ?>"
                        width="45"
                        height="45"
                        class="rounded-circle border"
                        style="object-fit:cover;">

                </td>

                <td class="teacher-employee">

                    <span class="badge bg-primary">

                        <?= esc($teacher['EmployeeNo']) ?>

                    </span>

                </td>

                <td class="teacher-name">

                    <?= esc($teacher['TeacherName']) ?>

                </td>

                <td>

                    <?= esc($teacher['Qualification']) ?>

                </td>

                <td>

                    <?= esc($teacher['Phone']) ?>

                </td>

                <td class="teacher-status"
    data-status="<?= strtolower($teacher['Status']) ?>">

    <span class="badge bg-success">
        <?= lang('App.' . strtolower($teacher['Status'])) ?>
    </span>

</td>

                <td>

                   <a href="<?= site_url('teachers/view/'.$teacher['TeacherID']) ?>"
   class="btn btn-sm btn-info">

    <i class="bi bi-eye"></i>

</a>

                    <a href="<?= site_url('teachers/edit/'.$teacher['TeacherID']) ?>" class="btn btn-sm btn-warning">

                        <i class="bi bi-pencil"></i>

                    </a>

              <a href="<?= site_url('teachers/archive/'.$teacher['TeacherID']) ?>"
   class="btn btn-sm btn-danger"
   onclick="return confirm('<?= lang('App.confirmArchive') ?>');">

    <i class="bi bi-archive"></i>

</a>

                </td>

            </tr>

            <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<script>

const search = document.getElementById('searchTeacher');

search.addEventListener('keyup', function(){

    let value = this.value.toLowerCase();

    document.querySelectorAll('.teacher-row').forEach(function(row){

        let employee = row.querySelector('.teacher-employee').innerText.toLowerCase();

        let name = row.querySelector('.teacher-name').innerText.toLowerCase();

        if(employee.includes(value) || name.includes(value))
        {
            row.style.display = '';
        }
        else
        {
            row.style.display = 'none';
        }

    });

});

document.getElementById('statusFilter').addEventListener('change', function () {

    let status = this.value.toLowerCase();

    document.querySelectorAll('.teacher-row').forEach(function (row) {

        let rowStatus = row.querySelector('.teacher-status').dataset.status;

        if (status === '' || rowStatus === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }

    });

});

</script>



<?= $this->endSection() ?>