<?php if(isset($validation)): ?>
   <?= $validation->listErrors(); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h2>Add User</h2>

    <form method="post" action="<?= base_url('users/store') ?>">

    <Label>Name</Label>
    <input type="text" name="name" required>
    <br><br>

    <label>Email</label>
    <input type="text" name="email" required>
    <br><br>

    <button type="submit">Save User</button>

    </form>

   

    <a href="<?= base_url('/users') ?>">Back to Users List</a>
    
</body>
</html>