<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<style>
.main-content {
    margin-left: 240px;
    padding: 30px;
    background: #0f172a;
    min-height: 100vh;
    color: #fff;
    position: relative;
    z-index: 1;
}

.card {
    background: #111827;
    border: 1px solid #2b3548;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    position: relative;
    z-index: 5;
}

.card h2 {
    margin-bottom: 8px;
    font-size: 28px;
    color: #fff;
}

.card p {
    color: #9ca3af;
    margin-bottom: 25px;
}

.admin-form {
    display: flex;
    gap: 15px;
    margin-bottom: 25px;
    flex-wrap: wrap;
    position: relative;
    z-index: 10;
}

.admin-table,
.admin-table td,
.delete-form,
.delete-btn {
    position: relative;
    z-index: 20;
}

.delete-form {
    margin: 0;
}

.delete-btn {
    border: none;
    cursor: pointer;
}

.admin-form input {
    flex: 1;
    min-width: 220px;
    background: #0f172a;
    border: 1px solid #334155;
    color: white;
    padding: 13px 15px;
    border-radius: 10px;
    outline: none;
    transition: 0.2s;
    position: relative;
    z-index: 10;
}

.admin-form input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.2);
}

.admin-form button {
    background: #16a34a;
    border: none;
    color: white;
    padding: 13px 24px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.2s;
    position: relative;
    z-index: 10;
}

.admin-form button:hover {
    background: #15803d;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 12px;
}

.admin-table thead {
    background: #1e293b;
}

.admin-table th {
    padding: 16px;
    text-align: left;
    font-size: 13px;
    color: #cbd5e1;
    text-transform: uppercase;
    border-bottom: 1px solid #334155;
}

.admin-table td {
    padding: 16px;
    border-bottom: 1px solid #1e293b;
    color: #f1f5f9;
}

.admin-table tbody tr:hover {
    background: #172033;
}

.delete-btn {
    background: #dc2626;
    color: white;
    text-decoration: none;
    padding: 8px 14px;
    border-radius: 8px;
    font-size: 14px;
}

.delete-btn:hover {
    background: #b91c1c;
}

.alert {
    padding: 14px 18px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-weight: 500;
}

.alert.success {
    background: rgba(22,163,74,0.15);
    color: #4ade80;
    border: 1px solid rgba(22,163,74,0.4);
}

.alert.error {
    background: rgba(220,38,38,0.15);
    color: #f87171;
    border: 1px solid rgba(220,38,38,0.4);
}
</style>

<div class="main-content">
    <div class="card">

        <h2>User Management</h2>
        <p>Add and delete admin accounts.</p>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= base_url('/users/add_admin') ?>" class="admin-form">
            <?= csrf_field() ?>

            <input 
                type="text" 
                name="username" 
                placeholder="Admin username" 
                autocomplete="off"
                required
            >

            <input 
                type="password" 
                name="password" 
                placeholder="Admin password" 
                autocomplete="new-password"
                required
            >

            <button type="submit">Add Admin</button>
        </form>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($admins)): ?>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?= esc($admin['id']) ?></td>
                            <td><?= esc($admin['username']) ?></td>
                            <td><?= esc($admin['role']) ?></td>
                            <td>
                                <form method="POST" action="<?= base_url('/users/delete_admin/' . $admin['id']) ?>" class="delete-form">
                                <?= csrf_field() ?>

                                <button 
                                    type="submit" 
                                    class="delete-btn"
                                    onclick="return confirm('Delete this admin?')"
                                >
                                    Delete
                                </button>
                            </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No admin accounts yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>