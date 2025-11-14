<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Registration</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3f4f6;
            padding: 40px;
        }
    </style>
</head>

<body>

    <div class="card p-4 shadow mb-4" style="max-width: 700px; margin: auto; border-radius: 12px;">
        <h4 class="text-center mb-3">Register User</h4>

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input class="form-control" id="name" name="name" placeholder="Enter full name">
            </div>

            <div class="col-md-6">
                <label class="form-label">Mobile</label>
                <input class="form-control" id="mobile" name="mobile" placeholder="Enter mobile number">
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input class="form-control" id="email" name="email" placeholder="Enter email">
            </div>

            <div class="col-md-6">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
            </div>

            <div class="col-md-6">
                <label class="form-label" >Role</label>
                <select id="role" class="form-control">
                    <option name="user">User</option>
                    <option name="admin">Admin</option>
                </select>
            </div>

            <div class="col-md-6 d-flex align-items-end">
                <button id="registerBtn" class="btn btn-primary w-100" style="height: 45px;">
                    Register User
                </button>
            </div>

        </div>
    </div>

    <!-- Back to Login -->
    <div class="text-center mt-3">
        <a href="<?php echo site_url('admin/login'); ?>" class="text-decoration-none">
            ← Back to Login
        </a>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="<?= base_url('assets/js/script.js'); ?>"></script>

</body>

</html>
