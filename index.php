<?php
include('header.php');
?>
<div class="overlay"><div class="loader"></div></div>
	<!-- Navbar -->
	
	<br/><br/>
	<div class="container">
		
		<div class="card mx-auto" style="width: 20rem;">
		  <img class="card-img-top mx-auto" style="width:60%;" src="./images/login.png" alt="Login Icon">
		  <div class="card-body">
			  <!-- this form cant be submit directly as it has onsubmit return false -->
		    <form id="form_login" onsubmit="return false">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" class="form-control" name="log_email" id="log_email" placeholder="Enter email">
			    <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" class="form-control" name="log_password" id="log_password" placeholder="Password">
			  	<small id="p_error" class="form-text text-muted"></small>
			  </div>
			  <button type="submit" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Login</button>
			  <span><a href="register.php">Register</a></span>
			</form>
		  </div>
		  <div class="card-footer"><a href="#">Forget Password ?</a></div>
		</div>
	</div>

<?php
include('footer.php');
?>