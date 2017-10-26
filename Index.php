<!DOCTYPE HTML PUBLIC>
	<html>
		<head>
			<title>Online Survey</title>
			
			<link rel="stylesheet" type="text/css" href="index.css">
			<script src="login.js" async></script>
			<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

		</head>
		<body>
		<div id="SignIn"; style ="width: 50%">
					<h2>Login Form</h2>

					<form action="/action_page.php">

					  <div class="container">
						<label><b>Username</b></label>
						<input type="text" placeholder="Enter Username" name="uname" required>

						<label><b>Password</b></label>
						<input type="password" placeholder="Enter Password" name="psw" required>
							
						<button type="submit">Login</button>
						<input type="checkbox" checked="checked"> Remember me
					  </div>

					  <div class="container" style="background-color:#f1f1f1">
						<button type="button" class="cancelbtn">Cancel</button>
						<span class="psw">Forgot <a href="#">password?</a></span>
					  </div>
					</form>
			</div>
			<div class="SurveyOptions">
			<button type="button";id="SignInButton"l onclick='LoginForm()'>Sign In</button>
				<h2 align="center">To begin choose your survey from the list below.</h2>
				<div id="Selection" float="center">
					<select>
						<option value="blank">Select One...</option>
						<option value="uniqID">Employee Satisfaction</option><!uniqID will come from mysql linking to backend data>
					</select>
					<br>
					<button type="submit"; id ="begin">Begin</button>
				</div>
			</div>
		</body>
	</html>