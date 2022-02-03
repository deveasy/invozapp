
<?php
    $data = array('title'=>'Patient Management');
    $this->load->view('tpl/side_top',$data);
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Patient Management <a href="#add-new-staff" class="btn btn-primary">+ Add New Staff</a> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Patient Details
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
                                if(!empty($patient)){
                                    echo '<h3>'.$patient->firstname.'</h3> '.$patient->lastname.'&nbsp;&nbsp;'.$patient->gender.' ('.$patient->birthdate.') <em>'.$patient->phone.'</em>';
                                }
                                
                            ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Diagnoses</h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <strong>No recent diagnoses</strong>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Recent Visits</h4>
                        </div>
                        <div class="panel-body">
                            <strong>No recent visits yet</strong>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Patient Vitals</h4>
                        </div>
                        <div class="panel-body">
                            <strong>No vitals yet</strong>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
            

        </div>
        <!-- /#page-wrapper -->

<?php $this->load->view('tpl/foot');