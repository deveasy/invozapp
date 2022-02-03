<?php
    $data = array('title'=>'Add New Patient');
    $this->load->view('tpl/side_top',$data);
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Patient <button class="btn btn-primary" onclick="goBack()">Back</button></h1>
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
                                        echo form_open_multipart('patients/add_new_patient/', $attributes);
                                    ?>
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" type="text" name="firstname" placeholder="Enter First Name" value="<?php echo set_value('firstname') ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input class="form-control" type="text" name="middlename" placeholder="Enter Middle Name" value="<?php echo set_value('middlename') ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" type="text" name="lastname" placeholder="Enter Last Name" value="<?php echo set_value('lastname') ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <input type="radio" name="gender" value="MALE" /> Male
                                            <input type="radio" name="gender" value="FEMALE" /> Female
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="form-control" type="text" name="address1" value="<?php echo set_value('address1'); ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control" type="text" name="birthdate" value="<?php echo set_value('birthdate'); ?>" />
                                        </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->

                                <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input class="form-control" type="text" name="city" value="<?php echo set_value('city'); ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select class="form-control" name="country">
                                                <option>Select Country</option>
                                                <option value="Ghana">Ghana</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input class="form-control" type="text" name="phone" value="<?php echo set_value('phone'); ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>E-Mail</label>
                                            <input class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>" />
                                        </div>
                                        <!--<div class="form-group">
                                            <label>Relation:</label>
                                            <select class="form-control" name="relation">
                                                <option>Select Relation</option>
                                                <option value="Mother">Mother</option>
                                                <option value="Father">Father</option>
                                                <option value="Sister">Sister</option>
                                                <option value="Brother">Brother</option>
                                                <option value="Aunty">Aunty</option>
                                                <option value="Uncle">Uncle</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" name="relation_name" placeholder="Enter relative's name" value="<?php //echo set_value('relation_name'); ?>">
                                        </div>-->
                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                        <button type="reset" class="btn btn-default" name="reset">Cancel</button>
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