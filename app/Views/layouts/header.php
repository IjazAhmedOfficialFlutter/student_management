<!DOCTYPE html>
<<html lang="<?= service('request')->getLocale() ?>"
      dir="<?= service('request')->getLocale() === 'ur' ? 'rtl' : 'ltr' ?>">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'Student Management System') ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
      <?php if (service('request')->getLocale() === 'ur'): ?>
        <link href="<?= base_url('assets/css/rtl.css') ?>" rel="stylesheet">
    <?php endif; ?>

</head>

<body>