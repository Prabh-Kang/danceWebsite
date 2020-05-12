<?php
include "config/conn_config.php";
$errors = ['firstName' => '', 'lastName' => '', 'email' => '', 'phone' => '', 'type' => ''];
$firstName = $lastName = $email = $phone = $type = "";

if (isset($_POST['submit'])) {

	if (empty($_POST['firstName'])) {
		$errors['firstName'] = "First Name field is empty <br />";
	} else {
		$firstName = $_POST['firstName'];
		if (!preg_match('/^[a-z A-Z]+$/', $firstName)) {
			$errors['firstName'] = "First name should only include alphabets.<br />";
		}
		// echo htmlspecialchars($_POST['firstName']);
	}
	if (empty($_POST['lastName'])) {
		$errors['lastName'] = "Last Name Field is empty <br />";
	} else {
		$lastName = $_POST['lastName'];
		if (!preg_match('/^[a-z A-Z]+$/', $lastName)) {
			$errors['lastName'] = "Last name should only include alphabets.<br />";
		}
		// echo htmlspecialchars($_POST['lastName']);
	}
	if (empty($_POST['email'])) {
		$errors['email'] = "Email field is empty <br />";
	} else {
		$email = $_POST['email'];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = "Email must be a valid email address.";
		}
		// echo htmlspecialchars($_POST['email']);
	}
	if (empty($_POST['phone'])) {
		$errors['phone'] = "Phone number field is empty <br />";
	} else {
		$phone = $_POST['phone'];
		if (!preg_match('/^([0-9]){10}$/', $phone)) {
			$errors['phone'] = "Phone number should only contain 10 numbers.";
		}
		// echo htmlspecialchars($_POST['phone']);
	}
	if (empty($_POST['type'])) {
		$errors['type'] = "Type of dance field is empty <br />";
	} else {
		$type = $_POST['type'];
		if (!preg_match('/^\w+(,\s*\w+)*$/', $type)) {
			$errors['type'] = "Enter the type of dances correctly separated by commas.";
		}
		// echo htmlspecialchars($_POST['type']);
	}
	if (array_filter($errors)) {
	} else {
		$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
		$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		$type = mysqli_real_escape_string($conn, $_POST['type']);

		$sql = "INSERT INTO admissions(first_name, last_name, email, phone, type) VALUES('$firstName', '$lastName', '$email', '$phone', '$type')";
		if(mysqli_query($conn, $sql)){
			header("Location:ok.php");
		}
		else {
			echo "Error: ", mysqli_error($conn);
		}
	}
}



?>

<?php include("templates/header.php") ?>

<div class="container">
	<form action="index.php" method="POST">
		<h2 class="text-center my-3">
			Admission Form
		</h2>

		<p class="h5 text-center mb-3">
			Please fill in the following details.
		</p>
		<hr style="width: 50%">
		<fieldset>

			<div class="form-group row">
				<div class="col-md-6">
					<label for="firstName">First Name</label>
					<input type="text" name="firstName" class="form-control" value="<?php echo htmlspecialchars($firstName); ?>" placeholder="John">
					<div>
						<p class="text-danger">
							<?php echo $errors['firstName']; ?>
						</p>
					</div>
				</div>
				<div class="col-md-6">
					<label for="lastName">Last Name</label>
					<input type="text" name="lastName" class="form-control" placeholder="Doe" value="<?php echo htmlspecialchars($lastName); ?>">
					<div>
						<p class="text-danger">
							<?php echo $errors['lastName']; ?>
						</p>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-6">
					<label for="email">Email</label>
					<input type="text" class="form-control" name="email" placeholder="xyz@abc.com" value="<?php echo htmlspecialchars($email); ?>">
					<div>
						<p class="text-danger">
							<?php echo $errors['email']; ?>
						</p>
					</div>
				</div>

				<div class="col-md-6">
					<label for="phone">Phone Number</label>
					<input type="text" class="form-control" name="phone" placeholder="98xxxxxxxx" value="<?php echo htmlspecialchars($phone); ?>">
					<div>
						<p class="text-danger">
							<?php echo $errors['phone']; ?>
						</p>
					</div>
				</div>

			</div>
			<div class="form-group">
				<label for="typeOfDance">Types of dance you want to learn (comma separated)</label>
				<input type="text" class="form-control" name="type" placeholder="Western,Classical etc." value="<?php echo htmlspecialchars($type); ?>">
				<div>
					<p class="text-danger">
						<?php echo $errors['type']; ?>
					</p>
				</div>
			</div>
</div>
<div class="form-group text-center">
	<input type="submit" value="Submit" name="submit" class="btn btn-primary">
</div>
</fieldset>

</form>

</div>
<?php include("templates/footer.php") ?>

</body>

</html>