<?php 
$loggedin = false;
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) 
{
    $loggedin = true;
}
echo '


 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/college"><img src="https://cse.nitk.ac.in/sites/all/themes/tb_university/logo.png" class="d-inline-block align-top" alt=""></a>
  <div  style="margin-left: 20%";>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  </div>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="/college/index.php">HOME <span class="sr-only">(current)</span></a>
      </li>';
if(!$loggedin)
{
  echo '<li class="nav-item">
        <a class="nav-link" href="/college/login.php">LOGIN</a>
      </li>
        <li class="nav-item">
          <a class="nav-link" href="/college/signup.php">SIGNUP</a>
      </li>';
}  

if($loggedin)
{
    echo '
          <li class="nav-item">
              <a class="nav-link" href="/college/profile.php">PROFILE</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/college/courses.php">COURSES</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="/college/people.php">PEOPLE</a>
      </li>
          <li class="nav-item">
              <a class="nav-link" href="/college/placements.php">PLACEMENTS</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/college/logout.php">LOGOUT</a>
          </li>';
}

echo '</ul>
    
  </div>
</nav>';
?>