<div class="wait overlay">
    <div class="loader"></div>
</div>

<style>
    .input-borders {
        border-radius: 30px;
    }
</style>

<!-- Registration Form Section -->
<div id="register_section" class="container-fluid">
    <form id="signup_form" onsubmit="return false" class="login100-form">
        <div class="billing-details jumbotron">
            <div class="section-title">
                <h2 class="login100-form-title p-b-49">Register Here</h2>
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="text" name="f_name" id="f_name" placeholder="First Name">
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="text" name="l_name" id="l_name" placeholder="Last Name">
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="password" name="password" id="password" placeholder="password">
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="password" name="repassword" id="repassword" placeholder="confirm password">
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="text" name="mobile" id="mobile" placeholder="mobile">
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="text" name="address1" id="address1" placeholder="Address">
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="text" name="address2" id="address2" placeholder="City">
            </div>
            <div style="form-group">
                <input class="primary-btn btn-block" value="Sign Up" type="submit" name="signup_button">
            </div>
            <div class="text-pad">
                <a href="javascript:void(0);" id="login_link">Already have an Account? Then login</a>
            </div>
        </div>
    </form>
</div>

<!-- Login Form Section -->
<div id="login_section" class="container-fluid" style="display: none;">
    <form id="login_form" onsubmit="return false" class="login100-form">
        <div class="billing-details jumbotron">
            <div class="section-title">
                <h2 class="login100-form-title p-b-49">Login Here</h2>
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="email" name="login_email" id="login_email" placeholder="Email">
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="password" name="login_password" id="login_password" placeholder="Password">
            </div>
            <div style="form-group">
                <input class="primary-btn btn-block" value="Login" type="submit" name="login_button">
            </div>
            <div class="text-pad">
                <a href="javascript:void(0);" id="register_link">Don’t have an Account? Register here</a>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Show login form, hide register form
        $("#login_link").click(function() {
            $("#register_section").hide();
            $("#login_section").show();
        });
        
        // Show register form, hide login form
        $("#register_link").click(function() {
            $("#login_section").hide();
            $("#register_section").show();
        });
    });
</script>
