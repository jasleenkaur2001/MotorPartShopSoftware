<?php
include'../includes/connection.php';
session_start();

              $date = $_POST['date'];
              $customer = $_POST['customer'];
              $subtotal = $_POST['subtotal'];
              $lessvat = $_POST['lessvat'];
              $netvat = $_POST['netvat'];
              $addvat = $_POST['addvat'];
              $total = $_POST['total'];
              $cash = $_POST['cash'];
              $emp = $_POST['employee'];
              $rol = $_POST['role'];
              //imma make it trans uniq id
              $today = date("mdGis"); 
              
              $countID = count($_POST['name']);
              // echo "<table>";
              
              echo '<script>console.log("run")</script>';
              switch($_GET['action']){
                case 'add':  
                for($i=0;$i<$countID;$i++){
                  $product_name = $_POST['name'];
                  $product_code = $_POST['code'][$i];
                  $quantity_demand = $_POST['quantity'][$i];
                  $query = "SELECT * FROM product WHERE PRODUCT_CODE = '$product_code'";
                  $result = mysqli_query($db, $query);
                  $product = mysqli_fetch_assoc($result);
                  if($product['QTY_STOCK'] < $quantity_demand){
                    echo '<script>alert("only '.$product['QTY_STOCK'].' number of '.$product['NAME'].' is available")</script>';
                   echo "<script>
                   window.location = 'pos.php';
                 </script>";
                    exit(); 
                  }
                }
                for($i=1; $i<=$countID; $i++)
                  {
                    // echo "'{$today}', '".$_POST['name'][$i-1]."', '".$_POST['quantity'][$i-1]."', '".$_POST['price'][$i-1]."', '{$emp}', '{$rol}' <br>";
                    $product_code = $_POST['code'][$i-1];
                    $quantity_demand = $_POST['quantity'][$i-1];
                    
                    $query_select= "SELECT * FROM product WHERE PRODUCT_CODE = '$product_code'";
                    $res = mysqli_query($db, $query_select);
                    $product = mysqli_fetch_assoc($res);
    
                    $quantity_STOCK = $product['QTY_STOCK'];
                    $quantity_available = $quantity_STOCK-$quantity_demand;
                    
                    $update_query = "UPDATE product SET QTY_STOCK = '$quantity_available' , ON_HAND = '$quantity_available'  WHERE PRODUCT_CODE = '$product_code'";
                    mysqli_query($db,$update_query);
                    $query = "INSERT INTO `transaction_details`
                               (`ID`, `TRANS_D_ID`, `PRODUCTS`, `QTY`, `PRICE`, `EMPLOYEE`, `ROLE`)
                               VALUES (Null, '{$today}', '".$_POST['name'][$i-1]."', '".$_POST['quantity'][$i-1]."', '".$_POST['price'][$i-1]."', '{$emp}', '{$rol}')";

                    mysqli_query($db,$query)or die (mysqli_error($db));

                    }
                    $date_curr = date("d/m/Y");
                    $query111 = "INSERT INTO `transaction`
                               (`TRANS_ID`, `CUST_ID`, `NUMOFITEMS`, `SUBTOTAL`, `LESSVAT`, `NETVAT`, `ADDVAT`, `GRANDTOTAL`, `CASH`, `DATE`, `TRANS_D_ID`)
                               VALUES (Null,'{$customer}','{$countID}','{$subtotal}','{$lessvat}','{$netvat}','{$addvat}','{$total}','{$cash}','{$date_curr}','{$today}')";
                               print($date);
                    mysqli_query($db,$query111)or die (mysqli_error($db));

                break;
              }
                    unset($_SESSION['pointofsale']);
               ?>
              <script type="text/javascript">
                alert("Success.");
                window.location = "pos.php";
              </script>
          </div>



























<?php
              // switch($_GET['action']){
              //   case 'add':     
              //       $query = "INSERT INTO transaction_details
              //                  (`ID`, `PRODUCTS`, `EMPLOYEE`, `ROLE`)
              //                  VALUES (Null, 'here', '{$emp}', '{$rol}')";
              //       mysqli_query($db,$query)or die ('Error in Database '.$query);
              //       $query2 = "INSERT INTO `transaction`
              //                  (`TRANS_ID`, `CUST_ID`, `SUBTOTAL`, `LESSVAT`, `NETVAT`, `ADDVAT`, `GRANDTOTAL`, `CASH`, `DATE`, `TRANS_D_ID`)
              //                  VALUES (Null,'{$customer}','{$subtotal}','{$lessvat}','{$netvat}','{$addvat}','{$total}','{$cash}','{$date}','{$today}'')";
              //       mysqli_query($db,$query2)or die ('Error in updating Database2 '.$query2);
              //   break;
              // }

              // mysqli_query($db,"INSERT INTO transaction_details
              //                 (`ID`, `PRODUCTS`, `EMPLOYEE`, `ROLE`)
              //                 VALUES (Null, 'a', '{$emp}', '{$rol}')");

              // mysqli_query($db,"INSERT INTO `transaction`
              //                 (`TRANS_ID`, `CUST_ID`, `SUBTOTAL`, `LESSVAT`, `NETVAT`, `ADDVAT`, `GRANDTOTAL`, `CASH`, `DATE`, `TRANS_DETAIL_ID`)
              //                 VALUES (Null,'{$customer}',{$subtotal},{$lessvat},{$netvat},{$addvat},{$total},{$cash},'{$date}',(SELECT MAX(ID) FROM transaction_details))");

              // header('location:posdetails.php');

            ?>
<!--  <script type="text/javascript">
      alert("Transaction successfully added.");
      window.location = "pos.php";
      </script> -->