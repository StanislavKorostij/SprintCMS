<?php
session_start();

include_once('../utils/connection.php');
include_once('../utils/article.php');

$article = new Article;

if (isset($_SESSION['logged_in'])) {
	if (isset($_GET['id'])) {
		$id = $_GET['id'];

		$query = $pdo->prepare('DELETE FROM articles WHERE article_id = ?');

		$query->bindValue(1, $id);
		$query->execute();

		header('Location: delete.php');
	}

	$articles = $article->fetch_all();
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
			<a href="index.php" id="logo">CMS</a>

			<br />

			<h4>Select an Article to Delete:</h4>
			<h5>Warning by selecting an article it will get deleted with no option to revert the changes!!</h5>

			<form action="delete.php" method="get">
				<select onchange="this.form.submit();" name="id">
					<option value="">Articles:</option>
					<?php foreach ($articles as $article) { ?>
						<option value="<?php echo $article['article_id']; ?>">
							<?php echo $article['article_title']; ?>
						</option>
					<?php } ?>
				</select>
			</form>
		</div>

	</body>

	</html>
<?php
} else {
	header('Location: index.php');
}
?>