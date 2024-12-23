				
	<div class="task-box">
		<div class="task-head">
			<span class="date"><?php echo $polozka['termin'];?></span>
			<span class="category"><?php echo $polozka['kategorie'];?></span>
		</div>
			<p class="task"><?php echo $polozka['ukol'];?></p>
			<input type="checkbox" class="checkbox">
			<span name="delete" id="delete"> <i class="fa-solid fa-xmark"></i></span>
	</div>
<?php 