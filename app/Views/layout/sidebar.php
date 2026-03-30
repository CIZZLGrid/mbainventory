<body>
    <div class="sidebar">
        <ul class="menu">
            <li><i class="fa fa-home"></i> Dashboard</li>

            <li class="submenu">
                <i class="fa fa-user"></i> User Management
            </li>

            <li><i class="fa fa-list"></i> Categories</li>

            <li class="menu-title">Sim Card Management</li>

            <li><i class="fa fa-sim-card"></i> Manage Sim Card</li>

            <!-- Parent menu with submenu -->
            <li class="has-submenu active">
               Add Sim Card
                <ul class="submenu">
                    <li>Add Globe Sim Cards</li>
                    <li>Add Smart Sim Cards</li>
                </ul>
            </li>

            <li><i class="fa fa-image"></i> Media Files</li>
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
