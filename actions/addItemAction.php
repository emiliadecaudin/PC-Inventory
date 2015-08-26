<?php
	require("checkLoggedInAction.php");
	require_once("../mysql/Table.php");

	$item = $_POST["item"];
	$pageTitle = "Added {$_POST["tableName"]} {$item}";
?>
<!doctype html>
<html>
	<head>
		<?php include("../templates/head.php"); ?>
		<script>
			timer=setTimeout(function() {
				window.location="<?=$_POST["tableName"] === "computer" ? "../viewComputer.php?computerName={$item}" : "../addOrDeleteItems.php"?>";
			}, 1250);
		</script>
	</head>
	<body>
		<?php include("../templates/header.php"); ?>
			<?php
				if ($item === "") {
					echo("<script type=\"text/javascript\">
						alert(\"Name is empty!\");
						window.history.back();
					</script>");
					exit();
				}
				$table = new Table($_POST["tableName"]);
				if ($table->doesContain($item)) {
					echo("<script type=\"text/javascript\">
						alert(\"$item already exists!\");
						window.history.back();
					</script>");
					exit();
				}
				$table->addItem($item);
			?>
			<div class="portal green">
				<h3>Succsessfuly added <?=$_POST["tableName"]." ".$item?>!</h3>
			</div>
			<?php include("../templates/footer.php"); ?>
	</body>
</html>