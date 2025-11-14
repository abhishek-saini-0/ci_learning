<div class="stats-card">
    <div class="stats-title">Total Users</div>
    <div class="stats-number"><?= $total_users; ?></div>
</div>


<div class="container my-4">
    <div id="alertBox"></div>

    <!-- Search Filters -->
    <div class="card p-3 shadow mb-4">
        <div class="row">
            <div class="col"><input type="text" id="searchName" class="form-control" placeholder="Search Name"></div>
            <div class="col"><input type="text" id="searchEmail" class="form-control" placeholder="Search Email"></div>
            <div class="col">
                <select id="searchRole" class="form-control">
                    <option value="">All Roles</option>
                    <option>User</option>
                    <option>Admin</option>
                </select>
            </div>
            <div class="col"><button id="searchBtn" class="btn btn-dark w-100">Search</button></div>
        </div>
    </div>




<div class="table-container">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="userTableBody"></tbody>
    </table>

    <div id="pagination" class="mt-3 d-flex gap-2"></div>
</div>