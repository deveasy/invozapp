<?php
    $data = array('title'=>'Add Product');
    $this->load->view('tpl/side_top',$data);
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Product <a href="<?php echo base_url(); ?>index.php/products" class="btn btn-primary">View All Products</a> <a href="#" class="btn btn-default">Import Products</a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Product
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php echo validation_errors(); ?>
                                <div class="col-lg-6 col-md-6">
                                    <?php
                                        $attributes = array('role'=>'form');
                                        echo form_open_multipart('products/add_product'); 
                                    ?>
                                        <div class="form-group">
                                            <label>Product Code</label>
                                            <input class="form-control" name="product_code" placeholder="Enter Product Code" value="<?php echo $product_code ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input class="form-control" name="product_name" placeholder="Enter Product Name" value="<?php echo set_value('product_name') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <input type="file" name="product_image">
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="product_category">
                                                <?php
                                                    foreach($categories as $category){
                                                        echo '<option value="'.$category->category_name.'">'.$category->category_name.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Description</label>
                                            <textarea class="form-control" rows="4" name="description"><?php echo set_value('description'); ?></textarea>
                                        </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->

                                <div class="col-lg-6 col-md-6">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">¢</span>
                                            <input type="text" class="form-control" name="unit_price" placeholder="Unit Price" value="<?php echo set_value('unit_price'); ?>">
                                            <span class="input-group-addon">.00</span>
                                        </div>
                                        <div class="form-group">
                                            <label>Re-Order Level</label>
                                            <input class="form-control" name="reorder_level" placeholder="Enter re-order level" value="<?php echo set_value('reorder_level'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Add Product to Location:</label>
                                            <select class="form-control" name="add_option">
                                                <option value="all">All Locations</option>
                                                <?php 
                                                    foreach($locations as $location){
                                                        echo '<option value="'.$location->location_id.'">'.$location->location_name.'</option>';
                                                    }
                                                ?>
                                            </select>
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