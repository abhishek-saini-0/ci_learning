<style>
    .sidebar {
        width: 200px;
        background: #f2f2f2;
        height: 100vh;
        float: left;
        padding: 20px;
    }

    .sidebar a {
        display: block;
        margin-bottom: 10px;
        text-decoration: none;
        color: #333;
    }
</style>

<div class="sidebar">
    <a href="<?= base_url('adminDash/AdminController/index') ?>">Dashboard</a>
    <a href="<?= base_url('adminDash/AdminController/add_users') ?>">Add Users</a>


</div>

<div style="margin-left:220px; padding:20px;">