<?php
$db = new PDO(
	"mysql:host=localhost;dbname=ukoly;charset=utf8",
	"root",
	"root",
	array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	),
);

if(array_key_exists("add", $_POST)){
	$ukol = $_POST["task"];	
	$termin = $_POST["date"];
	$kategorie = $_POST["category"];
	$dulezitost = $_POST["dulezitost"];

	$dotaz = $db->prepare("INSERT INTO ukoly SET ukol = ?, termin = ?, kategorie = ?, důležitost = ?, stav = false");
	$dotaz->execute([$ukol, $termin, $kategorie, $dulezitost]);
	$idUkolu = $db->lastInsertId();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script
		src="https://code.jquery.com/jquery-3.7.1.min.js"
		integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
		crossorigin="anonymous"></script>

	<link rel="stylesheet" href="css/style.css">
	<title>TO-DO-IT</title>
</head>
<body>
	<header>
</header>
	<main>
	<button class="new-task">Nový úkol + </button>
		<form method="post" class="task-form hide">		
			<label for="task">Úkol:</label>
			<textarea name="task" rows="4"></textarea>

			<label for="category">Kategórie:</label>
			<select name="category">
				<option value="null">Vyberte</option>
				<option value="prace">Práce</option>
				<option value="rodina">Rodina</option>
				<option value="pratele">Přátelé</option>
				<option value="soukromi">Soukromí</option>
			</select>

			<label for="dulezitost">Důležitost:</label>
			<select name="dulezitost">
				<option value="1" class="most-important">1</option>
				<option value="2" class="important">2</option>
				<option value="3" class="less-important">3</option>
			</select>

			<label for="term">Termín:</label>
			<input type="date" name="date">
			<button type="submit" name="add">Přidat</button>
		</form>	
	<section class="do-it-list">		
		<div class="today items">
			<h1>Dnes Vás čekají tyto úkoly</h1>
			<?php 
				$dotaz = $db->prepare("SELECT id, ukol, termin, kategorie FROM ukoly WHERE termin = CURRENT_DATE()");
				$dotaz->execute();
				$seznamDnesnichUkolu = $dotaz->fetchAll();
				var_dump($seznamDnesnichUkolu);
			?>
		</div>
		<div class="items">	
			<div class="task-box">
				<div class="task-head">			
					<span class="date"></span>
					<span class="category">Rodina</span>
				</div>
				<p class="task">Upéct perníčky s miminkem Diankou a pak to všechno uklidit</p>
				<input type="checkbox" class="checkbox">
			</div>	
		</div>	
	</section>
	</main>

	<footer>
		<h1>The first and best victory is to conquer self.</h1>
	</footer>	
</body>

<script>
		$(".new-task").click(function(){
			$("form").removeClass("hide");			
		});
	
</script>
</html>