
<?php
    $data = array('title'=>'View Appointments');
    $this->load->view('tpl/side_top',$data);
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Patient Appointments <a href="<?php echo base_url(); ?>index.php/patients/new_appointment" class="btn btn-primary">+ New Appointment</a> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Appointments
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Country</th>
                                        <th>City/Village</th>
                                        <th>Phone Number</th>
                                        <th>Reason</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(!empty($appointments)){
                                            foreach($appointments as $appointment){
                                                echo '<tr>';
                                                echo '<td>' . $appointment->firstname . ' ' . $appointment->middlename . ' ' . $appointment->lastname . '</td>';
                                                echo '<td>'.$appointment->country.'</td>';
                                                echo '<td>'.$appointment->city_village.'</td>';
                                                echo '<td>'.$appointment->reason.'</td>';
                                                echo '<td>'.$appointment->note.'</td>';
                                                echo '<td>
                                                        <a href=""><i class="fa fa-gear" title="edit"></i></a> &nbsp;&nbsp;
                                                        <a href="#"><i class="fa fa-trash-o delete-staff" title="delete"></i></a>
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