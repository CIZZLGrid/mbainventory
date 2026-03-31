<?php include(APPPATH.'Views/layout/header.php'); ?>
<?php include(APPPATH.'Views/layout/sidebar.php'); ?>

<div class="main">
    <div class="card">
        <h3>EDIT SIM CARD</h3>

        <div class="card-body">
            <form class="form-container" method="post" action="<?= base_url('users/update_sim/' . $sims['id']) ?>">

                <div class="form-group">
                    <label>Sim Card Slot on Gateway</label>
                    <input type="text" name="sim_gateway" class="form-control" value="<?= $sims['sim_gateway'] ?>">
                </div>

                <div class="form-group">
                    <label>Sim Card ID (Account No)</label>
                    <input type="text" name="sim_id" class="form-control" value="<?= $sims['sim_id'] ?>">
                </div>

                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="sim_no" class="form-control" value="<?= $sims['sim_no'] ?>">
                </div>

                <div class="form-group">
                    <label>Direction</label>
                    <input type="text" name="direction" class="form-control" value="<?= $sims['direction'] ?>">
                </div>

                <div class="form-group">
                    <label>Call To</label>
                    <input type="text" name="call_to" class="form-control" value="<?= $sims['call_to'] ?>">
                </div>

                <div class="form-group">
                    <label>SMS To</label>
                    <input type="text" name="sms_to" class="form-control" value="<?= $sims['sms_to'] ?>">
                </div>

                <div class="form-group full">
                    <label>Operator</label>
                    <select name="operator" class="form-control">
                        <option value="GLOBE">GLOBE</option>
                        <option value="SMART">SMART</option>
                    </select>
                </div>

                <div class="form-group full">
                    <button type="submit" class="btn-add">Edit SMART/GLOBE Sim</button>
                </div>

            </form>
        </div>
    </div>
</div>


<?= $this->include('layout/footer') ?>