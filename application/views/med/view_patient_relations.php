
<?php
    $data = array('title'=>'Patient Relatives');
    $this->load->view('tpl/side_top', $data);
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Patient Relatives <a href="#add-new-staff" class="btn btn-primary">+ Add New Relation</a> </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Relatives
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Relation</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(!empty($relations)){
                                            foreach($relations as $relation){
                                                echo '<tr id="' . $relation->patient_id . '">';
                                                echo '<td>' . $relation->relation . '</td>';
                                                echo '<td>' . $relation->name . '</td>';
                                                echo '<td>' . $relation->phone . '</td>';
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