<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Student Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        body{

            background:#f4f6f9;

            height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;

        }

        .login-card{

            width:420px;

            border:none;

            border-radius:15px;

            box-shadow:0 10px 25px rgba(0,0,0,.1);

        }

        .card-header{

            background:#0d6efd;

            color:white;

            text-align:center;

            font-size:24px;

            font-weight:bold;

            padding:20px;

        }

        .form-control{

            border-radius:10px;

        }

        .btn{

            border-radius:10px;

        }

    </style>

</head>

<body>

<div class="card login-card">

    <div class="card-header">

        <i class="bi bi-mortarboard-fill"></i>

        Student Management System

    </div>

    <div class="card-body p-4">

        <h4 class="text-center mb-4">

            Login

        </h4>
        <?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
        <?php if(session()->getFlashdata('error')) : ?>

<div class="alert alert-danger">

    <?= session()->getFlashdata('error') ?>

</div>

<?php endif; ?>

        <form action="<?= site_url('login/authenticate') ?>" method="post">

            <?= csrf_field() ?>

            <div class="mb-3">

                <label>Email</label>

                <input
                    type="email"
                    name="Email"
                    class="form-control"
                    placeholder="Enter Email"
                >

            </div>

            <div class="mb-4">

                <label>Password</label>

                <input
                    type="password"
                    name="Password"
                    class="form-control"
                    placeholder="Enter Password"
                >

            </div>

            <button class="btn btn-primary w-100">

                <i class="bi bi-box-arrow-in-right"></i>

                Login

            </button>

        </form>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>