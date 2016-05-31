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


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                    <div class="col-md-offset-3">
                        <h3 class="box-title ">銷售報告</h3>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-background">
                    <!-- form start -->
                    <form role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/report/sales_report" method="post">

                        <div class="row">

                            <div class="col-md-4 col-sm-12 col-xs-12 col-md-offset-3">

                                <div class="box-body">


                                    <div class="form-group">
                                        <label class="control-label">開始日期<span class="required"> *</span></label>

                                        <div class="input-group">
                                            <input type="text" value="" class="form-control datepicker" name="start_date" data-format="yyyy/mm/dd" required>

                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-calendar"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">結束日期<span class="required"> *</span></label>
                                        <div class="input-group">
                                            <input type="text" value="" class="form-control datepicker" name="end_date" data-format="yyyy/mm/dd" required>

                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-calendar"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn bg-navy" type="submit">產生報告
                                    </button><br/><br/>
                                </div>
                                <!-- /.box-body -->

                            </div>
                        </div>

                    </form>
                </div>

                <?php if (!empty($invoice_details)) :?>
                <div class="box-body">

                    <div class="row ">
                        <div class="col-md-8 col-md-offset-2">
                            <form method="post" action="<?php echo base_url(); ?>admin/report/pdf_sales_report">
                            <div class="btn-group pull-right">
                                <a onclick="print_invoice('printableArea')" class="btn btn-primary">列印</a>

                                <button type="submit" class="btn bg-navy">
                                    PDF
                                </button>
                                    <input type="hidden" name="start_date" value="<?php echo $start_date ?>">
                                    <input type="hidden" name="end_date" value="<?php echo $end_date ?>">

                            </div>
                            </form>

                        </div>
                    </div>

                    <br/>
                    <br/>

                    <div id="printableArea">
                        <link href="<?php echo base_url(); ?>asset/css/sales_report.css" rel="stylesheet" type="text/css" />



                        <div class="row ">
                            <div class="col-md-8 col-md-offset-2">

                                <header class="clearfix">
                                    <div id="logo">
                                        <img src="<?php  echo base_url(). $logo?>">
                                    </div>
                                    <div id="company">
                                        <h2 class="name"><?php echo $company_name?></h2>
                                        <div><?php echo $company_phone?></div>
                                        <div><?php echo $company_email?></div>
                                    </div>

                                </header>
                                <hr/>

                                <main class="invoice_report">

                                    <h4>銷售報告 從: <strong><?php echo $start_date ?></strong> 到 <strong><?php echo $end_date ?></strong></h4>
                                    <br/>
                                    <br/>

                                <?php
                                $key =0;
                                $total_cost=0;
                                $total_sell=0;
                                $total_profit=0;
                                ?>
                                <?php if (!empty($invoice_details)): foreach ($invoice_details as $invoice_no => $order_details) : ?>
                                    <?php $total_buying_price =0 ?>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="no text-right">報價單 <?php echo $invoice_no  ?></th>
                                            <th class="desc">報價單日期: <?php echo date('Y-m-d', strtotime($order[$key]->invoice_date)) ?></th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <thead>
                                        <tr style="background-color: #ECECEC">
                                            <th class="no text-right">#</th>
                                            <th class="desc">敘述</th>
                                            <th class="unit text-right">買入價格</th>
                                            <th class="unit text-right">賣出價格</th>
                                            <th class="qty text-right">數量</th>
                                            <th class="qty text-right">稅</th>
                                            <th class="total text-right ">總計</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $k =1?>
                                    <?php if (!empty($order_details)): foreach ($order_details as $v_order) : ?>
                                            <tr>
                                                <td class="no"><?php echo $k ?></td>
                                                <td class="desc"><h3><?php echo $v_order->product_name ?></h3></td>
                                                <td class="unit"><?php echo number_format($v_order->buying_price,2)  ?></td>
                                                <?php $total_buying_price += $v_order->buying_price; ?>
                                                <td class="unit"><?php echo number_format($v_order->selling_price,2) ?></td>
                                                <td class="qty"><?php echo $v_order->product_quantity ?></td>
                                                <td class="qty"><?php echo $v_order->product_tax ?></td>
                                                <td class="total"><?php echo number_format($v_order->sub_total + $v_order->product_tax,2)  ?></td>
                                            </tr>
                                        <?php $k++?>
                                        <?php $total_cost += $v_order->buying_price; ?>

                                        <?php
                                            endforeach;
                                            endif;
                                        ?>


                                        </tbody>
                                        <tfoot>

                                        <?php if($order[$key]->discount_amount !=0): ?>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td colspan="2">折扣價格</td>
                                                <td><?php echo number_format($order[$key]->discount_amount,2) ?></td>
                                            </tr>
                                        <?php endif; ?>

                                        <tr>
                                            <td colspan="4"></td>
                                            <td colspan="2">總計</td>
                                            <td><?php echo $currency.' '.number_format($order[$key]->grand_total ,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td colspan="2">獲利</td>
                                            <td><?php echo $currency.' '.number_format( $order[$key]->grand_total - $total_buying_price,2) ?></td>
                                        </tr>
                                        </tfoot>
                                        <?php
                                        $total_sell += $order[$key]->grand_total;
                                        $total_profit += $order[$key]->grand_total - $total_buying_price;
                                        ?>

                                    </table>
                                    <?php $key ++; ?>
                                <?php endforeach; endif; ?>

                                    <?php if(!empty($invoice_details)) :?>
                                    <table>
                                        <thead>
                                        <tr style="background-color: #ccc">
                                            <th class="no text-right">總成本</th>
                                            <th class="no text-right">總銷售</th>
                                            <th class="no text-right">總獲利</th>
                                        </tr>
                                        </thead>
                                        <tbody style="background-color: #c5c5c5">
                                        <td class="total"><?php echo  $currency.' '.number_format( $total_cost,2) ?></td>
                                        <td class="total"><?php echo $currency.' '.number_format( $total_sell,2) ?></td>
                                        <td class="total"><?php echo $currency.' '.number_format( $total_profit,2) ?></td>
                                        </tbody>
                                    </table>

                                    <?php else: ?>
                                    <strong>目前沒有任何紀錄顯示</strong>
                                    <?php endif ?>



                                </main>
                                <hr/>
                                <footer class="text-center">
                                    <strong><?php echo $company_name?></strong>&nbsp;&nbsp;&nbsp;<?php echo $address ?>
                                </footer>


                            </div>
                        </div>

                </div>


            </div>
            <!-- /.box -->
            <?php endif ?>
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>


