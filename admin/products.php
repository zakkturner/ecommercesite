<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/newecom/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
if (isset($_GET['add'])) {
	
}
?> 
	<h2 class="text-center">Add a New Product</h2>
	<form action="products.php?add=1" method="POST" enctype="multipart/form-data">
		<div class="form-group col-md-3">
			<label for="title">Title*:</label>
			<input type="text" name="title" id="title" value="<?=((isset($_POST['title']))?sanitize($_POST['title']):'')?>">
		</div>
	</form>
<?php else{

$sql = "SELECT * FROM products WHERE deleted = 0";
$presults = $db->query($sql);
if (isset($_GET['featured'])) {
	$id = (int)$_GET['id'];
	$featured = (int)$_GET['featured'];
	$featuredsql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
	$db->query($featuredsql);
	header('Location: products.php');
}

?>


<h2 class="text-center">Products</h2>
<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add Product</a><div class="clearfix"></div>
<hr>

<table class="table table-bordered table-condensed table-striped">
	<thead>
		<th></th>
		<th>Product</th>
		<th>Price</th>
		<th>Categories</th>
		<th>Featured</th>
		<th>Sold</th>
	</thead>
	<tbody>
		<?php while($product = mysqli_fetch_assoc($presults)) : 
			$childID = $product['categories'];
			$catSql = "SELECT * FROM categories WHERE id = '$childID'";
			$result = $db->query($catSql);
			$child = mysqli_fetch_assoc($result);
			$parentID = $child['parent'];
			$pSql = "SELECT * FROM categories WHERE id = '$parentID'";
			$presult = $db->query($pSql);
			$parent = mysqli_fetch_assoc($presult);
			$category = $parent['category'] .' ~ '.$child['category'];
		?>
			<tr>
				<td>
					<a href="products.php?edit=<?=$product['id'];?>" class="btn btn-xs btn default"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="products.php?delete=<?=$product['id'];?>" class="btn btn-xs btn default"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
				<td><?=$product['title'];?></td>
				<td><?=money($product['price']);?></td>
				<td><?= $category;?></td>
				<td><a href="products.php?featured=<?=(($product['featured'] == 0)?'1':'0');?>&id=<?=$product['id'];?>" class="btn btn-xs btn-default">
						<span class="glyphicon glyphicon-<?=(($product['featured']==1)?'minus':'plus');?>"></span>
					</a>&nbsp <?=(($product['featured']== 1)?'Featured Product':'');?>
				</td>
				<td>0</td>
			</tr>
		<?php endwhile ; ?>
	</tbody>
</table>

<?php }
include 'includes/footer.php';
?>