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
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </th>
                        <th>IP Address
                             <select id="ipFilter" style="margin-left: 5px">
                                <option value="all">ALL</option>
                                <option value="10.23.144.45">10.23.144.45</option>
                                <option value="10.23.144.46">10.23.144.46</option>
                                <option value="10.23.144.47">10.23.144.47</option>
                                <option value="10.23.144.48">10.23.144.48</option>
                            </select>
                        </th>
                        <th>STATUS
                             <select id="statusFilter" style="margin-left: 5px">
                                <option value="all">ALL</option>
                                <option value="active">ACTIVE</option>
                                <option value="inactive">INACTIVE</option>
                            </select>
                        </th>
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
                        <td class="plan"><?= $sim['plan'] ?></td>
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

   function applyFilters() {
    let operatorSelected = document.getElementById("operatorFilter").value.toLowerCase();
    let gatewaySelected = document.getElementById("gatewayFilter").value.toLowerCase();
    let ipSelected = document.getElementById("ipFilter").value.toLowerCase();
    let statusSelected = document.getElementById("statusFilter").value.toLowerCase();
    let searchValue = document.getElementById("searchInput").value.toLowerCase().trim();
    let selectedDate = document.getElementById("dateFilter").value;

    let rows = document.querySelectorAll("#tableBody tr");

    rows.forEach(function(row) {
        let operator = row.querySelector(".operator")?.textContent.toLowerCase().trim();
        let gateway = row.querySelector(".gateway")?.textContent.toLowerCase().trim();
        let ip = row.querySelector(".ip-address")?.textContent.toLowerCase().trim();
        let sim = row.querySelector(".sim-number")?.textContent.toLowerCase().trim();
        let plan = row.querySelector(".plan")?.textContent.toLowerCase().trim();
        let rowDate = row.querySelector(".date")?.textContent.trim();

        let matchOperator = (operatorSelected === "all" || operator === operatorSelected);
        let matchGateway = (gatewaySelected === "all" || gateway === gatewaySelected);
        let matchIP = (ipSelected === "all" || ip === ipSelected);
        let matchStatus = (statusSelected === "all" || plan === statusSelected);
        let matchSearch = (!searchValue || sim.includes(searchValue));
        let matchDate = (!selectedDate || rowDate === selectedDate);

        if (matchOperator && matchGateway && matchIP && matchStatus && matchSearch && matchDate) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

document.getElementById("operatorFilter").addEventListener("change", applyFilters);
document.getElementById("gatewayFilter").addEventListener("change", applyFilters);
document.getElementById("ipFilter").addEventListener("change", applyFilters);
document.getElementById("statusFilter").addEventListener("change", applyFilters);

document.getElementById("searchInput").addEventListener("keyup", applyFilters);

document.getElementById("dateFilter").addEventListener("change", applyFilters);

    </script>
</body>



<?php include(APPPATH.'Views/layout/footer.php'); ?>