<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= lang('fdcas')?></title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?= base_url() ?>ui/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= base_url() ?>ui/css/font-awesome.css" />
        <link rel="stylesheet" href="<?= base_url() ?>ui/css/unicorn-login.css" />
        <script type="text/javascript" src="<?= base_url() ?>ui/js/respond.min.js"></script>
    </head>    <body>
        <div class="text center" id="container">
        
            <div id="logo">
            	<img style="margin: 0 auto;" src="<?= base_url() ?>ui/img/AAF.png" />
                <h2 style="text-align: center;color: #FFF5F5"><?= lang('fdcas') ?></h2>

            </div>
            <div id="user">
                <div class="avatar">
                    <div class="inner"></div>
                    <img src="<?= base_url() ?>ui/img/ayubowan.jpg" />
                </div>
                <div class="text">
                    <h3><?= lang('welcome') ?><span class="user_name"></span> <?= lang('validating_info') ?></h3>
                </div>
            </div>
            <div id="loginbox">
                <!-- <?php echo validation_errors(); ?>-->
                <?php echo form_open('user/login', array('id' => 'loginform')) ?>
                
                    <p><?= lang('login_title'); ?></p>
                    <div class="input-group input-sm">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span><input class="form-control" type="text" id="username" name="username" placeholder="<?= lang('user_name'); ?>" autocomplete='off'/>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span><input class="form-control" type="password" name="password" id="password" placeholder="<?= lang('password'); ?>" autocomplete='off'/>
                    </div>
                    <div class="form-actions clearfix">
                        <input type="submit" class="btn btn-block btn-primary btn-default" value="<?= lang('login'); ?>" />
                    </div>
                    <? if(isset($error)){ ?>
                    <span id="valerror" class="label label-danger text-danger"><?= lang($error) ?></span>
                    <? } ?>
                    <div class="footer-login">
                        <b><?= lang('copyright'); ?></b>
                        <!--<?= lang('languages'); ?> <a href="<?= base_url() ?>language/lang/english">English</a> | <a href="<?= base_url() ?>language/lang/sinhala">සිංහල</a> | <a href="<?= base_url() ?>language/lang/tamil">தமிழ்</a>-->
                    </div>

                </form>
            </div>
        </div>

        <script src="<?= base_url() ?>ui/js/jquery.min.js"></script>  
        <script src="<?= base_url() ?>ui/js/jquery-ui.custom.min.js"></script>
        <script src="<?= base_url() ?>ui/js/unicorn.login.js"></script>
    </body>
</html>
