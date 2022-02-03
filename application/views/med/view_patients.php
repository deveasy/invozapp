
<?php
    $data = array('title'=>'View Patients');
    $this->load->view('tpl/side_top',$data);
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Patient Management <a href="<?php echo base_url(); ?>index.php/patients/new_patient" class="btn btn-primary">+ Add New Patient</a> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Patients
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Country</th>
                                        <th>City/Village</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(!empty($patients)){
                                            foreach($patients as $patient){
                                                echo '<tr>';
                                                echo '<td>'.$patient->patient_id . '</td>';
                                                echo '<td><a href="'.base_url().'index.php/patients/view_patient/'.$patient->patient_id.'">' . $patient->firstname . ' ' . $patient->middlename . ' ' . $patient->lastname . '</a></td>';
                                                echo '<td>'.$patient->country.'</td>';
                                                echo '<td>'.$patient->city_village.'</td>';
                                                echo '<td>'.$patient->phone.'</td>';
                                                echo '<td>'.$patient->email.'</td>';
                                                echo '<td>
                                                        <a href="'. base_url() .'index.php/patients/view_patient/'.$patient->patient_id.'"><i class="fa fa-gear" title="edit"></i></a> &nbsp;&nbsp;
                                                        <a href="'.base_url().'index.php/patients/delete_patient/'.$patient->patient_id.'"><i class="fa fa-trash-o delete-staff" title="delete"></i></a>
                                                    </td>';
                                                echo '</tr>';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

<?php $this->load->view('tpl/foot');