<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<body>
    <div class="main">

        <div class="card">

            <div class="card-header">
                <form method="GET" action="">
                    <div class="search-container">
                        <input type="text" name="search" id="searchInput" placeholder="Search for Sim Card Number" />
                    </div>
                </form>  
            </div>

            <table class="product-table">
                <thead>
                    <tr>
                        <th>Sim Slot on Gateway</th>
                        <th>Sim Card ID(Account No)</th>
                        <th>Sim Card Mobile Number</th>
                        <th>Mobile Operator
                            <select id="operatorFilter" style="margin-left: 5px">
                                <option value="all">ALL</option>
                                <option value="globe">GLOBE</option>
                                <option value="smart">SMART</option>
                            </select>
                        </th>
                        <th>Gateway
                             <select id="gatewayFilter" style="margin-left: 5px">
                                <option value="all">ALL</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </th>
                        <th>IP Address
                             <select id="ipFilter" style="margin-left: 5px">
                                <option value="all">ALL</option>
                                <option value="10.23.144.45">10.23.144.45</option>
                                <option value="10.23.144.46">10.23.144.46</option>
                            </select>
                        </th>
                        <th>Plan</th>
                        <th>CALL TO:</th>
                        <th>SMS TO:</th>
                        <th>Date
                            <input type="date" id="dateFilter">
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="tableBody">

                    <?php foreach($sims as $sim): ?>
                    <tr>
                        <td><?= $sim['sim_gateway'] ?></td>
                        <td><?= $sim['sim_id'] ?></td>
                        <td class="sim-number"><?= $sim['sim_no'] ?></td>
                        <td class="operator"><?= $sim['operator'] ?></td>
                        <td class="gateway"><?= $sim['gateway'] ?></td>
                        <td class="ip-address"><?= $sim['ip_address'] ?></td>
                        <td><?= $sim['plan'] ?></td>
                        <td><?= $sim['call_to'] ?></td>
                        <td><?= $sim['sms_to'] ?></td>
                        <td class="date"><?= $sim['date'] ?></td>

                        
                        <td>
                            <a class="btn-edit" href="<?= base_url('users/edit_sim/'. $sim['id']) ?>"><i class="fa fa-edit"></i></a>
                            <a class="btn-delete" href="<?= base_url('users/delete/'. $sim['id']) ?>" onclick="return confirm('Are you sure you want to delete this row?')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>

        

    </div>

    <script>

        //function for operator filter
    document.getElementById("operatorFilter").addEventListener("change", function () {
        let selected = this.value.toLowerCase();
        let rows = document.querySelectorAll("#tableBody tr");

        rows.forEach(function(row) {
            let operatorCell = row.querySelector(".operator");
            if (!operatorCell) return;

            let operator = operatorCell.textContent.toLowerCase().trim();

            if (selected === "all" || operator === selected) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });

     document.getElementById("gatewayFilter").addEventListener("change", function () {
        let selected = this.value.toLowerCase();
        let rows = document.querySelectorAll("#tableBody tr");

        rows.forEach(function(row) {
            let gatewayCell = row.querySelector(".gateway");
            if (!gatewayCell) return;

            let gateway = gatewayCell.textContent.toLowerCase().trim();

            if (selected === "all" || gateway === selected) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });

    document.getElementById("ipFilter").addEventListener("change", function () {
        let selected = this.value.toLowerCase();
        let rows = document.querySelectorAll("#tableBody tr");

        rows.forEach(function(row) {
            let ipCell = row.querySelector(".ip-address");
            if (!ipCell) return;

            let ip = ipCell.textContent.toLowerCase().trim();

            if (selected === "all" || ip === selected) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
    
  // search function for sim card no.
document.getElementById("searchInput").addEventListener("keyup", function () {
    let value = this.value.toLowerCase().trim();
    let rows = document.querySelectorAll("#tableBody tr");

    rows.forEach(function(row) {
        let simCell = row.querySelector(".sim-number");
        if (!simCell) return;

        let sim = simCell.textContent.toLowerCase().trim();

        row.style.display = sim.includes(value) ? "" : "none";
    });
});


// function for date filter
const dateFilter = document.getElementById("dateFilter");

dateFilter.addEventListener("change", function() {
    const selectedDate = this.value; // YYYY-MM-DD
    const rows = document.querySelectorAll("#tableBody tr");

    rows.forEach(row => {
        const rowDate = row.querySelector(".date").textContent;

        // Show row if date matches or hide if not
        if (!selectedDate || rowDate === selectedDate) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

    </script>
</body>



<?php include(APPPATH.'Views/layout/footer.php'); ?>