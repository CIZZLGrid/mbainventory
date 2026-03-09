<?php if(isset($validation)): ?>
   <?= $validation->listErrors(); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>

    <form method="post" action="<?= base_url('users/update/') . $user['id'] ?>">

    <Label>Name</Label>
    <input type="text" name="name" value="<?= $user['name'] ?>" required>
    <br><br>

    <label>Email</label>
    <input type="text" name="email" value="<?= $user['email'] ?>" required>

    <br><br>

    <button type="submit">Update User</button>

    </form>

    <br><br>

    <a href="<?= base_url('users') ?>">Back to User List</a>
    
</body>
</html>