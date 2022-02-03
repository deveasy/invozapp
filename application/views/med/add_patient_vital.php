<?php
$data = array('title'=>'Add Patient Vitals');
$this->load->view('tpl/side_top',$data);
?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Patient Vitals <button class="btn btn-primary" onclick="goBack()">Back</button></h1>
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
                                echo form_open_multipart('patients/add_patient_vitals/'.$patient_id);
                                ?>
                                <div class="form-group">
                                    <label>Patient ID</label>
                                    <input class="form-control" value="<?php echo $patient_id ?>" disabled />
                                    <input type="hidden" name="patient_id" value="<?php echo $patient_id ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Height </label>
                                    <input class="form-control" type="text" name="height" placeholder="Patient's height" value="<?php echo set_value('height') ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Weight</label>
                                    <input class="form-control" type="text" name="weight" placeholder="Patient's weight" value="<?php echo set_value('weight') ?>" />
                                </div>
                                <div class="form-group">
                                    <label>BMI</label>
                                    <input class="form-control" type="text" name="bmi" placeholder="Patient's BMI" value="<?php echo set_value('bmi') ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Temperature</label>
                                    <input class="form-control" type="text" name="temperature" placeholder="Current temperature" value="<?php echo set_value('temperature'); ?>" />
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->

                            <div class="col-lg-6 col-md-6">

                                <div class="form-group">
                                    <label>Pulse</label>
                                    <input class="form-control" type="text" name="pulse" placeholder="Patient's pulse" value="<?php echo set_value('pulse'); ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Respiratory Rate</label>
                                    <input class="form-control" type="text" name="respiratory_rate" placeholder="Patient's respiratory rate" value="<?php echo set_value('respiratory_rate'); ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Blood Pressure</label>
                                    <input class="form-control" type="text" name="blood_pressure" placeholder="Patient's blood pressure" value="<?php echo set_value('blood_pressure'); ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Blood Oxygen</label>
                                    <input class="form-control" type="text" name="blood_oxygen" placeholder="Patient's blood oxygen" value="<?php echo set_value('blood_oxygen'); ?>" />
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <button type="reset" class="btn btn-default" name="reset">Reset</button>
                                </form>
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