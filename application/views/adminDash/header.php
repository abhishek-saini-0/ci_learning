<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

</head>

<body>
    <div class="wrapper">
        <div class="header d-flex justify-content-between align-items-center">
            <h2 class="m-0">Admin Dashboard</h2>

            <div class="d-flex align-items-center text-white gap-2">
                <!-- Profile Icon -->
                <div class="head">
                    <?= strtoupper(substr($this->session->userdata('admin_user')['name'], 0, 1)); ?>
                </div>

                <!-- Name -->
                <span style="font-size: 16px;">
                    <?= $this->session->userdata('admin_user')['name']; ?>
                </span>

                <!-- Logout -->
                <a href="<?= base_url('admin/logout'); ?>" class="btn btn-sm btn-light" style="margin-left: 10px;" onclick="return confirmLogout()">
                    Logout
                </a>
            </div>
        </div>