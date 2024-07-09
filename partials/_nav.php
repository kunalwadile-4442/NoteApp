<?php 
session_start();

$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true;

echo '

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/gernalapp">Note App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/gernalapp/note.php">Home</a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="/gernalapp/about.php">About us</a>
      </li>
     
    </ul>';

echo '<ul class="navbar-nav ml-auto">';

if (!$loggedin) {
    echo ' 
      <li class="nav-item">
        <a class="btn btn-primary mx-2" href="/gernalapp/index.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="btn btn-success mx-2" href="/gernalapp/signup.php">Signup</a>
      </li>';
}

if ($loggedin) {
    echo '
      <li class="nav-item">
        <a class="btn btn-danger" href="/gernalapp/logout.php">Logout</a>
      </li>';
}

echo '
    </ul>
  </div>
</nav>';
?>
