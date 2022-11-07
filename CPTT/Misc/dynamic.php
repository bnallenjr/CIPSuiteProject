 <?php  
 function load_country()  
 {  
      $connect = mysqli_connect("localhost", "root", "my*password", "test");  
      $output = '';  
      $sql = "SELECT * FROM tbl_country ORDER BY country_name";  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<option value="'.$row["country_id"].'">'.$row["country_name"].'</option>';  
      }  
      return $output;  
 }  
 ?>  
 <html>  
      <head>  
           <title>Webslesson Tutorial</title>  
           <script src="jquery.js"></script>  
      </head>  
      <body>  
           <p>Select Country  
           <select name="country" id="country">  
                <option value="">Select Country</option>  
                <?php echo load_country(); ?>  
           </select></p>  
           <p>Select State  
           <select name="state" id="state">  
                <option value="">Select State</option>  
           </select></p>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#country').change(function(){  
           var country_id = $(this).val();  
           $.ajax({  
                url:"fetch_state.php",  
                method:"POST",  
                data:{countryId:country_id},  
                dataType:"text",  
                success:function(data)  
                {  
                     $('#state').html(data);  
                }  
           });  
      });  
 });  
 </script>   
