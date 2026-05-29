<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<?php
$gatewayIps = [
    '1'  => '10.23.144.45',
    '2'  => '10.23.144.46',
    '3'  => '10.23.144.47',
    '4'  => '10.23.144.48',
    '5'  => '10.23.144.49',
    '6'  => '10.23.144.50',
    '7'  => '10.23.144.51',
    '8'  => '10.23.144.52',
    '9'  => '10.23.144.53',
    '10' => '10.23.144.54',
    '11' => '10.23.144.55',
    '12' => '10.23.144.56',
    '13' => '10.23.144.57',
    '14' => '10.23.144.58',
    '15' => '10.23.144.59',
    '16' => '10.23.144.60',
    '17' => '10.23.144.70',
    '18' => '10.23.144.71',
    '19' => '10.23.144.72',
    '20' => '10.23.144.73',
    '21' => '10.23.144.74',
    '22' => '10.23.144.75',
    '23' => '10.23.144.76',
    '24' => '10.23.144.68',
    '25' => '10.23.144.69',
];

$gateways = [];

foreach ($sims as $sim) {
    $gw = $sim['gateway'];
    $slot = (int) $sim['sim_gateway'];

    if (!isset($gateways[$gw])) {
        $gateways[$gw] = [];
    }

    $gateways[$gw][$slot] = [
        'sim' => !empty($sim['sim_no']) ? $sim['sim_no'] : 'N/A',
        'status' => strtolower($sim['plan'])
    ];
}
?>

<body>

<div class="main-content">

    <div class="page-header">
        <div>
            <h1>SIM Gateway Monitor</h1>
            <p>Visual overview of SIM slots per gateway</p>
        </div>
    </div>

    <div class="gateway-container">

        <?php foreach ($gateways as $gw => $slots): ?>

            <?php
                $gatewayNo = preg_replace('/[^0-9]/', '', $gw);
                $gatewayIp = $gatewayIps[$gatewayNo] ?? 'No IP set';

                $activeCount = 0;
                $inactiveCount = 0;

                for ($i = 0; $i <= 31; $i++) {
                    $data = $slots[$i] ?? null;
                    $status = $data['status'] ?? 'inactive';

                    if ($status === 'active') {
                        $activeCount++;
                    } else {
                        $inactiveCount++;
                    }
                }
            ?>

            <div class="gateway-card">

                <div class="gateway-header">
                    <div>
                        <h2>Gateway <?= esc($gw) ?></h2>
                        <p>IP Address: <?= esc($gatewayIp) ?></p>
                        <p>32 SIM Slots</p>
                    </div>

                    <div class="gateway-summary">
                        <span class="summary-active"><?= $activeCount ?> Active</span>
                        <span class="summary-inactive"><?= $inactiveCount ?> Inactive</span>
                    </div>
                </div>

                <div class="sim-grid">

                    <?php for ($i = 0; $i <= 31; $i++): 
                        $data = $slots[$i] ?? null;
                        $sim = $data['sim'] ?? 'N/A';
                        $status = $data['status'] ?? 'inactive';

                        if ($status !== 'active') {
                            $status = 'inactive';
                        }
                    ?>

                        <div class="sim-slot <?= esc($status) ?>">
                            <div class="slot-top">
                                <span class="slot-number">SIM <?= $i ?></span>
                                <span class="status-dot"></span>  
                            </div>

                            <div class="sim-text">
                                <?= esc($sim) ?>
                            </div>

                            <div class="slot-status">
                                <?= ucfirst(esc($status)) ?>
                            </div>
                        </div>

                    <?php endfor; ?>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>

<?php include(APPPATH.'Views/layout/footer.php'); ?>