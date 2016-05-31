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

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style>

body {
    position: relative;
    width: 19cm;
    height: 29.7cm;
    margin: 0 auto;
    color: #555555;
    background: #FFFFFF;
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-family: SourceSansPro;
}

header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #AAAAAA;
}


.clearfix:after {
    content: "";
    display: table;
    clear: both;
}

a {
    color: #0087C3;
    text-decoration: none;
}


#logo {
    float: left;
    margin-top: 8px;
    display: inline-block;
    width: 40%;
}

#logo img {
    height: auto;
    width: auto;
}

#company {
    float: right;
    text-align: right;
    display: inline-block;
    width: 60%;
}


#details {
    margin-bottom: 50px;
}

#client {
    padding-left: 6px;
    border-left: 6px solid #0087C3;
    display: inline-block;
    width: 29%;
    float: left;

}

#shipping {
    padding-left: 6px;
    display: inline-block;
    width: 29%;
    float: left;
}

#client .to {
    color: #777777;
}

h2.name {
    font-size: 1.4em;
    font-weight: normal;
    margin: 0;
}

#invoice {
    display: inline-block;
    text-align: right;
    width: 37%;
    float: right;
}

#invoice h1 {
    color: #0087C3;
    font-size: 2.4em;
    line-height: 1em;
    font-weight: normal;
    margin: 0  0 10px 0;
}

#invoice .date {
    font-size: 1.1em;
    color: #777777;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px;
}

table th,
table td {
    padding: 0px 5px;
    /*background: #EEEEEE;*/
    text-align: center;
    border-bottom: 1px solid #ccc;
}

table th {
    white-space: nowrap;
    font-weight: normal;
}

table td {
    text-align: right;
}

table td h3{
    color: #000;
    font-size: 1.2em;
    font-weight: normal;
    margin: 0 0 0.2em 0;
}

table .no {
    color: #000;
    font-size: 1.1em;
    /*background: #C4CBC2;*/
}

table .desc {
    text-align: left;
    font-size: 10px;
}

table .unit {
    /*background: #DDDDDD;*/
}

table .qty {
}

table .total {
    /*background: #DDD;*/
    color: #000;
}

table td.unit,
table td.qty,
table td.total {
    font-size: 1.0em;
}

table tbody tr:last-child td {
    border: none;
}

table tfoot td {
    padding: 1px 5px 1px;
    background: #FFFFFF;
    border-bottom: none;
    font-size: 1.2em;
    white-space: nowrap;
    border-top: 1px solid #AAAAAA;
}

table tfoot tr:first-child td {
    border-top: none;
    /*border-bottom: none;*/

}

table  tr:last-child {
    /*border-top: none;*/
    border-bottom: 1px solid #ccc;
}

table  tfoot tr:last-child {
    border-bottom: none;
}

table tfoot tr:last-child td {
    color: #000;
    font-size: 1.2em;
    border-top: 1px solid #ccc;

}

table tfoot tr td:first-child {
    border: none;
}

#thanks{
    font-size: 2em;
    margin-bottom: 30px;
}

#notices{
    padding-left: 6px;
    border-left: 6px solid #0087C3;
}

#notices .notice {
    font-size: 1.2em;
}



/*  SECTIONS  */
.section {
    clear: both;
    padding: 0px;
    margin: 0px;
}

/*  COLUMN SETUP  */
.col {
    display: block;
    float:left;
    margin: 1% 0 1% 1.6%;
}
.col:first-child { margin-left: 0; }

/*  GROUPING  */
.group:before,
.group:after { content:""; display:table; }
.group:after { clear:both;}
.group { zoom:1; /* For IE 6/7 */ }

/*  GRID OF FOUR  */
.span_4_of_4 {
    width: 100%;
}
.span_3_of_4 {
    width: 74.6%;
}
.span_2_of_4 {
    width: 49.2%;
}
.span_1_of_4 {
    width: 23.8%;
}

/*  GO FULL WIDTH BELOW 480 PIXELS */
@media only screen and (max-width: 480px) {
    .col {  margin: 1% 0 1% 0%; }
    .span_1_of_4, .span_2_of_4, .span_3_of_4, .span_4_of_4 { width: 100%; }
}


</style>


</head>
<body>

<header class="clearfix print_area">
    <div id="logo">
          <img src="<?php  echo base_url(). $logo?>">
        </div>
    <div id="company">
        <h2 class="name"><?php echo $company_name?></h2>
        <div><?php echo $company_phone?></div>
        <div><?php echo $company_email?></div>
    </div>

</header>

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
                <th class="desc">報價單日期: <?php echo date('Y-m-d', strtotime($order[$key]->invoice_date )) ?></th>
            </tr>
            </thead>
        </table>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr style="background-color: #ECECEC">
                <th class="no text-right">#</th>
                <th class="desc">描述</th>
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
                    <td class="desc"><?php echo $k ?></td>
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
                    <td class="total" colspan="2">折扣價格</td>
                    <td class="total"><?php echo number_format($order[$key]->discount_amount,2) ?></td>
                </tr>
            <?php endif; ?>

            <tr>
                <td colspan="4"></td>
                <td class="total" colspan="2">總計</td>
                <td class="total"><?php echo $currency.' '.number_format($order[$key]->grand_total ,2) ?></td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td class="total" colspan="2">獲利</td>
                <td class="total"><?php echo $currency.' '.number_format( $order[$key]->grand_total - $total_buying_price,2) ?></td>
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

    <?php else: ?>
        <strong>目前沒有任何紀錄顯示</strong>
    <?php endif ?>

    <div class="section group" style="background-color: #ccc">
        <div class="col span_1_of_4">
            總成本
        </div>
        <div class="col span_1_of_4 " >
            總銷售
        </div>
        <div class="col span_1_of_4" style="margin-top: -5px">
            總獲利
        </div>

    </div>
    <div class="section group" style="background-color:#efefef">
        <div class="col span_1_of_4">
            <?php echo $currency.' '.number_format( $total_cost,2) ?>
        </div>
        <div class="col span_1_of_4" >
            <?php echo $currency.' '.number_format( $total_sell,2) ?>
        </div>
        <div class="col span_1_of_4" style="margin-top: -5px">
            <?php echo $currency.' '.number_format( $total_profit,2) ?>
        </div>

    </div>

</main>




</body>
</html>