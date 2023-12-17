<?php
$id = null;
$name = null;
$sell_price = null;
$buy_price = null;
$prefix = "BDT";
$min = "0";
$src = null;
$stock = 0;
include 'db.php';
?>

<!DOCTYPE html>
<html>

<?php
include './components/head.php';
?>

<body>
	<div class="container">
		<div class="flex between center" style="margin-top: 1rem; padding: 1.25rem; border:1px solid #ececec; border-radius: 6px 6px 0px 0px">
			<a href="./" class="site_title">
				<h1><?php echo SITE_TITLE; ?></h1>
			</a>
			<h2 style="font-weight: 300; color: orange; font-style:italic">CPanel</h2>
		</div>

		<nav class="navbar navbar-expand-lg bg-body-tertiary">
			<div class="container">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="./">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?posts">Posts</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?requests">Requests</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?users">Users</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="mb-3 mt-4">
			<?php if (!$_GET || isset($_GET['currency'])) : ?>
				<div class="row">
					<div class="col-12 col-sm-8">
						<?php
						if (!$_GET) {
							include 'requests.php';
						}
						if (isset($_GET['add'])) {
							include 'add-currency.php';
						}

						if (isset($_GET['edit'])) {
							include 'edit-currency.php';
						}
						?>
					</div>
					<div class="col-12 col-sm-4">
						<?php
						include 'currencies.php';
						?>
					</div>
				</div>
			<?php endif; ?>

			<?php
			if (isset($_GET['posts'])) {
				include 'all-posts.php';
			}
			?>

			<?php
			if (isset($_GET['requests'])) {
				include 'requests.php';
			}
			?>
			<?php
			if (isset($_GET['users'])) {
				include 'users.php';
			}
			?>

			<?php if (IS_LIVE) : ?>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
			<?php else : ?>
				<script src="./scripts/bootstrap.bundle.min.js"></script>
			<?php endif; ?>
		</div>
</body>

</html>