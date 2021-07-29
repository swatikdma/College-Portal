<?php  
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) 
{
    header("location: people.php");
    exit;
}
require "partials/_dbconnect.php";
require 'partials/_nav.php';   ?>
<html>
    <head>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" 
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
          crossorigin="anonymous">
    <link rel="stylesheet" 
          href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
          <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
   <title> People</title>
    <script>
    function profile(p){
        createCookie("gfg", p , "2"); 
        //------------------------------------------------PATH OF PROFILE FILE
        window.location.href="/college/people_profile_display.php";
} 
   
// Function to create the cookie 
function createCookie(name, value, days) { 
    var expires; 
      
    if (days) { 
        var date = new Date(); 
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); 
        expires = "; expires=" + date.toGMTString(); 
    } 
    else { 
        expires = ""; 
    } 
      
    document.cookie = escape(name) + "=" +  
        escape(value) + expires + "; people_profile.php"; 
} 
    </script>
    
        <style>
       .profile{width:70%;
        margin:auto;
    position:absolute;
    left: 20%;
    width:60%;
    height:18em;
    
    
                }
      
    .grid-container {
       text-align : left;
     display: grid;
    grid-template-columns: 1fr 1fr;
    padding:20px;
    grid-gap: 20px;
    font-family: Arial, Helvetica, sans-serif;
}

        </style>
    </head>
    <body>
    <br>
        <h1 style=" font-family: Arial, Helvetica, sans-serif;font-size:40px;text-align:center;">People</h1>
        <hr>  
    <div class="container">  
      <div class="row">    
            <?php
            //$sql    = "SELECT * FROM students WHERE ID='$ID'";
            $sql    = "SELECT * FROM people";
            $result = mysqli_query($link,$sql) or die(mysqli_error());
            while ($row    = mysqli_fetch_array($result)) {
                $ID      = $row['ID'];
                $Name    = $row['Name'];
                $Designation = $row['Designation'];$Achivements = $row['Achivements'];
                $image = $row['image']; ?>
  
                  <div class="col-md-3 mt-4" style="text-align:center;"><img src="data:image/jpeg;charset=utf8;base64,
                     <?php echo base64_encode($row['image']); ?>"
                        class="responsive" id="<?php echo $ID; ?>" style="border-radius: 25px;  box-shadow: 1px 1px 1px 1px;" width="100" 
                        height="100"  onclick="profile(this.id);"/> <br>
                        <?php echo  $Name;?><br><?php echo  $Designation;?> </div>
      
                  <?php } ?>
      </div>
    </div>
       <br>        
       
<?php 
    require 'partials/_footer.php'; 
    ?>
    </body>
</html>