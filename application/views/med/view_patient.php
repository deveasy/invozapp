
<?php
    $data = array('title'=>'Patient View');
    $this->load->view('tpl/side_top',$data);
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Patient View <button class="btn btn-primary back-button">Back</button></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Patient Details</h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
                                if(!empty($patient)){
                                    echo '<h4>'. $patient->firstname .' '.$patient->lastname.', '.$patient->birthdate.', '.$patient->gender.', <em>'.$patient->phone.'</em>, '.$patient->email.'</h4>';
                                }
                                if(!empty($prescriptions)){
                                    foreach($prescriptions as $prescription){
                                        echo '<p><a href="'.base_url().'index.php/patients/view_prescription/'.$prescription->prescription_id.'">Prescription on '. $prescription->prescription_date.'</a></p>'; 
                                    }
                                }
                                else{
                                    echo '<h5><strong><a href="'.base_url().'index.php/patients/new_prescription/'.$patient->patient_id.'">Create new prescription</a></strong></h5>';
                                }
                            ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /. patient details -->

                <div class="col-lg-6">
                    <!-- Laboratory Investigations -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Laboratory Investigaions</h4>
                        </div>
                        <div class="panel-body">
                            <?php
                            if(!empty($lab_tests)){
                                foreach($lab_tests as $test){
                                    echo '<p><strong>'.$test->test.':</strong> '.$test->result.' on '.$test->date_tested;
                                }
                            }
                            ?>
                            <?php
                                $attributes = array('role'=>'form');
                                echo form_open('patients/add_lab_test/'.$patient_id, $attributes);
                            ?>
                                <div class="form-group">
                                    <label>Laboratory Investigaions</label>
                                    <select class="form-control" name="lab-test">
                                        <option></option>
                                        <option value="Malria Test">Malaria test</option>
                                        <option value="Haemoglobin Test">Haemoglobin Test</option>
                                        <option value="Cholestrol Test">Cholestrol Test</option>
                                        <option value="Pregnancy Test">Pregnancy Test</option>
                                        <option value="Hepatitis B Test">Hepatitis B Test</option>
                                        <option value="Typhoid Test">Typhoid Test</option>
                                        <option value="Prostate Specific Antigen Test">Prostate Specific Antigen Test</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Result</label>
                                    <input type="text" class="form-control" name="lab-result" placeholder="Enter result here">
                                </div>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                    <!-- Presenting Complaint -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Presenting Complaint</h4>
                        </div>
                        <div class="panel-body">
                            <?php
                                if(!empty($presenting_complaint)){
                                    echo '<p><em>'. $presenting_complaint->presenting_complaint.'</em></p>';
                                }
                            ?>
                            <?php
                                $attributes = array('role'=>'form');
                                echo form_open('patient/presenting_complaint/'.$patient_id, $attributes);
                            ?>
                                <div class="form-group">
                                    <label>Presenting complaint</label>
                                    <textarea class="form-control" name="presenting_complaint" rows="3"></textarea>
                                </div>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- / presenting complaint -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Recent Vitals</h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
                            if(!empty($vitals)){
                                foreach($vitals as $vital){
                                    //echo '<p>'. $vital->date .'</p>';
                                    echo '<p><strong>Height: </strong>' . $vital->height .'</p>';
                                    echo '<p><strong>Weight: </strong>' . $vital->weight .'</p>';
                                    echo '<p><strong>BMI: </strong>' . $vital->bmi .'</p>';
                                    echo '<p><strong>Temperature: </strong>' . $vital->temperature .'</p>';
                                    echo '<p><strong>Pulse Rate: </strong>' . $vital->pulse .'</p>';
                                    echo '<p><strong>Respiratory Rate: </strong>' . $vital->respiratory_rate .'</p>';
                                    echo '<p><strong>Blood Pressure: </strong>' . $vital->blood_pressure .'</p>';
                                    echo '<p><strong>Blood Oxygen: </strong>' . $vital->blood_oxygen_satur .'</p>';
                                }
                            }
                            else{
                                echo'<strong>No vitals yet</strong>';
                                echo '<p><a href="'.base_url().'index.php/patients/new_vitals/'.$patient_id.'">Add New Vital</a></p>';
                            }
                            ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /. patient vitals -->
            </div>
            <!-- /. patient vitals row -->

            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Diagnoses</h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
                                if(!empty($diagnoses)){
                                    foreach($diagnoses as $diagnosis){
                                        echo '<p>'.$diagnosis->short_desc .'</p>';
                                        echo '&nbsp;';
                                    }
                                    echo '<p><a class="btn btn-default" href="'.base_url().'index.php/patients/new_diagnosis/'.$patient_id.'">Add New Diagnoses</a></p>';
                                }
                                else{
                                    echo '<strong>No recent diagnoses</strong>';
                                    echo '<p><a class="btn btn-default" href="'.base_url().'index.php/patients/new_diagnosis/'.$patient_id.'">Add New Diagnoses</a></p>';
                                }
                            ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /. diagnoses panel -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Allergies</h4>
                        </div>
                        <div class="panel-body">
                            <?php
                            if(!empty($allergies)){
                                foreach($allergies as $allergy){
                                    echo '<p>'. $allergy->date .'</p>';
                                }
                            }
                            else{
                                echo'<strong>No allergy yet</strong>';
                                echo '<p><a class="btn btn-default" href="'.base_url().'index.php/patients/new_allergy/'.$patient_id.'">Add New Allergy</a></p>';
                            }
                            ?>
                        </div>
                    </div>
                    <!-- allergies panel -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Relations</h4>
                        </div>
                        <div class="panel-body">
                            
                            <?php
                                if(!empty($relations)){
                                    foreach($relations as $relation){
                                        echo '<p><strong>'. strtoupper($relation->relation) . ': </strong>' . strtoupper($relation->name) .'</p>';
                                    }
                                    echo '<p><a class="btn btn-default" href="'.base_url().'index.php/patients/new_vitals/'.$patient_id.'">Add New Relation</a></p>';
                                }
                                else{
                                    echo'<strong>No relations yet</strong>';
                                    echo '<p><a class="btn btn-default" href="'.base_url().'index.php/patients/new_vitals/'.$patient_id.'">Add New Relation</a></p>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Appointments</h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
                                if(!empty($appointments)){
                                    foreach($appointments as $appointment){
                                        echo '<p>'. $appointment->date .'</p>';
                                    }
                                }
                                else{
                                    echo'<strong>No recent appointments</strong>';
                                    echo '<p><a class="btn btn-default" href="'.base_url().'index.php/patients/new_appointment/'.$patient_id.'">Add New Appointment</a></p>';
                                }
                            ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Latest Observations</h4>
                        </div>
                        <div class="panel-body">
                            <?php
                                if(!empty($observations)){
                                    foreach($observations as $observation){
                                        echo '<p>'. $observation->date .'</p>';
                                    }
                                }
                                else{
                                    echo'<strong>No observations yet</strong>';
                                    echo '<p><a class="btn btn-default" href="'.base_url().'index.php/patients/new_observation/'.$patient_id.'">Add New Observation</a></p>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Medical Conditions</h4>
                        </div>
                        <div class="panel-body">
                            <?php
                                if(!empty($conditions)){
                                    foreach($conditions as $condition){
                                        echo '<p>'. $condition->date .'</p>';
                                    }
                                }
                                else{
                                    echo'<strong>No medical condition yet</strong>';
                                    echo '<p><a class="btn btn-default" href="'.base_url().'index.php/patients/new_condition/'.$patient_id.'">Add New Condition</a></p>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Health Trend Summary</h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <strong>No summary yet</strong>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Weight Graph</h4>
                        </div>
                        <div class="panel-body">
                            <strong>No data yet</strong>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Recent Visits</h4>
                        </div>
                        <div class="panel-body">
                            <?php
                            if(!empty($visits)){
                                foreach($visits as $visit){
                                    echo '<p>'. $visit->date .'</p>';
                                }
                            }
                            else{
                                echo'<strong>No recent visits yet</strong>';
                                echo '<p><a class="btn btn-default" href="'.base_url().'index.php/patients/new_visit/'.$patient_id.'">Add New Visit</a></p>';
                            }
                            ?>
                        </div>
                    </div>
                    <!-- recent visits panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

<?php $this->load->view('tpl/foot');