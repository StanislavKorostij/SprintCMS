<?php
session_start();

include_once('../utils/connection.php');
include_once('../utils/article.php');

$article = new Article;

if (isset($_SESSION['logged_in'])) {

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

			<h4>Select an Article to Edit:</h4>

			<form action="edit.php" method="post">
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
		<?php
		if (isset($_POST['id'])) {
			$article = new Article;
			$id = $_POST['id'];
			$articles = $article->fetch_data($id);

		?>

			<body>
				<div class="container">

					<br />

					<h4>Edit Article</h4>

					<form action="edit.php" method="post">
						<input hidden type="text" name="id" value="<?php echo $id; ?>" />
						<input type="text" name="title" value="<?php echo $articles['article_title']; ?>" />
						<br /> <br />
						<textarea name="content" value="Content" cols="50" rows="15"><?php echo $articles['article_content']; ?></textarea>
						<br /> <br />
						<input type="submit" value="Edit Article" />
					</form>
				</div>

			</body>

	</body>

	</html>
<?php } ?>
<?php
	if (isset($_POST['title'], $_POST['content'])) {
		$title = $_POST['title'];
		$content = nl2br($_POST['content']);
		$name = $_POST['id'];

		$query = $pdo->prepare('UPDATE articles SET article_title=?, article_content=?, article_timestamp=? WHERE article_id=?');

		$query->execute([$title, $content, time(), $name]);

		header('Location: index.php');
	}
}
?>