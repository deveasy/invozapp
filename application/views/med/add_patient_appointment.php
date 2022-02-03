<?php
$data = array('title'=>'Add Patient Appointment');
$this->load->view('tpl/side_top',$data);
?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Patient Appointment <button class="btn btn-primary" onclick="goBack()">Back</button></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Demography</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <?php echo validation_errors(); ?>
                            <div class="col-lg-6 col-md-6">
                                <?php
                                $attributes = array('role'=>'form');
                                echo form_open_multipart('patients/add_appointment/'.$patient_id);
                                ?>
                                <div class="form-group">
                                    <label>Patient ID</label>
                                    <input class="form-control" value="<?php echo $patient_id ?>" disabled />
                                    <input type="hidden" name="patient_id" value="<?php echo $patient_id ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Appointment Date</label>
                                    <input class="form-control" type="text" name="appointment_date" placeholder="Appointment date" value="<?php echo set_value('appointment_date') ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Reason</label>
                                    <textarea class="form-control" placeholder="Reason" name="reason">
                                        <?php echo set_value('reason') ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea class="form-control" placeholder="Note" name="note">
                                        <?php echo set_value('note') ?>
                                    </textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <button type="reset" class="btn btn-default" name="reset">Reset</button>
                                </form>
                            </div>
                            <!-- /.col-lg-6 (nested) -->

                            <div class="col-lg-6 col-md-6">

                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-8 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

<?php $this->load->view('tpl/foot');