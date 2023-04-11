
<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?><?php 
echo "<script>console.log('Debug Objects: " . $_GET['id'] . "' );</script>";
    			$query = 'DELETE FROM Product WHERE PRODUCT_CODE = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));				
            ?>
    			<script type="text/javascript">alert("Spare Part Successfully Deleted.");window.location = "spare_parts.php";</script>					
            <?php
    			//break;
            
	
?>