<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->

<?php $info = $this->session->userdata('business_info'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                    <div class="col-md-offset-3">
                        <h3 class="box-title ">管理賦稅規則</h3>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-background">
                <!-- form start -->
                <form role="form" enctype="multipart/form-data"

                      action="<?php echo base_url(); ?>admin/settings/save_tax/<?php
                      if (!empty($tax->tax_id)) {
                          echo $tax->tax_id;
                      }
                      ?>" method="post">

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">

                            <div class="box-body">

                                <!-- /.tax title -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">標題 <span class="required">*</span></label>
                                    <input type="text" required name="tax_title" placeholder="標題"
                                           value="<?php
                                           if (!empty($tax->tax_title)) {
                                               echo $tax->tax_title;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <!-- /.tax title -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">稅率 <span class="required">*</span></label>
                                    <input type="text" required name="tax_rate" placeholder="稅率"
                                           value="<?php
                                           if (!empty($tax->tax_rate)) {
                                               echo $tax->tax_rate;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <!-- /.Tax type -->
                                <div class="form-group">
                                    <label>稅務類型 <span class="required">*</span></label>
                                    <select name="tax_type" class="form-control col-sm-5">
                                        <option value="">選擇稅務類型</option>
                                        <option value="1" <?php
                                        if(!empty($tax->tax_type)){
                                            echo $tax->tax_type==1 ?'selected':'';
                                        } ?>>百分比 (%)</option>

                                        <option value="2" <?php

                                        if(!empty($tax->tax_type)){
                                            echo $tax->tax_type==1 ?'selected':'';
                                        }

                                        ?>>Fixed (
                                            <?php  if(!empty($info->currency))
                                            {
                                                echo $info->currency ;
                                            }else
                                            {
                                                echo '$';
                                            } ?>
                                            )
                                        </option>
                                    </select>
                                </div><br/><br/>

                                <button type="submit" class="btn bg-navy" type="submit">儲存賦稅規則
                                </button>
                            </div>
                            <!-- /.box-body -->

                        </div>
                    </div>

                </form>
                    </div>
                <div class="box-footer">

                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                <table class="table table-bordered table-striped" id="dataTables-example">
                    <thead>
                    <tr>
                        <th class="active">SL</th>
                        <th class="active">稅務名稱</th>
                        <th class="active">稅務比率</th>
                        <th class="active">稅務類型</th>
                        <th class="col-sm-2 active">動作</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $key = 1 ?>
                    <?php if (!empty($tax_info)): foreach ($tax_info as $v_tax_info) : ?>
                        <tr>
                            <td><?php echo $key ?></td>
                            <td><?php echo $v_tax_info->tax_title ?></td>
                            <td><?php echo $v_tax_info->tax_rate ?></td>
                            <td>
                                <?php if($v_tax_info->tax_type == 1) { ?>
                                % (Parentage)
                                <?php }else{ ?>
                                Flat Rate (Fixed)
                                <?php } ?>
                            </td>
                            <td>
                                <?php echo btn_edit('admin/settings/tax/' . $v_tax_info->tax_id); ?>
                                <?php echo btn_delete('admin/settings/delete_tax/' . $v_tax_info->tax_id); ?>
                            </td>

                        </tr>
                    <?php
                    $key++;
                    endforeach;
                    ?><!--get all category if not this empty-->
                    <?php else : ?> <!--get error message if this empty-->
                        <td colspan="5">
                            <strong>目前沒有資料顯示</strong>
                        </td><!--/ get error message if this empty-->
                    <?php
                    endif; ?>
                    </tbody>
                </table>

                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>



