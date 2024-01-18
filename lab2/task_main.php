<!DOCTYPE html>
<html>
<head>
	
	<style>
a {
    text-decoration: none !important;
    padding: 10px;
    background-color: transparent;
    transition: .2s
}
.active a {
    text-decoration: none !important;
    padding: 10px;
    background-color: Gray;
    color: White !important;
    transition: .2s
}

a:hover,
.active a:hover {
    background-color: Gray;
}
	</style>
</head>
<body>
	<?php
		$menu_items = array(
			"О компании",
			"Услуги",
			"Прайс",
			"Контакты"
		);
		if (!isset($_GET['active'])) {
			$_GET['active'] = 0;
		}
		for ($i = 0; $i < count($menu_items); $i++) {
			if ($i == $_GET['active']) {
				echo '<span class="active">';
			}
			echo '<a href="?active='.$i.'">'.$menu_items[$i].'</a>';
			if ($i == $_GET['active']) {
				echo '</span>';
			}
		}
	?>
</body>
</html>
