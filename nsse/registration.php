<html>
	<head>REGISTRATION PAGE</head>
	<body>
		<form action="valid_reg.php" method="post">
			<br />
			<label>Name</label>&nbsp;&nbsp;<input type="text" name="name"><br /><br />
			<label>Gender: </label><br />
			<input type="radio" name="gender" id="Male" value="Male" checked><label for="Male">Male</label>
            <input type="radio" name="gender" id="Female" value="Female" /><label for="female">Female</label><br />
			<label>Department</label><br />
		    <select class='txt' style="width:350px;" name='d' id='d'>
			 <option value="Select">Select</option>
			 <option value="Computer-Commerce">Computer-Commerce</option>
			 <option value="Maths-Commerce">Maths-Commerce</option>
			 <option value="Science">Science</option>
			 <option value="Computer-Science">Computer-Science</option>
			 <option value="Humanities">Humanities</option>
			</select><br />
           	<label>Email ID</label>&nbsp;&nbsp;<input type="text" name="mail"><br /><br />
			<label>Username</label>&nbsp;&nbsp;<input type="text" name="uname"><br /><br />
			<label>Password </label>&nbsp;&nbsp;&nbsp;<input type="password" name="pwd"><br /><br />
			<input type="submit" name="LOGIN">
		</form>
	</body>
</html>