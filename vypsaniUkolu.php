			
	<div class="task-box">
		<div class="task-head">
			<span class="date"><?php echo $polozka['termin'];?></span>
			<span class="category"><?php echo $polozka['kategorie'];?></span>
		</div>
		<p class="task"><?php echo $polozka['ukol'];?></p>
		<div class="task-bottom">
			<input type="checkbox" class="checkbox">
			<form method="post">
				<button type="submit" name="delete" value="<?php echo $polozka['id'];?>" id="delete"> 
					<i class="fa-solid fa-xmark"></i>
				</button>
			</form>
		</div>
	</div>
<?php 

