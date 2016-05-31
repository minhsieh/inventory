<?php $this->load->view('admin/components/header'); ?>
<link href="<?php echo base_url(); ?>asset/css/animation.css" rel="stylesheet">

<body class="login-page">

<?php
$error = $this->session->userdata('error');
if (!empty($error)) {
    ?>
    <div class="alert alert-danger"><?php
        echo $error;
        ?></div>
<?php }$this->session->unset_userdata('error'); ?>

<div class="login-box">
    <div class="login-logo animated fadeInDown" data-animation="fadeInDown">
        <a href="<?php echo base_url() ?>"><b>倉儲貨物</b>管理系統</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body  animated fadeInUp" data-animation="fadeInUp">
        <p class="login-box-msg">請登入使用者帳號</p>
        <form role="form" action="<?php echo base_url() ?>login" method="post">
            <?php echo validation_errors(); ?>
            <?php echo $this->session->flashdata('error'); ?>
            <div class="form-group has-feedback">
                <input type="text" name="user_name" class="form-control" placeholder="帳號 Username" required="required" />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="密碼 Password" required="required" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <button type="submit" class="btn bg-orange btn-block btn-flat">登入</button>
            </div>
            <div class="row">

                <div class="col-xs-12">

                </div><!-- /.col -->
            </div>
        </form>



        <a href="<?php echo base_url()?>forget_password">忘記密碼了嗎?</a><br>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->


</body>
</html>