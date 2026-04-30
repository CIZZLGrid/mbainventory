<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>


<body>
    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold  text-uppercase mb-1">
                                                Active Simcards</div>
                                            <div class="h5 mb-0 font-weight-bold text-white-800"><?= $active ?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-sim-card fa-2x" style="color:#1cc88a;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold e text-uppercase mb-1">
                                                Inactive Simcards</div>
                                            <div class="h5 mb-0 font-weight-bold text-white-800"><?= $inactive ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-sim-card fa-2x" style="color:#ff0000;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                 
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold  text-uppercase mb-1">Total
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-white-800"><?= $total ?></div>
                                        </div>
                                            <div class="col">                
                                 </div>
                             </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sim-card fa-2x" style="color:#36b9cc;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold  text-uppercase mb-1">
                                              Empty Sim Slots</div>
                                            <div class="h5 mb-0 font-weight-bold text-white-800"> <?= $empty ?> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-sim-card fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<div class="row chart-row">
    <div class="col-xl-8 col-lg-10 chart-center">
        <div class="card shadow mb-4 chart-card">
            <div class="card-header py-3">
                
            </div>
            <div class="card-body">
                <canvas id="simPieChart"></canvas>
            </div>
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
        labels: ['Active', 'Inactive', 'Empty Slots'],
        datasets: [{
            data: [
                <?= $active ?>,
                <?= $inactive ?>,
                <?= $empty ?>
            ],
            backgroundColor: [
                '#1cc88a',   // green
                '#ff0000',   // red
                '#ffff'    // yellow
            ],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>

</body>










<?php include(APPPATH.'Views/layout/footer.php'); ?>