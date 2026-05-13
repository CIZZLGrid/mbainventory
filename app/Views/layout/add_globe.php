<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<div class="main">
    <div class="sim-form-card">
        <h3>ADD GLOBE SIM CARD</h3>

        <div class="card-body">
            <form class="form-container" method="post" action="<?= base_url('users/add_globe') ?>">

                <div class="form-group">
                    <label>Sim Card Slot on Gateway</label>
                    <input type="text" name="sim_gateway" class="form-control">
                </div>

                <div class="form-group">
                    <label>Sim Card ID (Account No)</label>
                    <input type="text" name="sim_id" class="form-control">
                </div>

                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="sim_no" class="form-control">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <input type="text" name="plan" class="form-control">
                </div>

                <div class="form-group">
                    <label>Call To</label>
                    <input type="text" name="call_to" class="form-control">
                </div>

                <div class="form-group">
                    <label>SMS To</label>
                    <input type="text" name="sms_to" class="form-control">
                </div>

                <div class="form-group">
                    <label>Gateway</label>
                    <input type="text" name="gateway" class="form-control">
                </div>

                <div class="form-group">
                    <label>IP Address</label>
                    <input type="text" name="ip_address" class="form-control">
                </div>

                <div class="form-group full">
                    <label>Operator</label>
                    <select name="operator" class="form-control">
                        <option value="GLOBE">GLOBE</option>
                    </select>
                </div>

                <div class="form-group full">
                    <button type="submit" class="btn-add">Add Globe Sim</button>
                </div>

            </form>
        </div>
    </div>
</div>


<?= $this->include('layout/footer') ?>