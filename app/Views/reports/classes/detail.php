<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

<div class="row mb-4 align-items-center">

    <div class="col-md-6">

        <h2 class="fw-bold">

            <i class="bi bi-building text-success"></i>

            <?= esc($class['ClassName']) ?>

        </h2>

        <p class="text-muted">

            Students enrolled in this class

        </p>

    </div>

    <div class="col-md-6 text-md-end">

        <a href="<?= site_url('reports/class-wise') ?>"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left"></i>

            Back to Classes

        </a>

    </div>

</div>

<div class="row mb-4">

    <div class="col-md-4">

        <div class="card shadow border-0">

            <div class="card-body text-center">

                <i class="bi bi-people-fill fs-1 text-primary"></i>

                <h3 class="fw-bold mt-3">

                    <?= count($students) ?>

                </h3>

                <p class="text-muted mb-0">

                    Total Students

                </p>

            </div>

        </div>

    </div>

</div>

<div class="card shadow border-0">

<div class="card-header bg-success text-white">

<h5 class="mb-0">

Students List

</h5>

</div>

<div class="table-responsive">

<table class="table table-hover align-middle mb-0">

<thead class="table-light">

<tr>

<th>Photo</th>
<th>Roll No</th>
<th>Name</th>
<th>Gender</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php if(!empty($students)): ?>

<?php foreach($students as $student): ?>

<tr>

<td>

<?php if(!empty($student['Photo'])): ?>

<img
src="<?= base_url('uploads/students/'.$student['Photo']) ?>"
width="50"
height="50"
class="rounded-circle"
style="object-fit:cover;">

<?php else: ?>

<img
src="<?= base_url('assets/images/no-image.png') ?>"
width="50"
height="50"
class="rounded-circle">

<?php endif; ?>

</td>

<td><?= esc($student['RollNo']) ?></td>

<td><?= esc($student['StudentName']) ?></td>

<td><?= esc($student['Gender']) ?></td>

<td>

<?php if($student['Status']=='Active'): ?>

<span class="badge bg-success">

Active

</span>

<?php else: ?>

<span class="badge bg-warning">

Archived

</span>

<?php endif; ?>

</td>

<td>

<a href="<?= site_url('reports/students/detail/'.$student['StudentID'].'?return='.urlencode(current_url())) ?>"
class="btn btn-primary btn-sm">

<i class="bi bi-eye"></i>

View

</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="6" class="text-center py-5">

No students found.

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

<?= $this->endSection() ?>