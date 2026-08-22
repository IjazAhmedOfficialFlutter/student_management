<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Forgot Password | Student Management System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>

        body {

            background: #f4f6f9;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

        }

        .forgot-card {

            width: 420px;

            border: none;

            border-radius: 15px;

            box-shadow: 0 10px 25px rgba(0,0,0,.1);

            overflow: hidden;

        }

        .card-header {

            background: #0d6efd;

            color: white;

            text-align: center;

            font-size: 24px;

            font-weight: bold;

            padding: 20px;

        }

        .card-header i {

            display: block;

            font-size: 32px;

            margin-bottom: 5px;

        }

        .form-control {

            border-radius: 10px;

            padding: 11px;

        }

        .btn {

            border-radius: 10px;

            padding: 11px;

        }

    </style>

</head>

<body>


<div class="card forgot-card">

    <div class="card-header">

        <i class="bi bi-envelope-lock-fill"></i>

        Student Management System

    </div>


    <div class="card-body p-4">

        <h4 class="text-center mb-2">

            Forgot Password

        </h4>


        <p class="text-center text-muted mb-4">

            Enter your registered email address.
            We will send you a password reset link.

        </p>


        <?php if (session()->getFlashdata('error')) : ?>

            <div class="alert alert-danger d-flex align-items-center">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                <div>

                    <?= esc(session()->getFlashdata('error')) ?>

                </div>

            </div>

        <?php endif; ?>


        <?php if (session()->getFlashdata('success')) : ?>

            <div class="alert alert-success d-flex align-items-center">

                <i class="bi bi-check-circle-fill me-2"></i>

                <div>

                    <?= esc(session()->getFlashdata('success')) ?>

                </div>

            </div>

        <?php endif; ?>


        <form
            action="<?= site_url('forgot-password') ?>"
            method="post"
        >

            <?= csrf_field() ?>


            <div class="mb-4">

                <label class="form-label">

                    Email Address

                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter your registered email"
                    required
                >

            </div>


            <button
                type="submit"
                class="btn btn-primary w-100"
            >

                <i class="bi bi-send-fill me-1"></i>

                Send Reset Link

            </button>


        </form>


        <div class="text-center mt-4">

            <a
                href="<?= site_url('login') ?>"
                class="text-decoration-none"
            >

                <i class="bi bi-arrow-left"></i>

                Back to Login

            </a>

        </div>

    </div>

</div>


</body>

</html>