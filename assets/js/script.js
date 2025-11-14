const API_URL = "http://localhost/ci_ajax_learning/api/admin";


let currentPage = 1;
let limit = 5;
let sort = "id";
let order = "ASC";


// ✅ Show alert message
function showAlert(type, message) {
    let color = type === "success" ? "green" : "red";
    $("#alertBox").html(`
        <div class="p-2 mb-2 text-white" style="background:${color}">${message}</div>
    `);
    setTimeout(() => $("#alertBox").html(""), 2000);
}


function buildParams() {
    return `?page=${currentPage}&limit=${limit}&sort=${sort}&order=${order}` +
           `&name=${$("#searchName").val()}` +
           `&email=${$("#searchEmail").val()}` +
           `&role=${$("#searchRole").val()}`;
}


/* ✅ 1. LOAD USERS (GET) */
function loadUsers() {
    $.ajax({
        url: API_URL + buildParams(),
        type: "GET",
        dataType: "json",
        success: function(responce) {
          
          
            let rows = "";

            responce.data.forEach(user => {
                rows += `
                  <tr data-id="${user.id}">
                    <td>${user.id}</td>
                    <td><input class="name" value="${user.name}"></td>
                    <td><input class="mobile" value="${user.mobile}"></td>
                    <td><input class="email" value="${user.email}"></td>
                    <td>
                      <select class="role">
                        <option ${user.role=='User'?'selected':''}>User</option>
                        <option ${user.role=='Admin'?'selected':''}>Admin</option>
                      </select>
                    </td>
                    <td>
                      <button class="btn btn-update btn btn-primary updateBtn" id="updateBtn">Update</button>
                      <button class="btn btn-delete btn btn-danger deleteBtn">Delete</button>
                    </td>
                  </tr>
                `;
            });

            $("#userTableBody").html(rows);
            // Pagination buttons
            renderPagination(responce.total, responce.page, responce.limit);
        }
    });
}


function renderPagination(total) {
    let pages = Math.ceil(total / limit);
    let html = "";

    for (let i = 1; i <= pages; i++) {
        html += `<button class="btn btn-sm ${i == currentPage ? 'btn-dark' : 'btn-secondary'} pageBtn" data-page="${i}">${i}</button>`;
    }

    $("#pagination").html(html);
}

$("#searchBtn").click(function(){
    currentPage = 1;
    loadUsers();
});



// ✅ Pagination
$(document).on("click", ".pageBtn", function () {
    currentPage = $(this).data("page");
    loadUsers();
});



/* ✅ 2. ADD USER (POST) */
$("#addBtn").click(function() {

    let newUser = {
        name: $("#name").val(),
        mobile: $("#mobile").val(),
        email: $("#email").val(),
        password: $("#password").val(),
        role: $("#role").val()
    };

    $.ajax({
        url: API_URL,
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(newUser),
        success: function(responce) {
             alert(responce.message);
            loadUsers();
        }
    });
});
/* ✅ 2. Register USER (POST) */
$("#registerBtn").click(function() {

    let newUser = {
        name: $("#name").val(),
        mobile: $("#mobile").val(),
        email: $("#email").val(),
        password: $("#password").val(),
        role: $("#role").val()
    };

    $.ajax({
        url: API_URL,
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(newUser),
        success: function(responce) {
             alert(responce.message);
            // loadUsers();
        }
    });
});


/* ✅ 3. UPDATE USER (PUT) */
$(document).on("click", ".updateBtn", function() {

    let row = $(this).closest("tr");
    let id = row.data("id");

    let updatedUser = {
        name: row.find(".name").val(),
        mobile: row.find(".mobile").val(),
        email: row.find(".email").val(),
        role: row.find(".role").val()
    };

    $.ajax({
        url: API_URL + "/" + id,
        type: "PUT",
        contentType: "application/json",
        data: JSON.stringify(updatedUser),
        success: function(responce) {
            alert(responce.message);
            loadUsers();
        }
    });

});


/* ✅ 4. DELETE USER (DELETE) */
$(document).on("click", ".deleteBtn", function() {

    let id = $(this).closest("tr").data("id");

    if (!confirm("Delete this user?")) return;

    $.ajax({
        url: API_URL + "/" + id,
        type: "DELETE",
        success: function(responce) {
            alert(responce.message);
            loadUsers();
        }
    });

});

function confirmLogout() {
    return confirm("Are you sure you want to logout?");
}

$(document).ready(loadUsers);