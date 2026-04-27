<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<?php
$gateways = [];

foreach ($sims as $sim) {
    $gw = $sim['gateway'];
    $slot = (int)$sim['sim_gateway'];

    if (!isset($gateways[$gw])) {
        $gateways[$gw] = [];
    }

    $gateways[$gw][$slot] = [
        'sim' => $sim['sim_no'] ?: 'N/A',
        'status' => strtolower($sim['plan'])
    ];
}
?>

<div class="main-content">
    <div class="gateway-container">

    <?php foreach ($gateways as $gw => $slots): ?>
        <div class="gateway-card">

            <div class="gateway-header">
                Gateway <?= $gw ?> 
            </div>

            <div class="sim-grid">

                <?php for ($i = 0; $i <= 31; $i++): 
                    $data = $slots[$i] ?? null;
                    $sim = $data['sim'] ?? 'N/A';
                    $status = $data['status'] ?? 'inactive';
                ?>

                    <div class="sim-slot <?= $status ?>">
                        <div class="slot-number"><?= $i ?></div>
                        <div class="sim-text"><?= $sim ?></div>
                    </div>

                <?php endfor; ?>

            </div>
        </div>
    <?php endforeach; ?>

    </div>
</div>