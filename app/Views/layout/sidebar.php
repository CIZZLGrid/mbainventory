<body>
    <div class="sidebar">
        <ul class="menu">
            <li class="blur"><i class="fa fa-home"></i> Dashboard</li>

            <li class="blur">
                <i class="fa fa-user"></i> User Management
            </li>

            <li class="menu-title">Sim Card Management</li>

            <li><a class="manage" href="<?= base_url('/users/product') ?>"><i class="fa fa-sim-card"></i> Manage Sim Card</a></li>

            <!-- Parent menu with submenu -->
            <li class="has-submenu active">
               Add Sim Card
                <ul class="submenu">
                    <li> <a class="manage" href="<?= base_url('/users/globe_sim') ?>">Add Globe Sim Cards</a></li>
                    <li><a class="manage" href="<?= base_url('/users/smart_sim') ?>">Add Smart Sim Cards</a></li>
                </ul>
            </li>

            <li><a class="manage" href="<?= base_url('/users/gateway_visual') ?>"><i class="fa fa-image"></i> Gateway Layout </a></li>
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
