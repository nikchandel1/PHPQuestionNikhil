<!DOCTYPE html>
<html>
<head>
	<title>php demo</title>
</head>
<body>
	<?php if(!empty($_POST['product_txt'])) {

		$products = preg_replace('/\s/', '', strtoupper($_POST['product_txt'])); // Caps and Remove whitespaces
		$length = strlen($products);
		if(!$length) {
			echo 'Invalid Input';
		}else {
			require_once('SaleTerminal.class.php');
			$terminal = new SaleTerminal;
			$terminal->setPricing();
			for($i=0; $i<strlen($products); $i++) {
				$terminal->scan($products[$i]);
			}
			list($prices, $total, $free_products) = $terminal->total();
			require('receipt.tmpl.php');
		}
	}else {?>
	
	<h1>Question</h1>
	<form method="post" action="">
		<input type="text" name="product_txt" />
		<button type="submit" name="submit">Submit</button>
	</form>
	<?php }?>
</body>
</html>