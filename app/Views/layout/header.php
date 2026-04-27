<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Inventory System</title>

<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<div class="topbar">
    <div class="top-left">

        <div class="logo">MBAC PH.</div>
    </div>

    <div class="top-middle">
        <div class="gateway">GATEWAY SIM INVENTORY</div>
    </div>

    <div class="top-right">
        <span id="currentDateTime"></span>
        <div class="user">
            <i class="fa fa-user-circle"></i> <?= session()->get('username')?>
            <?php if(session()->get('isLoggedIn')): ?>
                <a href="<?= base_url('auth/logout') ?>" style="margin-left: 15px; color: #fff; text-decoration: none;">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>



<script>
function updateDateTime() {
    const now = new Date();

    // Format date
    const dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = now.toLocaleDateString('en-US', dateOptions);

    // Format time as HH:MM:SS AM/PM
    const timeOptions = { hour: 'numeric', minute: '2-digit', second: '2-digit', hour12: true };
    const formattedTime = now.toLocaleTimeString('en-US', timeOptions);

    // Combine and display
    document.getElementById('currentDateTime').textContent = `${formattedDate} ${formattedTime}`;
}

// Initial call
updateDateTime();

// Update every 1 second
setInterval(updateDateTime, 1000);
</script>

</html>