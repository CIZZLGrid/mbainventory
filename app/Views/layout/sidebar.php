<body>
    <div class="sidebar">
        <ul class="menu">
            <li><a class="manage" href="<?= base_url('/users/dashboard') ?>"><i class="fa fa-home"></i> Dashboard</li>

            <li><a class="manage" href="<?= base_url('/users/admin_management') ?>">
                <i class="fa fa-user"></i> User Management
            </li>   

            <li class="menu-title">Sim Card Management</li>

            <li><a class="manage" href="<?= base_url('/users/product') ?>"><i class="fa fa-sim-card"></i> Manage Sim Card</a></li>

            <!-- Parent menu with submenu -->
            <li class="has-submenu active">
                <a class="manage" href="#"><i class="fa fa-plus"></i> Add Sim Card</a>
                <ul class="submenu">
                    <li> <a class="manage" href="<?= base_url('/users/globe_sim') ?>">Add Globe Sim Cards</a></li>
                    <li><a class="manage" href="<?= base_url('/users/smart_sim') ?>">Add Smart Sim Cards</a></li>
                </ul>
            </li>

            <li><a class="manage" href="<?= base_url('/users/gateway_visual') ?>"><i class="fa fa-image"></i> Gateway Monitor </a></li>
        </ul>
    </div>
    <script>
    const submenuParents = document.querySelectorAll('.menu li.has-submenu');
    submenuParents.forEach(parent => {
        parent.addEventListener('click', () => {
            parent.classList.toggle('active');
        });
    });
</script>
</body>
