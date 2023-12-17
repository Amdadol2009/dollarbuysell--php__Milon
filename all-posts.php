<div class="">
	<div class="row">
		<div class="col-12 col-sm-4">
			<?php
			if (isset($_GET['posts'])) {
				if (!isset($_GET['edit'])) {
					include 'add-post.php';
				} else {
					include 'edit-post.php';
				}
			}
			?>
		</div>
		<div class="col-12 col-sm-8">
			<?php
				include 'posts.php';
			?>
		</div>
	</div>
</div>