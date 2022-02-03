
<?php
    $data = array('title'=>'Patient View');
    $this->load->view('tpl/side_top',$data);
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Patient View <button class="btn btn-primary back-button">Back</button></h2>
                </div>
                <!-- /heading column -->
            </div>
            <!-- /. heading row -->
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">Presenting Complaint</a></li>
              <li><a data-toggle="tab" href="#menu1">Lab Investingations</a></li>
              <li><a data-toggle="tab" href="#menu2">Vitals</a></li>
              <li><a data-toggle="tab" href="#menu3">Diagnoses</a></li>
              <li><a data-toggle="tab" href="#menu4">Allergies</a></li>
              <li><a data-toggle="tab" href="#menu5">Observations &amp; Conditions</a></li>
            </ul>

            <!-- Tabbed content start -->
            <form method="POST" action="">
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h4>Presenting Complaint</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-5">
                                <?php
                                    if(!empty($presenting_complaint)){
                                        echo '<p><em>'. $presenting_complaint->presenting_complaint.'</em></p>';
                                    }
                                ?>
                                <div class="form-group">
                                    <label>Complaint</label>
                                    <textarea class="form-control" name="presenting_complaint" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h4>Lab Investigations</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-5">
                                <?php
                                    if(!empty($lab_tests)){
                                        foreach($lab_tests as $test){
                                            echo '<p><strong>'.$test->test.':</strong> '.$test->result.' on '.$test->date_tested;
                                        }
                                    }
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
                            </div>
                        </div>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h4>Vitals</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-5">
                                <?php
                                if(!empty($vitals)){
                                    foreach($vitals as $vital){
                                        //echo '<p>'. $vital->date .'</p>';
                                        echo '<span class="form-inline"><p><strong>Height: </strong><input type="text" class="form-control" value="' . $vital->height .'"></p></span>';
                                        echo '<span class="form-inline"><p><strong>Weight: </strong><input type="text" class="form-control" value="' . $vital->weight .'"></p></span>';
                                        echo '<span class="form-inline"><p><strong>BMI: </strong><input type="text" class="form-control" value="' . $vital->bmi .'"></p></span>';
                                        echo '<span class="form-inline"><p><strong>Temperature: </strong><input type="text" class="form-control" value="' . $vital->temperature .'"></p></span>';
                                        echo '<span class="form-inline"><p><strong>Pulse Rate: </strong><input type="text" class="form-control" value="' . $vital->pulse .'"></p></span>';
                                        echo '<span class="form-inline"><p><strong>Respiratory Rate: </strong><input type="text" class="form-control" value="' . $vital->respiratory_rate .'"></p></span>';
                                        echo '<span class="form-inline"><p><strong>Blood Pressure: </strong><input type="text" class="form-control" value="' . $vital->blood_pressure .'"></p></span>';
                                        echo '<span class="form-inline"><p><strong>Blood Oxygen: </strong><input type="text" class="form-control" value="' . $vital->blood_oxygen_satur .'"></p></span>';
                                    }
                                }
                                else{
                                    echo'<strong>No vitals yet</strong>';
                                    echo '<p><a href="'.base_url().'index.php/patients/new_vitals/'.$patient_id.'">Add New Vital</a></p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <h4>Diagnoses</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-5">
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
                        </div>
                    </div>
                    <div id="menu4" class="tab-pane fade">
                        <h4>Allergies</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-5">
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
                    </div>
                    <div id="menu5" class="tab-pane fade">
                        <h4>Latest Observations</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-5">
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
                </div>
                <!-- Tabbed content end -->
                <hr>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- /#page-wrapper -->

<?php $this->load->view('tpl/foot');