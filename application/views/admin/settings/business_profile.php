<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                    <div class="col-md-offset-3">
                        <h3 class="box-title ">主要設定</h3>
                    </div>
                </div>
                <!-- /.box-header -->

                <!-- form start -->
                <form role="form" enctype="multipart/form-data" id="addProductForm" onsubmit="return companyLogo(this)"
                      action="<?php echo base_url(); ?>admin/settings/save_business_profile/<?php if (!empty($business_info->business_profile_id)) {
                          echo $business_info->business_profile_id;
                      } ?>"
                      method="post">

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">

                            <div class="box-body">

                                <!-- /.Company Name -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">公司名稱 <span class="required">*</span></label>
                                    <input type="text" name="company_name" placeholder="公司名稱" required
                                           value="<?php
                                           if (!empty($business_info->company_name)) {
                                               echo $business_info->company_name;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <!-- /.Company Email -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">公司Email <span
                                            class="required">*</span></label>
                                    <input type="text" placeholder="公司Email" name="email" required
                                           value="<?php
                                           if (!empty($business_info->email)) {
                                               echo $business_info->email;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <!-- /.Address -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">地址 <span class="required">*</span></label>
                                    <textarea name="address" class="form-control autogrow" id="field-ta" required
                                              placeholder="地址"><?php
                                        if (!empty($business_info->address)) {
                                            echo $business_info->address;
                                        }
                                        ?></textarea>
                                </div>

                                <!-- /.Phone -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">電話</label>
                                    <input type="text" placeholder="電話" name="phone"
                                           value="<?php
                                           if (!empty($business_info->phone)) {
                                               echo $business_info->phone;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <!-- /.Currency -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">貨幣 <span class="required">*</span></label>
                                    <input type="text" placeholder="貨幣" name="currency" required
                                           value="<?php
                                           if (!empty($business_info->currency)) {
                                               echo $business_info->currency;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <!-- /.Company Logo -->
                                <div class="form-group">
                                    <label>公司Logo</label>
                                </div>
                                <div class="form-group"><!-- Company Logo -->
                                    <input type="hidden" name="old_path" value="<?php
                                    if (!empty($business_info->full_path)) {
                                        echo $business_info->full_path;
                                    }
                                    ?>">

                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail g-logo-img">
                                            <?php if (!empty($business_info->logo)) : ?>
                                                <img src="<?php echo base_url() . $business_info->logo; ?>">
                                            <?php else: ?>

                                            <?php endif; ?>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail g-logo-img"></div>

                                        <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new"><input type="file"  name="logo" size="20"/></span>
                                        <span class="fileinput-exists">更換</span>

                                    </span>
                                            <a href="#" class="btn btn-default fileinput-exists"
                                               data-dismiss="fileinput">移除</a>

                                        </div>
                                        <div id="valid_msg" class="required"></div>
                                    </div>
                                </div>
                                <!-- / Company Logo -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn bg-navy col-md-offset-3" type="submit">儲存公司檔案
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>

