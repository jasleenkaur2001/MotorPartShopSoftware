<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $pc = $_POST['prodcode'];
              $name = $_POST['name'];
              $desc = $_POST['description'];
              $qty = $_POST['quantity'];
              $oh = $_POST['onhand'];
              $pr = $_POST['price']; 
              $cat = $_POST['category'];
              $supp = $_POST['supplier'];
              $dats = $_POST['datestock']; 
        
              switch($_GET['action']){
                case 'add':  
                for($i=0; $i < $qty; $i++){
                    $query = "INSERT INTO product
                              (PRODUCT_ID, PRODUCT_CODE, NAME, DESCRIPTION, QTY_STOCK, ON_HAND, PRICE, CATEGORY_ID, SUPPLIER_ID, DATE_STOCK_IN)
                              VALUES (Null,'{$pc}','{$name}','{$desc}',1,1,{$pr},{$cat},{$supp},'{$dats}')";
                    mysqli_query($db,$query)or die ('Error in updating product in Database '.$query);
                    }
                    $date_curr = date("d/m/Y");
                    // $query_supply = "INSERT INTO supply values (rand(),'{$supp}','{$name}','{$qty}','{$pr}', '{$date_curr}'";
                    $random_number = rand(100,999);
                    
                      $query_supply = "INSERT INTO `supply` (`TRANSACTION_ID`, `SUPPLIER_ NAME`, `PART_NAME`, `QUANTITY`, `PRICE`, `DATE`) VALUES ($random_number, '{$supp}','{$name}','{$qty}','{$pr}', '{$date_curr}');";
                    mysqli_query($db,$query_supply)or die ('Error in updating product in Database '.$query_supply);
                // $query = "INSERT INTO product
                //               (PRODUCT_ID, PRODUCT_CODE, NAME, DESCRIPTION, QTY_STOCK, ON_HAND, PRICE, CATEGORY_ID, SUPPLIER_ID, DATE_STOCK_IN)
                //                VALUES (Null,'{$pc}','{$name}','{$desc}',{$qty},1,{$pr},{$cat},{$supp},'{$dats}')";
                //                mysqli_query($db,$query)or die ('Error in updating product in Database '.$query);
                break;
              }
            ?>
              <script type="text/javascript">window.location = "spare_parts.php";</script>
          </div>

<?php
include'../includes/footer.php';
?>