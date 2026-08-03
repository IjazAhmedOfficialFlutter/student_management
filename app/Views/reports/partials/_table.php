<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-dark">

                <tr>

                    <th>#</th>

                    <th>Photo</th>

                    <th>Roll No</th>

                    <th>Student Name</th>

                    <th>Father Name</th>

                    <th>Gender</th>

                    <th>Status</th>

                    <th>Action</th>

                </tr>

                </thead>

                <tbody>

                <?php if (! empty($students)): ?>

                    <?php foreach ($students as $index => $student): ?>

                        <tr>

                            <td><?= $index + 1 ?></td>

                            <td>

                                <a href="<?= site_url('reports/students/' . $student['StudentID']) ?>">

                                    <?php if (! empty($student['Photo'])): ?>

                                        <img src="<?= base_url('uploads/students/' . $student['Photo']) ?>"
                                             width="45"
                                             height="45"
                                             class="rounded-circle">

                                    <?php else: ?>

                                        <img src="<?= base_url('assets/images/default-user.png') ?>"
                                             width="45"
                                             class="rounded-circle">

                                    <?php endif; ?>

                                </a>

                            </td>

                            <td><?= esc($student['RollNo']) ?></td>

                            <td>

                                <a href="<?= site_url('reports/students/' . $student['StudentID']) ?>">

                                    <?= esc($student['StudentName']) ?>

                                </a>

                            </td>

                            <td><?= esc($student['FatherName']) ?></td>

                            <td><?= esc($student['Gender']) ?></td>

                            <td>

                                <?php if ($student['Status'] == 'Active'): ?>

                                    <span class="badge bg-success">

                                        Active

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-danger">

                                        Archived

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <a href="<?= site_url('reports/students/' . $student['StudentID']) ?>"
                                   class="btn btn-primary btn-sm">

                                    <i class="bi bi-eye"></i>

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            <?= $pager->links('students', 'bootstrap') ?>

        </div>

    </div>

</div>