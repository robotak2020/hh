<!-- Login Page -->
<section class="login_box_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="<?php echo assets('img/login.jpg');?>" alt="">
                    <div class="hover">
                        <h4>New to our website?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                        <a class="primary-btn" href="<?php echo url('register'); ?>">Create an Account</a>
                    </div>
                </div>
            </div>

<div id="login-page" class="login_form_inner">
    <!-- Centered Content -->
        <h1 class="heading">Log in to your account</h1>
        <!-- Form -->
        <form action="<?php echo url('login/submit'); ?>" class="form row login_form" >
            <div id="form-results"></div>
            <div class="col-md-12 form-group">
                <label for="email" class="col-sm-3 col-xs-12">Email</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="email" name="email" id="email" placeholder="Email Address" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'email'" />
                </div>
            </div>
            <div class="col-md-12 form-group">
                <label for="password" class="col-sm-3 col-xs-12">Password</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'password'" />
                </div>
            </div>
            <div class="col-md-12 form-group">
                <div class="creat_account">
                    <input type="checkbox" id="f-option2" name="selector">
                    <label for="f-option2">Keep me logged in</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 form-group">
                    <button class="primary-btn  submit-btn1">login</button>
                 </div>

        </form>
        <!--/ Form -->
    </div>
    <!--/ Centered Content -->
</div>
        </div>
    </div>

</section>