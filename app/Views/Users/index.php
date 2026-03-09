<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
    <h1>User List</h1>
    <a href="<?= base_url('/users/create') ?>">Create New User</a>


    <table border="1" cellpadding="10">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
        </tr>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><a href="<?= base_url('users/edit/'. $user['id']) ?>">Edit</a></td>
                <td><a href="<?= base_url('users/delete/'. $user['id']) ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a></td>
            </tr>
            <?php endforeach; ?>

    </table>

    
</body>
</html>