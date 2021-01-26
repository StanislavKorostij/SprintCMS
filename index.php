<!DOCTYPE html>
<html lang="en">

<?php

include_once('utils/connection.php');
include_once('utils/article.php');

$article = new Article;
$articles = $article->fetch_all();

?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CMS APP</title>
	<link rel="stylesheet" href="assets/style.css" />
</head>

<body>
	<div class="container">
		<a href="index.php" id="logo">CMS</a>

		<ol>
			<?php foreach ($articles as $article) { ?>
				<li><a href="article.php?id=<?php echo $article['article_id']; ?>"><?php echo $article['article_title']; ?>
					</a> - <small>
						Posted <?php echo date('l jS', $article['article_timestamp']); ?>
					</small></li>
			<?php } ?>
		</ol>

		<br />

		<small><a href="admin">Admin</a></small>
	</div>

</body>

</html>