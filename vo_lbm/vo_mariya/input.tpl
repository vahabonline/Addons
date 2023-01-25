
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
<h6>کد ارسال شده به شماره موبایلتان را وارد نمایید</h6>


    <div class="bgwith">
        <div class="row">
            <div class="col-sm-{if $linkableProviders}7{else}12{/if}">
            
            
            {$addonerror}

			<div class="row">
			  <div class="col-md-4">
				<form  method="post">
				  <div class="form-group">
					<input type="text" name="usercode" class="form-control" placeholder="کد دریافی">
				  </div>
				  <button type="submit" class="btn btn-primary">ثبت کد</button>
			  </form>
			  </div>
			</div>





            </div>
        </div>
    </div>
</div>



