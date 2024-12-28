			
	<div class="task-box">
		<div class="task-head">
			<span class="date">
				<?php 
				$date = new DateTime($polozka['termin']);
				echo $date->format('d.m.Y');?></span>
			<span class="category"><?php echo $polozka['kategorie'];?></span>
		</div>
		<p class="task"><?php echo $polozka['ukol'];?></p>
		<div class="task-bottom">
			<input type="checkbox" class="checkbox">
			<form method="post" class="delete-form">
				<button type="submit" name="delete" value="<?php echo $polozka['id'];?>" class="delete-btn"> 
					<i class="fa-solid fa-xmark"></i>
				</button>
			</form>
		</div>
	</div>
<?php 

