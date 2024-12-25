<?php
if(array_key_exists("delete", $_POST)){
		$dotaz = $db->prepare("DELETE FROM ukoly WHERE id = ?");
		$dotaz->execute([$this->id]);
	}  
	?>				
	<div class="task-box">
		<div class="task-head">
			<span class="date"><?php echo $polozka['termin'];?></span>
			<span class="category"><?php echo $polozka['kategorie'];?></span>
		</div>
		<p class="task"><?php echo $polozka['ukol'];?></p>
		<div class="task-bottom">
			<input type="checkbox" class="checkbox">
			<button name="delete" id="delete"> <i class="fa-solid fa-xmark"></i></button>
		</div>
	</div>
<?php 

if(array_key_exists("delete", $_POST)){
		$dotaz = $db->prepare("DELETE FROM ukoly WHERE id = ?");
		$dotaz->execute([$this->id]);
	}