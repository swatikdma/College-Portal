<?php 
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true) 
{
    header("location: courses.php");
    exit;
}
require "partials/_dbconnect.php";
require 'partials/_nav.php';  
if(isset($_GET['view']))
{
  $sno = $_GET['view'];
  $sql = "SELECT * FROM `courses` WHERE `Course_id` = '$sno'";
  $result = mysqli_query($link,$sql);
  if($result)
  {
           $row = mysqli_fetch_assoc($result);
           echo"<h1 style='margin-left:40%;margin-top:3%'>".$row['Course_name']."</h1>
        
           <div class='container' style:'margin-left=17%'>
           <p><span style='font-weight: bold;'>Course Name:</span> ".$row['Course_name'] ."(".$row['Course_id'].")</p><br>
           <p><span style='font-weight: bold;'>Programme:</span> ".$row['Programme']."</p><br>
           <p><span style='font-weight: bold;'>Semester:</span> ".$row['Semester']."</p><br>
           <p><span style='font-weight: bold;'>Category:</span> ".$row['Category']."</p><br>
           <p><span style='font-weight: bold;'>Credits:</span> ".$row['Credits']."</p><br>
           <p><span style='font-weight: bold;'>Content:</span><br> ".$row['Content']."</p><br>
           <p><span style='font-weight: bold;'>References:</span><br> ".$row['References']."</p><br>
           <p><span style='font-weight: bold;'>Department:</span> ".$row['Department']."</p><br>
           </div>
           ";
          
  }
  else{
    echo "Note has not been deleted from the iNote<br>";
  }
}
if(isset($_POST['snoEdit']))
  {
    // update the note
    $id = $_POST['Course_idEdit'];
    $Programme1 = $_POST['ProgrammeEdit'];
    $Semester1 = $_POST['SemesterEdit'];
    $Content1 = $_POST['ContentEdit'];
    $Category1 = $_POST['CategoryEdit'];
    $Credit1 = $_POST['CreditEdit'];
    $References1 = $_POST['ReferencesEdit'];
    $sql = "UPDATE `courses` SET `Credits` = '$Credit1' , `Programme` = '$Programme1' , `Semester` = '$Semester1', `Category` = '$Category1', `Content` = '$Content1', `References` = '$References1' WHERE `courses`.`Course_id` = '$id'";
    $result = mysqli_query($link,$sql);
    if($result)
    {
      $update =true;
    }
    else{
      echo "Note has not been submited from the iNote<br>";
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" 
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
          crossorigin="anonymous">
    <link rel="stylesheet" 
          href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
          <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <title>Courses</title>
    
  </head>
  <body> 
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this Course </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action ="/college/courses.php" method="post">
      <div class="modal-body">
      <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="Course_nameEdit">Course_name</label>
              <input type="text" class="form-control" id="Course_nameEdit" name="Course_nameEdit" >
            </div>
            <div class="form-group">
              <label for="Course_idEdit">Course_id</label>
              <input type="text" class="form-control" id="Course_idEdit" name="Course_idEdit" >
            </div>
            <div class="form-group">
              <label for="ProgrammeEdit">Programme</label>
              <input type="text" class="form-control" id="ProgrammeEdit" name="ProgrammeEdit" >
            </div>
            <div class="form-group">
              <label for="SemesterEdit">Semester</label>
              <input type="text" class="form-control" id="SemesterEdit" name="SemesterEdit">
            </div>
            <div class="form-group">
              <label for="CreditEdit">Credit</label>
              <input type="text" class="form-control" id="CreditEdit" name="CreditEdit">
            </div>
            <div class="form-group">
              <label for="CategoryEdit">Category</label>
              <input type="text" class="form-control" id="CategoryEdit" name="CategoryEdit">
            </div>
            <div class="form-group">
              <label for="ContentEdit">Content</label>
              <textarea type="text" class="form-control" id="ContentEdit" name="ContentEdit" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="ReferencesEdit">References</label>
              <textarea type="text" class="form-control" id="ReferencesEdit" name="ReferencesEdit" rows="3"></textarea>
            </div>
          
      </div>
      <div class="modal-footer d-block mr-auto">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
     <div class="container my-3" >
        
        <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="undergraduate-tab" data-toggle="tab" href="#undergraduate" role="tab" aria-controls="undergraduate" aria-selected="true">Undergraduate</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="postgraduate-tab" data-toggle="tab" href="#postgraduate" role="tab" aria-controls="postgraduate" aria-selected="false">Postgraduate</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="doctoral-tab" data-toggle="tab" href="#doctoral" role="tab" aria-controls="contact" aria-selected="false">Doctoral</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="undergraduate" role="tabpanel" aria-labelledby="undergraduate-tab">
<div id="undergraduate" class="tabcontent" >
<br>

<form action ="/college/courses.php" method="post">
<ul class="nav nav-tabs">
<li>
<label for="semester">Semester</label>
  <select name="semester" id="semester">
        <option value="">Any</option>
        <option value="Third">Third</option>
        <option value="Fourth">Fourth</option>
        <option value="fiveth">fiveth</option>
        <option value="sixth">Sixth</option>
        <option value="seventh">Seventh</option>
        <option value="eighth">Eighth</option>
        </select>
        </li><li>
        <label for="category">Category</label>
        <select name="category" id="category">
        <option value="">Any</option>
        <option value="Programme Core (PC)">Programme Core (PC)</option>
        <option value="Programme Major Project (PMP)">Programme Major Project (PMP)</option>
        <option value="Engineering Science Core (ESC)">Engineering Science Core (ESC)</option>
        <option value="Open Electives (OE)">Open Electives (OE)</option>
        </select>
        </li><li>
        <select style="display:none" name="programme" id="programme">
        <option value="B.Tech"></option>
        </select>
        </ul>
  <input type="submit" value="Submit" name="SubmitBtn">
            </form>
           
</div>

  </div>
  <div class="tab-pane fade" id="postgraduate" role="tabpanel" aria-labelledby="postgraduate-tab">
  <div id="postgraduate" class="tabcontent">
<br>
<ul class="nav nav-tabs">
<!-- 
<li>
        <label for="branch">Programme</label>
        <select name="branch" id="branch">
        <option value="">Any</option>
        <option value="M.Tech (CSE)">M.Tech (CSE)</option>
        <option value="M.Tech (CSE-IS)">M.Tech (CSE-IS)</option>
        </select> 
        </li>-->
<li>
<form action ="/college/courses.php" method="post">
<label for="semester">Semester</label>
  <select name="semester" id="semester">
        <option value="">Any</option>
        <option value="Third">First</option>
        <option value="Third">Second</option>
        <option value="Third">Third</option>
        <option value="Fourth">Fourth</option>
        </select>
        </li><li>
        <label for="category">Category</label>
        <select name="category" id="category">
        <option value="">Any</option>
        <option value="Programme Core (PC)">Programme Core (PC)</option>
        <option value="Programme Major Project (PMP)">Programme Major Project (PMP)</option>
        <option value="Engineering Science Core (ESC)">Engineering Science Core (ESC)</option>
        <option value="Elective Courses (Ele)">Elective Courses (Ele)</option>
        </select>
        </li>
        <select style="display:none" name="programme" id="programme">
        <option value="M.Tech"></option>
        </select>
        </ul>
        <input type="submit" value="Submit" name="SubmitBtn">
            </form>
</div>

  </div>
  <div class="tab-pane fade" id="doctoral" role="tabpanel" aria-labelledby="doctoral-tab">
  <div id="doctoral" class="tabcontent">
  
<form action ="/college/courses.php" method="post">
        <select style="display:none" name="programme" id="programme">
        <option value="Ph.D"></option>
        </select>
        <input type="submit" value="Submit" name="SubmitBtn">
            </form>
</div>              
     
  </div>        
  </div>
  </div>
  <div class="container my-4">    
          <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.NO</th>
      <th scope="col">Course_Id</th>
      <th scope="col">Course_name</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php 
          //$Programme = "abc";
          require "partials/_dbconnect.php";
          if($_SERVER['REQUEST_METHOD'] =="POST" && isset($_POST['programme']))
          {
            $Programme = $_POST['programme'];
            //$Programme = "B.Tech";
            if($Programme == "Ph.D")
            $sql= "SELECT * FROM `courses` WHERE `Programme` LIKE '$Programme' ";
            else if( $Programme == "B.Tech" || $Programme == "M.Tech") 
            {
              if($_POST['semester']=="" && $_POST['category']=="" )
              {
                $sql= "SELECT * FROM `courses` WHERE `Programme` LIKE '$Programme'";
              }
              else if($_POST['category']=="")
              {
                $Semester = $_POST['semester'];
                $sql= "SELECT * FROM `courses` WHERE `Programme` LIKE '$Programme' AND `Semester` LIKE '$Semester' ";
              }
              else if($_POST['semester']=="")
              {
                $Category = $_POST['category'];
                $sql= "SELECT * FROM `courses` WHERE `Programme` LIKE '$Programme' AND `Category` LIKE '$Category'";
              }
              else
              {
                $Semester = $_POST['semester'];
                $Category = $_POST['category'];
                $sql= "SELECT * FROM `courses` WHERE `Programme` LIKE '$Programme' AND `Semester` LIKE '$Semester' AND `Category` LIKE '$Category'";
              }
            }
            $result= mysqli_query($link,$sql);
            $sno=0;
             while($row = mysqli_fetch_assoc($result))
             {
               $sno++;
               echo " <tr>
               <th scope='row'>".$sno."</th>
               <td>".$row['Course_id']."</td>
               <td>".$row['Course_name']."</td>
               <td><button class='view btn btn-sn btn-primary' id=".$row['Course_id'].">View</button>   
               ";
               ;
              if($_SESSION['role']=='people')
              {
                echo"         
                <button class='edit btn btn-sn btn-primary' id=".$row['Course_id'].">Edit</button>";
              }
              echo"</td></tr>";
              
             }
          }
          
          ?>


  </tbody>

</table>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
          $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>
    <script>
      views = document.getElementsByClassName('view');
      Array.from(views).forEach((element)=>{
        element.addEventListener("click",(e)=>{
            sno = e.target.id;
            window.location = `/college/courses.php?view=${sno}`;
        })
      })
      function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("nav-link");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
        element.addEventListener("click",(e)=>{
            sno = e.target.id.substr(1,);
            if(confirm("Are you Sure? Do you want to delete this !"))
            {
                window.location = `/college/courses.php?delete=${sno}`;
            }
        })
      })
      edits = document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
            tr = e.target.parentNode.parentNode;
            snoEdit.value = e.target.id;
            Course_id  = tr.getElementsByTagName("td")[0].innerText;
            Course_name = tr.getElementsByTagName("td")[1].innerText;
            Course_idEdit.value = Course_id;
            Course_nameEdit.value = Course_name;
            $('#editModal').modal('toggle');
        })
      })
      </script>
      
    <?php 
    require 'partials/_footer.php'; 
    ?>
  </body>
</html>