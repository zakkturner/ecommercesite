<?php
 require_once '../core/init.php';
 $id = $_POST['id'];
 $id = (int)$id;
 $sql = "select * from products where id = '$id'";
 $result = $db->query($sql);
 $product = mysqli_fetch_assoc($result);
 $brand_id = $product['brand'];
 $sql = "select brand from brand where id = '$brand_id'";
 $brand_query = $db->query($sql);
 $brand = mysqli_fetch_assoc($brand_query);
 $sizestring = $product['sizes'];
 $size_array = explode(',', $sizestring);
?>


<!-- Details Modal -->
<?php ob_start(); ?>
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center"><?php echo $product['title']; ?></h4>
         </div>
         <div class="modal-body">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-6">
                     <div class="center-block"><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>" class="details img-responsive"></div>
                  </div>
                  <div class="col-sm-6">
                     <h4>Details</h4>
                     <p><?php echo $product['description']; ?></p>
                     <hr>
                     <p>Price: <?php echo "$". $product['price']; ?></p>
                     <p>Brand: <?php echo $brand['brand']; ?></p>
                     <form action="add-cart.php" method="post">
                        <div class="form-group">
                           <div class="row">
                              <div class="col-xs-3">
                                 <label for="quantity">Quantity</label>
                                 <input type="text" name="quantity" class="form-control" id="quantity"><br>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="size">Size:</label>
                           <select name="size" id="size" class="form-control">
                              <option value="">Chose size</option>
                              <?php
                                 foreach ($sizes_array as $size_string) {
                                    $size_string_array = explode(":", $size_string);
                                    $size = $size_string_array[0];
                                    $quantity = $size_string_array[1];
                                    echo '<option value="'.$size.'">'.$size.' ('.$quantity.' Available)</option>';
                                 }
                              ?>
                           </select>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
         </div>
      </div>
   </div>
</div>
<script>
   // remove #details-modal and .modal-backdrop modal closed
   $("#details-modal").on('hidden.bs.modal', function () {
      $('#details-modal').remove();
      $('.modal-backdrop').remove();
   });

</script>
<?php echo ob_get_clean(); ?>
