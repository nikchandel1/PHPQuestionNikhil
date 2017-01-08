<table align="center">
	<thead>
		<tr><th colspan="2" align="center">Purchase Details<br />(<?php echo $products;?>)<hr style="border-top: dotted 1px;" /></th></tr>
	</thead>
	<tbody>
		<tr>
			<td><u>Product Code</u></td>
			<td><u>Price</u></td>
		</tr>
		<?php foreach($prices AS $product=>$price) {?>
		<tr>
			<td width="200"><?php echo $product;?></td>
			<td><?php echo $price;?></td>
		</tr>
		<?php }?>
	</tbody>
	<tfoot>
		<tr><td colspan="2" align="center"><hr style="border-top: dotted 1px;" /></td></tr>
		<tr>
			<td><strong>Total</strong></td>
			<td><strong><?php echo $total;?></strong></td>
		</tr>
		<tr><td colspan="2" align="center"><hr style="border-top: dotted 1px;" /></td></tr>
		
		<?php if(sizeof($free_products) > 0) {?>
		<tr><td colspan="2">Free Products: <?php echo implode(', ', $free_products);?></td></tr>
		<tr><td colspan="2" align="center"><hr style="border-top: dotted 1px;" /></td></tr>
		<?php }?>
	</tfoot>
</table>		
<div style="text-align:center;"><a href="index.php">Next Checkout</a>