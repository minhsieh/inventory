<?php $cart = $this->cart->contents() ; ?>
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
<div class="box-background">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">


                <div class="form-group">
                    <label class="col-sm-5 control-label">訂單編號 No.</label>

                    <div class="col-sm-7">
                        <input type="text" value="<?php echo $this->session->userdata('order_no'); ?>" disabled class="form-control ">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="box-body">

    <div class="row">

        <div class="col-md-6">

            <form method="post" action="<?php echo base_url(); ?>admin/order/new_order">
                <div class="input-group">
                      <span class="input-group-btn">
                        <button type="submit" class="btn bg-blue" type="button" data-placement="top" data-toggle="tooltip" data-original-title="使用ID/編號來搜尋客戶">搜尋</button>
                      </span>
                    <input type="text" name="customer" class="form-control" placeholder="客戶" >
                    <input type="hidden" name="flag" value="customer">
                </div>
            </form>

        </div>

        <div class="col-md-6">
            <form method="post" action="<?php echo base_url(); ?>admin/order/new_order">
                <div class="input-group">
                    <input type="text" class="form-control" value="<?php echo $this->session->userdata('customer_name'); ?>" placeholder="移動中客戶">
                    <span class="input-group-btn">
                            <button type="submit" class="btn btn-danger" type="button" data-placement="top" data-toggle="tooltip" data-original-title="移除客戶"><i class="glyphicon glyphicon-remove-circle"></i></button>
                    </span>
                </div>
                <input type="hidden" name="remove_flag" value="customer">
            </form>
        </div>
    </div>
</div>

<form method="post" action="<?php echo base_url()?>admin/order/save_order">

        <div class="box-background" id="order">
            <div class="box-body">
                <div class="row">

                    <div class="col-md-12">


                       <div class="form-group">
                            <label class="col-sm-5 control-label">小計</label>

                            <div class="col-sm-7">
                                <input type="text" value="<?php
                                if(empty($cart)){
                                    echo '0.00';
                                }else{ echo $this->cart->format_number($this->cart->total());  }

                                ?>" disabled  class="form-control unite">
                            </div>
                        </div>

                        <?php $total_tax = 0.00 ?>
                        <?php if (!empty($cart)): foreach ($cart as $item) : ?>
                            <?php $total_tax += $item['tax'] ?>
                        <?php endforeach; endif ?>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">稅</label>

                            <div class="col-sm-7">
                                <input type="text" value="<?php
                                if(empty($cart)){
                                    echo '0.00';
                                }else {
                                    echo number_format($total_tax, 2, '.', ',') ;
                                }
                                ?>" disabled class="form-control unite">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">折扣</label>

                            <div class="col-sm-7">
                                <?php
                                  $discount = $this->session->userdata('discount')
                                ?>
                                <input type="text" value="<?php if(!empty($discount)) {echo number_format($discount, 0, '.', ',') ; }else{ echo '0'; }
                                ?> %" disabled class="form-control unite">
                            </div>
                        </div>
                    <?php if(!empty($discount)): ?>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">折扣金額</label>

                            <div class="col-sm-7">
                                <?php
                                $cart_total = $this->cart->total();
                                $discount_amount = (($cart_total + $total_tax) * $discount ) /100;
                                ?>
                                <input type="text" value="<?php echo number_format($discount_amount, 2, '.', ',') ;
                                ?>" disabled class="form-control unite">
                            </div>
                        </div>
                    <?php endif ?>





                    </div>


                </div>

            </div>
            <!-- /.box-body -->
        </div>



        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-5 control-label" style="padding-top: 25px">總計 :</label>
                            <?php $cart_total = $this->cart->total();
                            if(!empty($discount)){
                                $grand_total = $cart_total + $total_tax - $discount_amount;
                            }else{
                                $grand_total = $cart_total + $total_tax;
                            }
                            ?>
                        <div class="col-sm-7">
                            <h1><?php
                                if(empty($cart)){
                                    echo $currency . '0.00';
                                }else {
                                    echo $currency . number_format($grand_total , 2, '.', ',') ;
                                }
                                ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-background">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="col-sm-5 control-label">付款方式</label>

                            <div class="col-sm-7">
                                <select name="payment_method" class="form-control" id="order_payment_type">
                                    <option value="cash">現金付款</option>
                                    <option value="cheque">支票/轉帳付款</option>
                                    <option value="card">信用卡</option>
                                    <option value="pending">尚未確認訂單</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" style="display: none" id="payment">

                        <div class="form-group">
                            <label class="col-sm-5 control-label">信用卡/支票/轉帳 資訊</label>

                            <div class="col-sm-7">
                                <input class="form-control" name="payment_ref">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 order-panel"  id="shipping">
                            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                <li class="active"><a href="#note" data-toggle="tab">訂單註解</a>
                                </li>
                                <li><a href="#shipping_address" data-toggle="tab">運送</a></li>
                            </ul>
                        <div id="my-tab-content" class="tab-content">

                            <!-- ***************  Cart Tab Start ****************** -->
                                <div class="tab-pane active" id="note">
                                    <div class="form-group">
                                        <label>訂單註解</label>
                                        <textarea class="form-control" name="note" rows="3" placeholder="Enter ..." id="ck_editor"></textarea>
                                        <?php
                                        if(!empty($editor['ckeditor']))
                                        echo display_ckeditor($editor['ckeditor']); ?>
                                    </div>
                                </div>

                            <div class="tab-pane" id="shipping_address">
                                <div class="form-group">
                                    <label>運送地址</label>
                                    <textarea class="form-control" rows="3" name="shipping_address" placeholder="Enter ..." id="ck_editor2"></textarea>
                                    <?php echo display_ckeditor($editor2['ckeditor2']); ?>
                                </div>
                            </div>
                    </div>


                </div>
            </div>
        </div>


        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" id="btn_order" class="btn bg-navy btn-block " type="submit" <?php echo !empty($cart)?'':'disabled' ?>>送出訂單
                    </button>
                </div>
            </div>
        </div>

            <!-- hidden field -->

            <input type="hidden" name="customer_id" value="<?php  echo $this->session->userdata('customer_code') ?>">
            <input type="hidden" value="<?php echo $this->session->userdata('order_no'); ?>" name="order_no">
            <input type="hidden" value="<?php echo $grand_total; ?>" name="grand_total">
            <input type="hidden" value="<?php echo $total_tax; ?>" name="total_tax">
            <input type="hidden" value="<?php if(!empty($discount_amount)) echo $discount_amount ; ?>" name="discount_amount">
            <input type="hidden" value="<?php if(!empty($discount)) {echo number_format($discount, 0, '.', ',') ; }else{ echo '0'; }
            ?>" name="discount">


</form>