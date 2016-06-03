<script src="<?php echo base_url(); ?>asset/js/ajax.js" xmlns="http://www.w3.org/1999/html"></script>
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

<?php
//company logo
if(!empty($info->logo)){
    $logo = $info->logo;
}else{
    $logo = 'img/logo.png';
}

//company details
if(!empty($info->company_name)){
    $company_name = $info->company_name;
}else{
    $company_name = '你的公司名稱';
}
//company phone
if(!empty($info->phone)){
    $company_phone = $info->phone;
}else{
    $company_phone = '公司電話';
}
//company email
if(!empty($info->email)){
    $company_email = $info->email;
}else{
    $company_email = '公司Email';
}
//company address
if(!empty($info->address)){
    $address = $info->address;
}else{
    $address = '公司地址';
}



?>

<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">查看訂單</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <div class="box-tools">
                <div class="btn-group" role="group" >
                    <a onclick="print_invoice('printableArea')" class="btn btn-default ">列印</a>

                </div>
            </div>

        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">


        <div id="printableArea">
            <link href="<?php echo base_url(); ?>asset/css/invoice.css" rel="stylesheet" type="text/css" />



            <div class="row ">


            <div class="col-md-8 col-md-offset-2">

                <main>
                    <div id="details" class="clearfix">
                        <div id="client" style="margin-right: 100px">
                            <div class="to">客戶帳單資訊:</div>
                            <h2 class="name"><?php echo $order_info->customer_name ?></h2>
                            <div class="address"><?php echo $order_info->customer_address ?></div>
                            <div class="address"><?php echo $order_info->customer_phone ?></div>
                            <div class="email"><?php echo $order_info->customer_email ?></div>
                        </div>


                        <div id="invoice">
                            <h1>訂單 <?php echo $order_info->order_no ?></h1>
                            <div class="date">訂單日期: <?php echo date('Y-m-d', strtotime($order_info->order_date))  ?></div>
                            <div class="date">銷售人: <?php echo $order_info->sales_person ?></div>

                            <?php if($order_info->order_status == 0){ ?>
                                <form method="post" action="<?php echo base_url()?>admin/order/order_re_confirmation">
                                <!-- pending Order-->
                                <div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">訂單狀態</label>

                                        <div class="col-sm-7">
                                            <select name="order_status" class="form-control" id="order_confirmation">
                                                <option value="2" <?php echo $order_info->order_status ==2? 'selected':''?>>已確認</option>
                                                <option value="1" <?php echo $order_info->order_status ==1? 'selected':''?> >已取消</option>
                                                <option value="0" <?php echo $order_info->order_status ==0? 'selected':''?>>尚未確認</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div style="display: none" id="payment_method_block">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">付款方式</label>

                                        <div class="col-sm-7">
                                            <select name="payment_method" class="form-control" id="order_payment_type">
                                                <option value="cash">現金付款</option>
                                                <option value="cheque">支票\轉帳付款</option>
                                                <option value="card">信用卡付款</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div style="display: none" id="payment">
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label">支票\轉帳\信用卡 資訊</label>

                                        <div class="col-sm-7">
                                            <input type="text" name="payment_ref" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                    <input type="hidden" name="order_id" value="<?php echo $order_info->order_id ?>">
                                    <input type="hidden" name="order_no" value="<?php echo $order_info->order_no ?>">
                                <div>
                                    <div class="form-group">
                                        <label class="col-sm-5 control-label"></label>

                                        <div class="col-sm-7">
                                            <button type="submit" class="btn bg-navy btn-block">送出</button>
                                        </div>
                                    </div>

                                </div>
                                </form>

                            <?php }elseif($order_info->order_status == 1){ ?>
                                <!-- cancel Order-->
                                <div class="date">Order Status: <?php echo '已取消' ?></div>
                            <?php }else{ ?>
                                <!-- confirm Order-->
                                <div class="date">Order Status: <?php echo '已確認' ?></div>
                            <?php } ?>

                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th class="no text-right">#</th>
                            <th class="desc">描述</th>
                            <th class="unit text-right">單價</th>
                            <th class="qty text-right">數量</th>
                            <th class="total text-right ">總計</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1?>
                        <?php foreach($order_details as $v_order): ?>
                        <tr>
                            <td class="no"><?php echo $counter ?></td>
                            <td class="desc"><h3><?php echo $v_order->product_name ?></h3></td>
                            <td class="unit"><?php echo number_format($v_order->selling_price, 2); ?></td>
                            <td class="qty"><?php echo $v_order->product_quantity ?></td>
                            <td class="total"><?php echo number_format($v_order->sub_total,2) ?></td>
                        </tr>
                            <?php $counter ++?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">小計</td>
                            <td><?php echo number_format($order_info->sub_total,2) ?></td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">稅</td>
                            <td><?php echo number_format($order_info->total_tax,2) ?></td>
                        </tr>

                        <?php if($order_info->discount):?>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">折扣金額</td>
                                <td><?php echo number_format($order_info->discount_amount,2) ?></td>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">總計</td>
                            <td><?php echo $currency.' '.number_format($order_info->grand_total,2) ?></td>
                        </tr>
                        </tfoot>
                    </table>

                </main>
                <hr/>
                <footer class="text-center">
                    <strong><?php echo $company_name?></strong>&nbsp;&nbsp;&nbsp;<?php echo $address ?>
                </footer>


            </div>
        </div>
            </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->





