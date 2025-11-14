<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #6dd5fa, #2980b9);
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        width: 380px;
        padding: 35px 30px;
        background: rgba(255, 255, 255, 0.85);
        border-radius: 12px;
        backdrop-filter: blur(8px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.18);
        animation: fadeIn 0.4s ease-in-out;
    }

    h2 {
        text-align: center;
        color: #1e3d59;
        margin-bottom: 25px;
        font-weight: 700;
    }

    input {
        width: 100%;
        padding: 14px;
        margin: 12px 0;
        border-radius: 8px;
        border: 1px solid #ced4da;
        font-size: 15px;
        transition: 0.3s;
    }

    input:focus {
        border-color: #1e88e5;
        outline: none;
        box-shadow: 0 0 5px rgba(30, 136, 229, 0.4);
    }

    button {
        width: 100%;
        padding: 14px;
        background: #1e88e5;
        color: white;
        border: none;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 10px;
        transition: 0.25s ease;
    }

    button:hover {
        background: #1565c0;
    }

    .error {
        margin-top: 10px;
        padding: 12px;
        border-radius: 6px;
        font-size: 14px;
        background: #ffebee;
        border-left: 5px solid #d32f2f;
        color: #d32f2f;
        animation: slideIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-10px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

<div class="login-card">
    <h2>Admin Login</h2>

    <div id="errorBox"></div>

    <form id="loginForm">
        <input type="email" id="email" placeholder="Email" required>
        <input type="password" id="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

<script>
    document.getElementById("loginForm").addEventListener("submit", function (e) {
        e.preventDefault();

        fetch("<?= site_url('adminApi/AdminApi/login'); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                email: document.getElementById("email").value,
                password: document.getElementById("password").value
            })
        })
            .then(response => response.json())
            .then(data => {

                if (!data.status) {
                    document.getElementById("errorBox").innerHTML =
                        `<div class='error'>${data.msg}</div>`;
                    return;
                }


                localStorage.setItem("jwt_token", data.token);


                window.location.href = "<?= site_url('admin/dashboard'); ?>";
            });
    });
</script>