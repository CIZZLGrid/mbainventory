<?php include(APPPATH. 'VIEWS/layout/header.php'); ?>

<div class="login-page">
    <div class="login-box">
        <div class="text-center">
            <h1>Login Panel</h1>
            <h4>Inventory Management System</h4>
        </div>

        <form method="post" action="<?= base_url('users/login') ?>" class="clearfix">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>

            <div class="form-group">
                <button type="submit" class="btn-login">Login</button>
            </div>
        </form>
    </div>
</div>

<?php include(APPPATH. 'VIEWS/layout/footer.php'); ?>