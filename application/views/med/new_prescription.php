<?php
$data = array('title'=>'Add Prescription');
$this->load->view('tpl/side_top',$data);
?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Prescription</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>New Prescription</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <?php echo validation_errors(); ?>
                            <div class="col-lg-6 col-md-6">
                                <!-- <form> -->
                                <div class="form-group">
                                    <label>Drug</label>
                                    <input class="form-control" type="text" name="drug" id="medicine" placeholder="Medicine name" list=medicines >
                                    <datalist id="medicines">
                                        <?php
                                            foreach($medicines as $medicine){
                                                echo '<option>'.$medicine->product_name;'</option>';
                                            }
                                        ?>
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <label>Dosage</label>
                                    <input class="form-control" type="text" name="dosage" id="dosage" placeholder="Enter dosage">
                                    <!--<select class="form-control">
                                        <option>24 Hourly</option>
                                        <option>12 Hourly</option>
                                        <option>8 Hourly</option>
                                        <option>6 Hourly</option>
                                        <option>4 Hourly</option>
                                        <option>Nocte</option>
                                    </select>-->
                                </div>
                                <!--<div class="form-group">
                                    <label>Days</label>
                                    <input class="form-control" type="text" name="days" id="days" placeholder="Enter days">
                                </div>-->
                                <button type="submit" class="btn btn-primary" id="add-prescription">Add</button>
                                <!-- </form> -->
                            </div>
                            <!-- /.col-lg-6 (nested) -->

                            <div class="col-lg-6 col-md-6">
                                <h4>Prescription Details</h4>
                                <?php
                                    $attributes = array('role'=>'form');
                                    echo form_open_multipart('patients/add_prescription/'.$patient_id);
                                ?>
                                    <div id="prescription">
                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Save Prescription</button>
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