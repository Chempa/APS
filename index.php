<?php ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>API TEST</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<fieldset>
		<legend>Register</legend>
		<form action="./register.php" method="post" accept-charset="utf-8">
			<input type="text" name="phone" value="" placeholder="phone">
			<input type="password" name="password" value="" placeholder="password">
			<input type="submit" name="" value="Submit">
		</form>
	</fieldset>
	<fieldset>
		<legend>Login</legend>
		<form action="./login.php" method="post" accept-charset="utf-8">
			<input type="text" name="phone" value="" placeholder="phone">
			<input type="password" name="password" value="" placeholder="password">
			<input type="submit" name="" value="Submit">
		</form>
	</fieldset>
	<fieldset>
		<legend>Emergency</legend>
		<form action="./emergency.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			<input type="text" name="token" value="" placeholder="token">
			<input type="file" name="image" value="" placeholder="image" title="image">
			<input type="text" name="nature_of_accident" value="" placeholder="nature_of_accident">
			<input type="text" name="number_of_people_involved" value="" placeholder="number_of_people_involved">
			<input type="text" name="accident_priority" value="" placeholder="accident_priority">
			<input type="text" name="latitude" value="" placeholder="latitude">
			<input type="text" name="longitude" value="" placeholder="longitude">
			<input type="submit" name="" value="Submit">
		</form>
	</fieldset>
</body>
</html>