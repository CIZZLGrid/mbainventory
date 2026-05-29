<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<style>
.main-content {
    margin-left: 240px;
    padding: 30px;
    background: #0f172a;
    min-height: 100vh;
    color: #fff;
}

.main-content,
.card,
.edit-form,
.edit-form input,
.edit-form button,
.btn-back {
    position: relative;
    z-index: 9999;
}

.edit-form input {
    pointer-events: auto;
}

.card {
    background: #111827;
    border: 1px solid #2b3548;
    border-radius: 14px;
    padding: 25px;
    max-width: 650px;
}

.card h2 {
    margin-bottom: 8px;
}

.card p {
    color: #9ca3af;
    margin-bottom: 25px;
}

.edit-form {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.edit-form label {
    font-weight: 600;
    color: #cbd5e1;
}

.edit-form input {
    background: #0f172a;
    border: 1px solid #334155;
    color: white;
    padding: 13px 15px;
    border-radius: 10px;
    outline: none;
}

.edit-form input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.2);
}

.form-actions {
    display: flex;
    gap: 12px;
    margin-top: 10px;
}

.btn-save {
    background: #16a34a;
    border: none;
    color: white;
    padding: 12px 22px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
}

.btn-back {
    background: #334155;
    color: white;
    text-decoration: none;
    padding: 12px 22px;
    border-radius: 10px;
    font-weight: 600;
}

.alert {
    padding: 14px 18px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.alert.error {
    background: rgba(220,38,38,0.15);
    color: #f87171;
    border: 1px solid rgba(220,38,38,0.4);
}
</style>

<div class="main-content">
    <div class="card">

        <h2>Edit Admin</h2>
        <p>Edit admin username or change password.</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= base_url('/users/update_admin/' . $admin['id']) ?>" class="edit-form">
            <?= csrf_field() ?>

            <label>Admin Username</label>
            <input 
                type="text" 
                name="username" 
                value="<?= esc($admin['username']) ?>" 
                required
            >

            <label>New Password</label>
            <input 
                type="password" 
                name="password" 
                placeholder="Leave blank to keep current password"
            >

            <div class="form-actions">
                <button type="submit" class="btn-save">Save Changes</button>

                <a href="<?= base_url('/users/admin_management') ?>" class="btn-back">
                    Back
                </a>
            </div>
        </form>

    </div>
</div>