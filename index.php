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
	<button class="new-task" name="new">Nový úkol + </button>
	<section>
		<form method="post" class="task-form hide">
			<label for="task">Úkol:</label>
			<textarea name="task" rows="4"></textarea>

			<label for="category">Kategórie:</label>
			<select name="category">
				<option value="">Vyberte</option>
				<option value="">Práce</option>
				<option value="">Rodina</option>
				<option value="">Přátelé</option>
				<option value="">Soukromí</option>
			</select>

			<label for="dulezitost">Důležitost:</label>
			<select name="dulezitost" id="">
				<option value="" class="most-important">1</option>
				<option value="" class="important">2</option>
				<option value="" class="less-important">3</option>
			</select>

			<label for="term">Termín:</label>
			<input type="date">
			<button type="submit" name="add">Přidat</button>
		</form>
	</section>	

	<section class="do-it-list">		
		<div class="today items">
			<?php
				$todayDate = Date("j.m.Y");

				//if ($taskTerm == $todayDate){
				//	echo "Dnes máte termín k těmto úkolům";
				//}
				//else {
				//	echo "Dnes Vás nečekají žádné úkoly, užívejte si volna, nebo pracujte na pzdějších";
				//}
				//echo $todayDate;
			?>
		</div>
			
		<div class="items">	
			<div class="task-box">
				<div class="task-head">			
					<span class="date">18.12.2024</span>
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
	const addTask = document.querySelector(".add");
	const formular = document.querySelector(".add-new-task");

	$( function(){
		$(addTask).on("click", function(){
			$(".visible").switchClass("visible", "hide", 1000);
			$(".hide").switchClass("hide", "visible", 1000);			
		});
	});
	
</script>
</html>