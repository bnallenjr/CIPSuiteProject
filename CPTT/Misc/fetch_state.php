 <?php  
 //fetch_state.php  
 $connect = mysqli_connect("localhost", "root", "my*password", "test");  
 $output = '';  
 $sql = "SELECT * FROM tbl_state where country_id = '".$_POST["countryId"]."' ORDER BY state_name";  
 $result = mysqli_query($connect, $sql);  
 $output = '<option value="">Select State</option>';  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '<option value="'.$row["state_id"].'">'.$row["state_name"].'</option>';  
 }  
 echo $output;  
 ?> 