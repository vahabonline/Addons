<div class="logologregforgt">
    <a href="{$WEB_ROOT}/login.php">
        <img src="{$WEB_ROOT}/templates/{$template}/vahabonline/images/logo-light.png">
    </a>
</div>
<div class="img-holder">
    <div class="info-holder">
        <img src="{$WEB_ROOT}/templates/{$template}/vahabonline/images/graphic3.svg" alt="">
    </div>
</div>
<div class="logincontainer{if $linkableProviders} with-social{/if}">
<h2>ورود به حساب کاربری</h2>
<h6>جهت ورود به حساب کاربری خود ایمیل و رمز عبور را وارد نمایید .</h6>

    <div class="providerLinkingFeedback"></div>
    <div class="bgwith">
        <div class="row">
            <div class="col-sm-{if $linkableProviders}7{else}12{/if}">
            
            
            {$addonerror}
{if $timeleft == '0'}
<form  method="post">
    <div class="form-group">
    <label for="inputEmail">شماره تلفن</label>
      <input type="text" name="mobilenumber" class="form-control" placeholder="شماره تلفن شما">
    </div>
    
    <div class="btnbox">
                        <input id="login" type="submit" class="btn btn-primary" value="{$LANG.loginbutton}" /> <a href="{routePath('password-reset-begin')}" class="btn btn-link">{$LANG.forgotpw}</a> <a href="index.php?m=vo_rpbs" class="btn btn-link">بازیابی رمز عبور با پیامک</a>
                    </div>
                    
<div class="orregister">
                        <h4>یا اگر حساب ندارید</h4>
                        <a href="{$WEB_ROOT}/register.php" class="btn btn-block btn-link">یک حساب جدید ایجاد کنید</a>
                        <a href="{$WEB_ROOT}/cart.php" class="btn btn-block btn-link">ثبت سفارش</a>
                    </div>
</form>
{else}
  <p>شما قبلتر شماره با شماره {$usermobile} درخواست ثبت کرده اید . تا ارسال کد جدید {$timeleft} دیگر زمان مانده است . با کلیک روی لینک زیر میتوانید کد دریافت شده در تلفن خود را ثبت نموده و وارد پنل کاربری شوید</p>
  <a href="index.php?m=vo_lbm&action=input" class="btn btn-info">ثبت کد دریافتی</a>
{/if}





            </div>
        </div>
    </div>
</div>



