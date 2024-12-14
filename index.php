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
	<section class="do-it-list">		
		<div class="today items">
		
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
		$(".new-task").click(function(){
			$("form").removeClass("hide");			
		});
	
</script>
</html>