<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<body>

<div class="inactive-main">

    <div class="inactive-header">
        <div>
            <h1>Archived SIM Cards</h1>
            <p>List of all archived SIM cards.</p>
        </div>

        <a href="<?= base_url('users/dashboard') ?>" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Dashboard
        </a>
    </div>

    <div class="inventory-toolbar">
        <form method="GET" action="" class="search-form">
            <div class="search-box">
                <i class="fa fa-search"></i>
                <input 
                    type="number" 
                    name="search" 
                    id="searchInput" 
                    placeholder="Search SIM card number..."
                />
            </div>
        </form>
    </div>

    <div class="inactive-card">

        <div class="table-wrapper">
            <table class="inactive-table">
                <thead>
                    <tr>
                        <th>SIM Slot</th>
                        <th>SIM ID</th>
                        <th>Mobile Number</th>
                        <th>Operator</th>
                        <th>Gateway</th>
                        <th>IP Address</th>
                        <th>Status</th>
                        <th>Archived By</th>
                        <th>Archived At</th>
                        <th>Days Left</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($archived_sims)): ?>
                        <?php foreach ($archived_sims as $sim): ?>
                            <tr>
                                <td><?= esc($sim['sim_gateway']) ?></td>
                                <td><?= esc($sim['sim_id']) ?></td>
                                <td><?= esc($sim['sim_no']) ?></td>
                                <td><?= esc($sim['operator']) ?></td>
                                <td><?= esc($sim['gateway']) ?></td>
                                <td><?= esc($sim['ip_address']) ?></td>
                                <td><?= esc($sim['plan']) ?></td>

                                <td>
                                    <?= esc($sim['archived_by'] ?? '-') ?>
                                </td>

                                <td>
                                    <span class="days-badge">
                                        <?= esc($sim['archived_at']) ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="days-badge">
                                        <?= esc($sim['days_left'] ?? 0) ?> days left
                                    </span>
                                </td>

                                <td>
                                    <div class="action-buttons">
                                        <a href="<?= base_url('users/restore/'.$sim['archive_id']) ?>"
                                        class="restore-btn"
                                        onclick="return confirm('Are you sure you want to restore this SIM?');">
                                            <i class="fas fa-undo"></i> Restore
                                        </a>

                                        <a href="<?= base_url('users/delete_archived/'.$sim['archive_id']) ?>"
                                        class="delete-archive-btn"
                                        onclick="return confirm('Are you sure you want to permanently delete this archived SIM? This cannot be undone.');">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="empty-row">
                                No archived SIM cards found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>

<script>
    function applyArchivedSearch() {
        let searchValue = document.getElementById('searchInput').value.toLowerCase().trim();
        let rows = document.querySelectorAll('.inactive-table tbody tr');

        rows.forEach(function(row) {
            let simNo = row.cells[2]?.textContent.toLowerCase().trim() || '';
            let matchSearch = !searchValue || simNo.includes(searchValue);

            row.style.display = matchSearch ? '' : 'none';
        });
    }

    document.getElementById('searchInput').addEventListener('keyup', applyArchivedSearch);
</script>

</body>

<?php include(APPPATH.'Views/layout/footer.php'); ?>