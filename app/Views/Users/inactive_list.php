<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<body>

<div class="inactive-main">

    <div class="inactive-header">
        <div>
            <h1>Inactive SIM Cards</h1>
            <p>List of inactive SIM cards based on the latest Excel scan.</p>
        </div>

        <a href="<?= base_url('users/dashboard') ?>" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Dashboard
        </a>
    </div>

    <div class="inactive-card">

        <form method="get" action="<?= base_url('users/inactive-list') ?>" class="filter-form">
            <label>Filter by Gateway</label>

            <div class="filter-row">
                <select name="gateway">
                    <option value="">All Gateways</option>

                    <?php if (!empty($gatewayOptions)): ?>
                        <?php foreach ($gatewayOptions as $gateway): ?>
                            <option value="<?= esc($gateway['gateway_no']) ?>"
                                <?= ($selectedGateway == $gateway['gateway_no']) ? 'selected' : '' ?>>
                                <?= esc($gateway['gateway_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <button type="submit">Filter</button>

                <a href="<?= base_url('users/inactive-list') ?>" class="clear-filter">
                    Clear
                </a>
            </div>
        </form>

        <div class="table-wrapper">
            <table class="inactive-table">
                <thead>
                    <tr>
                        <th>Gateway</th>
                        <th>IP Address</th>
                        <th>SIM ID</th>
                        <th>Inactive Since</th>
                        <th>Days Inactive</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($inactiveSims)): ?>
                        <?php foreach ($inactiveSims as $sim): ?>
                            <tr>
                                <td>
                                    <?= esc($sim['gateway_name'] ?? 'Unmapped') ?>
                                </td>

                                <td>
                                    <?= esc($sim['ip_address']) ?>
                                </td>

                                <td>
                                    <?= esc($sim['sim_id']) ?>
                                </td>

                                <td>
                                    <?= esc($sim['inactive_since']) ?>
                                </td>

                                <td>
                                    <span class="days-badge">
                                        <?= esc($sim['days_inactive']) ?> days
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="empty-row">
                                No inactive SIM cards found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

</div>

</body>

<?php include(APPPATH.'Views/layout/footer.php'); ?>    