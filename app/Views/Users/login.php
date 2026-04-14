<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
</head>
<body>

    <div class="wrapper">
        <span class="bg-animate"></span>
        <div class="form-box login">
            <h2>Login</h2>
            <form action="#">
                <div class="input-box">
                    <input type="text" required>
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" required>
                    <label>Password</label>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type= "submit" class="btn">Login</button>
                <div class="logreg-link">
                    <p>Don't have an account? <a href="#"
                     class="register-link">Sign up</a></p>
                </div>
            </form>
        </div>
        <div class="info-text login">
            <h2>Welcome Back!</h2>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
        </div>
    </div>
    
</body>
</html>