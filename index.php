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
		<div class="flex between center"
			style="margin-top: 1rem; padding: 1.25rem; border:1px solid #ececec; border-radius: 6px 6px 0px 0px">
			<a href="./" class="site_title">
				<h1 style="color:hsl(18.2deg 100% 58.63%);font-weight:bold">
					<?php echo SITE_TITLE; ?>
				</h1>
			</a>
			
			<a href="./"><img class="cpanel" src="./media/cpanel.png" alt="<?php echo SITE_TITLE; ?>"/></a>
		</div>

		<nav class="navbar navbar-expand-lg bg-body-tertiary" style=" border:1px solid #ececec;">
			<div class="container">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link <?php echo !$_GET ? 'active' : ''; ?>" aria-current="page"
								href="./">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo isset($_GET['posts']) ? 'active' : ''; ?>"
								href="?posts">Posts</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo isset($_GET['users']) ? 'active' : ''; ?>"
								href="?users">Users</a>
						</li>

						<li class="nav-item">
							<a class="nav-link <?php echo isset($_GET['currency']) ? 'active' : ''; ?>"
								href="?currency">Currencies</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo isset($_GET['settings']) ? 'active' : ''; ?>"
								href="?settings">Settings</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="mb-3 mt-4">
			<?php
			if (isset($_GET['currency'])) {
				if (isset($_GET['add'])) {
					include 'add-currency.php';
				}else if (isset($_GET['edit'])) {
					include 'edit-currency.php';
				}else{
					include 'currencies.php';
				}
			}

			if (isset($_GET['posts'])) {
				include 'all-posts.php';
			}

			if (!$_GET || isset($_GET['requests']) || isset($_GET['date'])) {
				include 'requests.php';
			}

			if (isset($_GET['users'])) {
				include 'users.php';
			}
			if (isset($_GET['settings'])) {
				include 'settings.php';
			}
			?>

		</div>

		<?php if (IS_LIVE): ?>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
				integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
				crossorigin="anonymous"></script>
		<?php else: ?>
			<script src="./scripts/bootstrap.bundle.min.js"></script>
		<?php endif; ?>

		<script>
			var toggleStats = function(id, user_id, row_id_x){
				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'exchanger/confirm.php', true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.onreadystatechange = function () {
					if (xhr.readyState === 4 && xhr.status === 200) {
						var res = xhr.response;
						console.log(res)
						if(res==true){
							document.getElementById(row_id_x).innerHTML = '<span class="material-icons">download_done</span>';
						}else{
							console.log('parseBoolean')
						}
					}
				};

				xhr.send('toggle-state&id='+id+'&user_id='+user_id);
				return false;
			}
		</script>
</body>

</html>