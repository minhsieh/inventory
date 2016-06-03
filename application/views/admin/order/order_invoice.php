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

<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->
<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">訂單報價單</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <div class="box-tools">
                <div class="btn-group" role="group" >
                    <a onclick="print_invoice('printableArea')" class="btn btn-default ">列印</a>
                    <a href="<?php echo base_url() ?>admin/order/pdf_invoice/<?php echo $invoice_info->invoice_no ?>" class="btn btn-default ">PDF</a>
                    <a href="<?php echo base_url() ?>admin/order/email_invoice/<?php echo $invoice_info->invoice_no ?>" class="btn btn-default " <?php
                    echo $order_info->customer_email == '' ? 'disable':''
                    ?>>Email給客戶</a>
                </div>
            </div>

        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">


        <div id="printableArea">
            <link href="<?php echo base_url(); ?>asset/css/invoice.css" rel="stylesheet" type="text/css" />



            <div class="row ">


            <div class="col-md-8 col-md-offset-2">

                <header class="clearfix">
                    <div id="logo">
                        <img src="<?php  echo base_url(). $logo?>">
                    </div>
                    <div id="company">
                        <h2 class="name"><?php echo $company_name ?></h2>
                        <div><?php echo $company_phone?></div>
                        <div><?php echo $company_email?></div>
                    </div>

                </header>
                <hr/>
                <main>
                    <div id="details" class="clearfix">
                        <div id="client" style="margin-right: 100px">
                            <div class="to">客戶帳單資訊:</div>
                            <h2 class="name"><?php echo $order_info->customer_name ?></h2>
                            <div class="address"><?php echo $order_info->customer_address ?></div>
                            <div class="address"><?php echo $order_info->customer_phone ?></div>
                            <div class="email"><?php echo $order_info->customer_email ?></div>
                        </div>
                        <?php if(!empty($order_info->shipping_address)):?>
                        <div id="shipping">
                            <div class="to">客戶運送資訊:</div>

                            <div class="address"><?php
                                echo  $order_info->shipping_address;
                                ?></div>

                        </div>
                        <?php endif ?>

                        <div id="invoice">
                            <h1>報價單 <?php echo $invoice_info->invoice_no ?></h1>
                            <div class="date">報價單日期: <?php echo date('Y-m-d', strtotime($invoice_info->invoice_date )) ?></div>
                            <div class="date">銷售人: <?php echo $order_info->sales_person ?></div>

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
                            <td colspan="2">Tax</td>
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
                    <strong><?php echo $company_name ?></strong>&nbsp;&nbsp;&nbsp;<?php echo $address ?>
                </footer>


            </div>
        </div>
            </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->





