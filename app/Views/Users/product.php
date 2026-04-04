<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<body>
    <div class="main">

        <div class="card">

            <div class="card-header">
                <button class="btn-add">ADD NEW</button>  
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
                        <th>Direction</th>
                        <th>CALL TO:</th>
                        <th>SMS TO:</th>
                        <th>Date
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
                        <td><?= $sim['direction'] ?></td>
                        <td><?= $sim['call_to'] ?></td>
                        <td><?= $sim['sms_to'] ?></td>
                        <td><?= $sim['date'] ?></td>

                        
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
    
  // 🔍 PARTIAL MATCH (typing)
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


// 🎯 EXACT MATCH (button click)
document.getElementById("searchBtn").addEventListener("click", function () {
    let value = document.getElementById("searchInput").value.toLowerCase().trim();
    let rows = document.querySelectorAll("#tableBody tr");

    rows.forEach(function(row) {
        let simCell = row.querySelector(".sim-number");
        if (!simCell) return;

        let sim = simCell.textContent.toLowerCase().trim();

        row.style.display = (sim === value) ? "" : "none";
    });
});
    </script>
</body>



<?php include(APPPATH.'Views/layout/footer.php'); ?>