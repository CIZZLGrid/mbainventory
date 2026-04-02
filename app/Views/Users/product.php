<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<body>
    <div class="main">

        <div class="card">

            <div class="card-header">
                <button class="btn-add">ADD NEW</button>    
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
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="tableBody">

                    <?php foreach($sims as $sim): ?>
                    <tr>
                        <td><?= $sim['sim_gateway'] ?></td>
                        <td><?= $sim['sim_id'] ?></td>
                        <td><?= $sim['sim_no'] ?></td>
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
    </script>
</body>



<?php include(APPPATH.'Views/layout/footer.php'); ?>