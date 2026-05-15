<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<body>

<div class="dashboard-main">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-error">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="dashboard-title">
        <div>
            <h1>SIM Inventory Dashboard</h1>
            <p>Daily Excel-based SIM status overview</p>
        </div>

        <a href="<?= base_url('users/inactive-list') ?>" class="inactive-link">
            <i class="fas fa-list"></i>
            View Inactive List
        </a>
    </div>

    <div class="stats-grid">

        <div class="card stat-card border-left-primary">
            <div class="card-body">
                <div class="stat-layout">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Active Simcards
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-white-800">
                            <?= $active ?? 0 ?>
                        </div>
                    </div>

                    <div class="stat-icon green">
                        <i class="fas fa-sim-card"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card stat-card border-left-success">
            <div class="card-body">
                <div class="stat-layout">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Inactive Simcards
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-white-800">
                            <?= $inactive ?? 0 ?>
                        </div>
                    </div>

                    <div class="stat-icon red">
                        <i class="fas fa-sim-card"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card stat-card border-left-info">
            <div class="card-body">
                <div class="stat-layout">
                    <div>
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            Total Simcards
                        </div>

                        <div class="h5 mb-0 font-weight-bold text-white-800">
                            <?= $total ?? 0 ?>
                        </div>
                    </div>

                    <div class="stat-icon blue">
                        <i class="fas fa-sim-card"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="dashboard-content">

        <div class="chart-card">
            <div class="section-header">
                <div>
                    <h3>SIM Status Overview</h3>
                    <p>Active vs inactive SIM cards from the latest uploaded file</p>
                </div>
            </div>

            <div class="chart-body">
                <canvas id="simPieChart"></canvas>
            </div>
        </div>

        <div class="upload-card">
            <div class="section-header">
                <div>
                    <h3>Upload Daily Excel</h3>
                    <p>Upload the latest inventory file to update the dashboard.</p>
                </div>
            </div>

            <form action="<?= base_url('users/upload-excel') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <label class="file-label">
                    <span>Choose Excel / CSV File</span>
                    <input type="file" name="excel_file" accept=".xlsx,.xls,.csv" required>
                </label>

                <button type="submit" class="upload-btn">
                    <i class="fas fa-upload"></i>
                    Upload Daily Excel
                </button>
            </form>

            <div class="upload-note">
                Accepted files: <strong>.xlsx</strong>, <strong>.xls</strong>, <strong>.csv</strong>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('simPieChart').getContext('2d');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Active', 'Inactive'],
        datasets: [{
            data: [
                <?= $active ?? 0 ?>,
                <?= $inactive ?? 0 ?>
            ],
            backgroundColor: [
                '#1cc88a',
                '#ff4d4d'
            ],
            borderColor: '#0f1419',
            borderWidth: 3
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#ffffff',
                    font: {
                        size: 14,
                        weight: 'bold'
                    },
                    padding: 20
                }
            }
        }
    }
});
</script>

</body>

<?php include(APPPATH.'Views/layout/footer.php'); ?>