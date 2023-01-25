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
<h6>حساب کاربری خود را شناسایی کنید</h6>


    <div class="bgwith">
        <div class="row">
            <div class="col-sm-{if $linkableProviders}7{else}12{/if}">
            
            
            {$addonerror}
			{if $timeleft == '0'}
			<form  method="post">
			  <div class="row">
				<div class="col-md-5">
				  <div class="form-group">
					<label for="">شماره موبایل</label>
					<input type="text" name="mobilenumber" class="form-control" placeholder="شماره تلفن شما">
				  </div>
				  <div class="form-group">
					<label for="">آدرس ایمیل</label>
					<input type="email" name="useremail" class="form-control" placeholder="آدرس ایمیل شما">
				  </div>
				  <button type="submit" class="btn btn-primary">ورود</button>
				</div>
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



