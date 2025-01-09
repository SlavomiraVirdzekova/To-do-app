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
	$stav = $_POST["stav"];

	$dotaz = $db->prepare("INSERT INTO ukoly SET ukol = ?, termin = ?, kategorie = ?, důležitost = ?, stav = ?");
	$dotaz->execute([$ukol, $termin, $kategorie, $dulezitost, $stav]);
	$idUkolu = $db->lastInsertId();		

	header("Location: " . $_SERVER['PHP_SELF']);
	exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'update_status'){
	$idUkolu = $_POST['id'];
	$stav = $_POST['stav'];

	$dotaz = $db->prepare("UPDATE ukoly SET stav = ? WHERE id = ?");
	$dotaz->execute([$stav, $idUkolu]);

	echo "Stav úkolu byl aktualizovaný";
	exit();

}

if (isset($_POST['delete'])){
	$idUkolu = $_POST['delete'];

	$dotaz = $db->prepare("DELETE FROM ukoly WHERE id = ?");
	$dotaz->execute([$idUkolu]);

	header("Location: " . $_SERVER['PHP_SELF']);
	exit();
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

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="css/style.css">
	<title>TO-DO-IT</title>
</head>
<body>
	<header>
</header>
	<main>
	<button class="new-task">Nový úkol + </button>
		<form method="post" class="task-form hide">		
			<label>Úkol:</label>
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
			<input type="hidden" name="stav" value="null"></input>

			<label for="term">Termín:</label>
			<input type="date" name="date">
			<button type="submit" name="add">Přidat</button>
		</form>		
			
		<section class="today-items">		
		<h1>Dnešní úkoly:</h1>	
			<?php 
				$dotaz = $db->prepare("SELECT id, ukol, termin, kategorie, stav FROM ukoly WHERE termin = CURRENT_DATE() ORDER BY stav");
				$dotaz->execute();
				$seznamDnesnichUkolu = $dotaz->fetchAll();

				if (count($seznamDnesnichUkolu) <= 0){
					echo "<p>Dnes máš volno</p>";
				}
				else {
					echo "<div class='items'>";	
					
					foreach($seznamDnesnichUkolu as $polozka){ 
					
					include 'vypsaniUkolu.php';
					}  
				}
			?>
		</section>

		<section class="after-term">
		<h1>Úkoly po termínu:</h1>		
				<?php
					$dotaz = $db->prepare("SELECT id, ukol, termin, kategorie, stav FROM ukoly WHERE termin < CURRENT_DATE() AND stav = 0 ORDER BY termin");
					$dotaz->execute();
					$seznamUkoluPoTerminu = $dotaz->fetchAll();

					if(count($seznamUkoluPoTerminu) == 0){
						echo "<p>Huráá vše stíhaš!!!!!</p>";
					}

					else{
						echo "<div class='items'>";
						foreach($seznamUkoluPoTerminu as $polozka){ 
							include 'vypsaniUkolu.php';				
						} 
					}
				?>
			</div>
		</section>

		
		<section class="dalsi-ukoly">
			<h1>Další úkoly:</h1>
			<div class="items">	
				<?php
					$dotaz = $db->prepare("SELECT id, ukol, termin, kategorie, stav FROM ukoly  WHERE termin > CURRENT_DATE() AND stav = 0 ORDER BY termin");
					$dotaz->execute();
					$seznamVsechUkolu = $dotaz->fetchAll();

					foreach($seznamVsechUkolu as $polozka){
						include 'vypsaniUkolu.php';
					}
				?>
			</div>	
		</section>
	
		<div class="section">
			<h1>Tohle máš za sebou</h1>
			<div class="items">
				<?php
					$dotaz = $db->prepare("SELECT id, ukol, termin, kategorie, stav FROM ukoly WHERE stav = 1");
					$dotaz->execute();
					$seznamHotovychUkolu = $dotaz->fetchAll();

					foreach($seznamHotovychUkolu as $polozka){
						include 'vypsaniUkolu.php';
					}
				?>
			</div>
		</div>

	</main>
</body>

<script>
	$(".new-task").click(function(){
		$("form").removeClass("hide");			
	});

	$(".checkbox").change(function() {
		const taskId = $(this).data('id');
		const isChecked = $(this).prop('checked');
			
		if (isChecked) {
			$(this).parent().parent().children(":nth-child(2)").css({"text-decoration": "line-through",
				"color": "grey",
			});
		}
		else {
			$(this).parent().parent().children(":nth-child(2)").css({"text-decoration": "none",
				"color": "black",
			});
		}

		localStorage.setItem('checkbox_' + taskId, isChecked);
				
		$.ajax({
			url:'',
			type: 'POST',
			data: {
				action: 'update_status',
				id: taskId,
				stav: isChecked ? 1 : 0
			},
			success: function(response) {

				console.log('Stav byl úspěšně aktualizovaný v databáze');

			},
				
			error: function(xhr, status, error) {
				console.error("Nastala chyba: " + error);
			}
		});
	});	
	
	$(".checkbox").each(function() {
		const taskId = $(this).data('id');
		const savedState = localStorage.getItem('checkbox_' + taskId);

		if (savedState === 'true'){
			$(this).prop('checked', true);
			$(this).parent().parent().children(":nth-child(2)").css({
				"text-decoration": "line-through",
				"color": "grey"
			});
			
		}
		else{
			$(this).prop('checked', false);
			$(this).parent().parent().children(":nth-child(2)").css({
				"text-decoration": "none",
				"color": "black"
			});
		}
	});
	
		
		$(".delete-btn").click(function(event) {
			let confirmation = confirm("Určitě chcete úkol smazat?");

			if (!confirmation) {
				event.preventDefault();
			}
		});

		
	
</script>
</html>