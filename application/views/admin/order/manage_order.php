<?php
$info = $this->session->userdata('business_info');
if(!empty($info->currency))
{
    $currency = $info->currency ;
}else
{
    $currency = '$';
}
?>
<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">管理訂單</h3>
                    <div class="box-tools">
                        <a onclick="print_invoice('printableArea')" class="btn btn-default">列印</a>

                    </div>
                </div>



                <div class="box-body">

                    <div id="printableArea">

                        <!-- Table -->
                        <table class="table table-bordered table-striped" id="dataTables-example">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">Sl</th>
                                <th class="active">訂單編號</th>
                                <th class="active">訂單日期</th>
                                <th class="active">訂單狀態</th>
                                <th class="active">訂單總計</th>
                                <th class="active">銷售人</th>
                                <th class="active">動作</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php if (!empty($order)): foreach ($order as $v_order) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td">ORD-<?php echo $v_order->order_no ?></td>
                                    <td class="vertical-td"><?php echo date('Y-m-d', strtotime($v_order->order_date ))?></td>
                                    <td class="vertical-td">
                                        <?php
                                          if($v_order->order_status == 0){
                                              echo 'Pending Order';
                                          }elseif($v_order->order_status == 1){
                                              echo 'Cancel Order';
                                        }else{
                                            echo 'Confirm Order';
                                        }
                                        ?>
                                    </td>
                                    <td class="vertical-td"><?php echo $currency .' '. number_format($v_order->grand_total,2)  ?></td>
                                    <td class="vertical-td"><?php echo $v_order->sales_person ?></td>

                                    <td class="vertical-td">
                                        <?php echo btn_edit('admin/order/view_order/' . $v_order->order_no); ?>

                                    </td>

                                </tr>
                            <?php
                                $counter++;
                            endforeach;
                            ?><!--get all sub category if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                                <td colspan="6">
                                    <strong>目前沒有資料顯示</strong>
                                </td><!--/ get error message if this empty-->
                            <?php endif; ?>
                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->
                        </div>

                </div><!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>




