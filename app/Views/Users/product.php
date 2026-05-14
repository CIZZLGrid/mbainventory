<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<?php
    $request = service('request');
    $queryString = $request->getServer('QUERY_STRING');

    $returnUrl = current_url();

    if (!empty($queryString)) {
        $returnUrl .= '?' . $queryString;
    }
?>

<body>
    <div class="main">

    <div class="inventory-card">
    <!-- HEADER -->
        <div class="inventory-header">

            <div class="inventory-title">
                <h2>SIM Card Inventory</h2>
                <p>Manage SIM numbers, gateways, IP addresses, and active plans.</p>
            </div>

            <div class="inventory-actions">
                <a href="<?= base_url('/users/export') ?>" class="btn-action btn-export">
                    <i class="fa fa-file-excel"></i>
                    Export Excel
                </a>

                <button 
                    type="submit" 
                    form="bulkForm" 
                    class="btn-action btn-delete-selected"
                    onclick="return confirm('Delete selected rows?')"
                >
                    <i class="fa fa-trash"></i>
                    Delete Selected
                </button>
            </div>

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

            <span class="toolbar-hint">
                Use the column filters to narrow the table results.
            </span>
        </div>

        <!-- TABLE WRAPPER (NEW) -->
        <div class="table-wrapper">
            <form id="bulkForm" method="POST" action="<?= base_url('users/deleteSelected') ?>">
            <?= csrf_field() ?>

            <table class="product-table">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th>Slot</th>
                        <th>SIM ID</th>
                        <th>Mobile Number</th>

                        <th>
                            Operator<br>
                            <select id="operatorFilter">
                                <option value="all">ALL</option>
                                <option value="globe">GLOBE</option>
                                <option value="smart">SMART</option>
                            </select>
                        </th>

                        <th>
                            Gateway<br>
                            <select id="gatewayFilter" >
                                <option value="all">ALL</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                            </select>
                        </th>

                        <th>
                            IP<br>
                            <select id="ipFilter">
                                <option value="all">ALL</option>
                                <option value="10.23.144.45">10.23.144.45</option>
                                <option value="10.23.144.46">10.23.144.46</option>
                                <option value="10.23.144.47">10.23.144.47</option>
                                <option value="10.23.144.48">10.23.144.48</option>
                                <option value="10.23.144.49">10.23.144.49</option>
                                <option value="10.23.144.50">10.23.144.50</option>
                                <option value="10.23.144.51">10.23.144.51</option>
                                <option value="10.23.144.52">10.23.144.52</option>
                                <option value="10.23.144.53">10.23.144.53</option>
                                <option value="10.23.144.54">10.23.144.54</option>
                                <option value="10.23.144.55">10.23.144.55</option>
                                <option value="10.23.144.56">10.23.144.56</option>
                                <option value="10.23.144.57">10.23.144.57</option>
                                <option value="10.23.144.58">10.23.144.58</option>
                                <option value="10.23.144.59">10.23.144.59</option>
                                <option value="10.23.144.68">10.23.144.68</option>
                                <option value="10.23.144.69">10.23.144.69</option>
                                <option value="10.23.144.60">10.23.144.60</option>
                                <option value="10.23.144.70">10.23.144.70</option>
                                <option value="10.23.144.71">10.23.144.71</option>
                                <option value="10.23.144.72">10.23.144.72</option>
                                <option value="10.23.144.73">10.23.144.73</option>
                                <option value="10.23.144.74">10.23.144.74</option>
                                <option value="10.23.144.75">10.23.144.75</option>
                                <option value="10.23.144.76">10.23.144.76</option>
                                <option value="10.23.144.77">10.23.144.77</option>
                                <option value="10.23.144.78">10.23.144.78</option>

                            </select>
                        </th>

                        <th>
                            Status<br>
                            <select id="statusFilter">
                                <option value="all">ALL</option>
                                <option value="active">ACTIVE</option>
                                <option value="inactive">INACTIVE</option>
                            </select>
                        </th>

                        <th>Call</th>
                        <th>SMS</th>

                        <th>
                            Date<br>
                            <input type="date" id="dateFilter">
                        </th>

                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody id="tableBody">

                    <?php foreach($sims as $sim): ?>
                    <tr>
                        <td>
                            <input 
                                type="checkbox" 
                                name="selected_ids[]" 
                                value="<?= $sim['id'] ?>" 
                                class="rowCheckbox"
                            >
                        </td>
                        <td><?= $sim['sim_gateway'] ?></td>
                        <td><?= $sim['sim_id'] ?></td>

                        <!-- HIGHLIGHT IMPORTANT -->
                        <td class="sim-number"><?= $sim['sim_no'] ?></td>

                        <td class="operator"><?= $sim['operator'] ?></td>
                        <td class="gateway"><?= $sim['gateway'] ?></td>
                        <td class="ip-address"><?= $sim['ip_address'] ?></td>

                        <!-- STATUS BADGE -->
                        <td class="status">
                            <span class="status-badge <?= strtolower($sim['plan']) === 'active' ? 'status-active' : 'status-inactive' ?>">
                                <?= $sim['plan'] ?>
                            </span>
                        </td>

                        <td><?= $sim['call_to'] ?></td>
                        <td><?= $sim['sms_to'] ?></td>

                        <td class="date"><?= $sim['date'] ?></td>

                        <td>
                            <a class="btn-edit" href="<?= base_url('users/edit_sim/'. $sim['id']) ?>">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="btn-delete" href="<?= base_url('users/delete/'. $sim['id']) ?>" onclick="return confirm('Are you sure you want to delete this row?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            </form>
        </div>
    </div>
</div>

    <script>
function updateSelectAllState() {
    let selectAll = document.getElementById("selectAll");

    let visibleCheckboxes = Array.from(document.querySelectorAll("#tableBody tr"))
        .filter(row => row.style.display !== "none")
        .map(row => row.querySelector(".rowCheckbox"))
        .filter(checkbox => checkbox !== null);

    if (visibleCheckboxes.length === 0) {
        selectAll.checked = false;
        return;
    }

    selectAll.checked = visibleCheckboxes.every(checkbox => checkbox.checked);
}

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
        let status = row.querySelector(".status")?.textContent.toLowerCase().trim();
        let rowDate = row.querySelector(".date")?.textContent.trim();

        let matchOperator = (operatorSelected === "all" || operator === operatorSelected);
        let matchGateway = (gatewaySelected === "all" || gateway === gatewaySelected);
        let matchIP = (ipSelected === "all" || ip === ipSelected);
        let matchStatus = (statusSelected === "all" || status === statusSelected);
        let matchSearch = (!searchValue || sim.includes(searchValue));
        let matchDate = (!selectedDate || rowDate === selectedDate);

        if (matchOperator && matchGateway && matchIP && matchStatus && matchSearch && matchDate) {
            row.style.display = "";
        } else {
            row.style.display = "none";

            let checkbox = row.querySelector(".rowCheckbox");
            if (checkbox) {
                checkbox.checked = false;
            }
        }
    });

    updateSelectAllState();
}

document.getElementById("selectAll").addEventListener("change", function () {
    let rows = document.querySelectorAll("#tableBody tr");

    rows.forEach(function(row) {
        if (row.style.display !== "none") {
            let checkbox = row.querySelector(".rowCheckbox");

            if (checkbox) {
                checkbox.checked = document.getElementById("selectAll").checked;
            }
        }
    });
});

document.querySelectorAll(".rowCheckbox").forEach(function(checkbox) {
    checkbox.addEventListener("change", updateSelectAllState);
});

document.getElementById("operatorFilter").addEventListener("change", applyFilters);
document.getElementById("gatewayFilter").addEventListener("change", applyFilters);
document.getElementById("ipFilter").addEventListener("change", applyFilters);
document.getElementById("statusFilter").addEventListener("change", applyFilters);
document.getElementById("searchInput").addEventListener("keyup", applyFilters);
document.getElementById("dateFilter").addEventListener("change", applyFilters);
</script>
</body>



<?php include(APPPATH.'Views/layout/footer.php'); ?>