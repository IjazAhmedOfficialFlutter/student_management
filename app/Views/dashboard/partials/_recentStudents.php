<div class="card shadow border-0 mt-4">

    <div class="card-header">

        <h5 class="mb-0">
            Recent Students
        </h5>

    </div>

    <div class="card-body">

        <table class="table table-hover">

            <thead>

            <tr>

                <th>Photo</th>
                <th>Roll No</th>
                <th>Name</th>
                <th>Class</th>
                <th>Created</th>

            </tr>

            </thead>

            <tbody>

            <?php foreach ($recentStudents as $student): ?>

                <tr>

                    <td>

                        <?php if ($student['Photo']) : ?>

                            <img
                                src="<?= base_url('uploads/students/'.$student['Photo']) ?>"
                                width="40"
                                class="rounded-circle">

                        <?php else: ?>

                            -

                        <?php endif; ?>

                    </td>

                    <td><?= esc($student['RollNo']) ?></td>

                    <td><?= esc($student['StudentName']) ?></td>

                    <td><?= esc($student['ClassName']) ?></td>

                    <td>

                        <?= date('d M Y', strtotime($student['CreatedAt'])) ?>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>