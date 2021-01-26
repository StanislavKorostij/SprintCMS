<?php

session_start();

include_once('../utils/connection.php');

if (isset($_SESSION['logged_in'])) {
?>

	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CMS APP</title>
		<link rel="stylesheet" href="../assets/style.css" />
	</head>

	<body>
		<div class="container">
			<a href="../index.php" id="logo">CMS</a>

			<br />

			<ul>
				<li><a href="add.php">Add Article</a></li>
				<li><a href="edit.php">Edit Article</a></li>
				<li><a href="delete.php">Delete Article</a></li>
				<br />
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>

	</body>

	</html>

<?php
} else {
	if (isset($_POST['username'], $_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username) or empty($password)) {
			$error = "All fields are required!";
		} else {
			$query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");

			$query->bindValue(1, $username);
			$query->bindValue(2, $password);

			$query->execute();

			$num = $query->rowCount();

			if ($num == 1) {
				$_SESSION['logged_in'] = true;

				header('Location: index.php');
				exit();
			} else {
				$error = 'Incorrect details!';
			}
		}
	}
?>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>CMS APP</title>
		<link rel="stylesheet" href="../assets/style.css" />
	</head>

	<body>
		<div class="container">
			<a href="../index.php" id="logo">CMS</a>
			<br /><br />
			<?php if (isset($error)) { ?>
				<small style="color:#aa0000;"><?php echo $error; ?></small>
				<br /><br />
			<?php } ?>
			<form action="index.php" method="post">
				<input type="text" name="username" placeholder="Username" />
				<input type="password" name="password" placeholder="Password" />
				<input type="submit" value="Login" />
			</form>
		</div>

	</body>

	</html>
<?php
}
?>