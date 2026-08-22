<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password | Student Management System</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
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

        .reset-card {

            width: 420px;

            border: none;

            border-radius: 15px;

            box-shadow: 0 10px 25px rgba(0, 0, 0, .1);

            overflow: hidden;
        }

        .card-header {

            background: #0d6efd;

            color: white;

            text-align: center;

            font-size: 23px;

            font-weight: bold;

            padding: 20px;
        }

        .card-header i {

            font-size: 30px;

            display: block;

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

        .alert {

            border-radius: 10px;
        }

        .password-info {

            font-size: 13px;

            color: #6c757d;
        }

    </style>

</head>

<body>


<div class="card reset-card">


    <!-- Header -->

    <div class="card-header">

        <i class="bi bi-shield-lock-fill"></i>

        Reset Password

    </div>


    <div class="card-body p-4">


        <h4 class="text-center mb-2">

            Create New Password

        </h4>


        <p class="text-center text-muted mb-4">

            Enter your new password below.

        </p>


        <!-- Error -->

        <?php if (session()->getFlashdata('error')) : ?>

            <div class="alert alert-danger d-flex align-items-center">

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                <div>

                    <?= esc(session()->getFlashdata('error')) ?>

                </div>

            </div>

        <?php endif; ?>


        <!-- Success -->

        <?php if (session()->getFlashdata('success')) : ?>

            <div class="alert alert-success d-flex align-items-center">

                <i class="bi bi-check-circle-fill me-2"></i>

                <div>

                    <?= esc(session()->getFlashdata('success')) ?>

                </div>

            </div>

        <?php endif; ?>


        <form
            method="post"
            action="<?= site_url('reset-password') ?>"
        >

            <?= csrf_field() ?>


            <!-- Token -->

            <input
                type="hidden"
                name="token"
                value="<?= esc($token) ?>"
            >


            <!-- New Password -->

            <div class="mb-3">

                <label class="form-label">

                    New Password

                </label>

                <div class="input-group">

                    <input
                        type="password"
                        name="newPassword"
                        id="newPassword"
                        class="form-control"
                        placeholder="Enter new password"
                        required
                    >

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        onclick="togglePassword('newPassword', this)"
                    >

                        <i class="bi bi-eye"></i>

                    </button>

                </div>

            </div>


            <!-- Confirm Password -->

            <div class="mb-3">

                <label class="form-label">

                    Confirm Password

                </label>

                <div class="input-group">

                    <input
                        type="password"
                        name="confirmPassword"
                        id="confirmPassword"
                        class="form-control"
                        placeholder="Confirm new password"
                        required
                    >

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        onclick="togglePassword('confirmPassword', this)"
                    >

                        <i class="bi bi-eye"></i>

                    </button>

                </div>

            </div>


            <div class="password-info mb-4">

                <i class="bi bi-info-circle"></i>

                Use a strong password containing letters,
                numbers and special characters.

            </div>


            <!-- Submit -->

            <button
                type="submit"
                class="btn btn-primary w-100"
            >

                <i class="bi bi-key-fill me-1"></i>

                Reset Password

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


<script>

function togglePassword(inputId, button)
{
    const input = document.getElementById(inputId);

    const icon = button.querySelector('i');

    if (input.type === 'password') {

        input.type = 'text';

        icon.classList.remove('bi-eye');

        icon.classList.add('bi-eye-slash');

    } else {

        input.type = 'password';

        icon.classList.remove('bi-eye-slash');

        icon.classList.add('bi-eye');

    }
}

</script>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>