
<?php
$data = array('title'=>'Patient Prescriptions');
$this->load->view('tpl/side_top',$data);
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Patient Prescriptions</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Prescription Details
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php
                        $i = 1;
                        foreach($prescription_details as $detail){
                            echo '<p><strong>'. $i . '. ' . $detail->medicine . '</strong></p>';
                            echo '<p>' . $detail->dosage . '</p>';
                            $i++;
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

</div>
<!-- /#page-wrapper -->

<?php $this->load->view('tpl/foot');