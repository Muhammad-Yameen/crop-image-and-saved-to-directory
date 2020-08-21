<?php 

require 'usefull.php';
$useFul = new UseFullFunctions();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Crop</title>
	<?php require 'assets.php';?>
</head>
<body>

<div class="container-fluid">
  <div class="jumbotron">
    <h1>Crop Image and saved to directory</h1>
    <p>The simple code for Croping Image and saved to your directory.</p>
  </div>

<header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="./">BytechSolution</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="<?php echo $page == 'home' ? 'active':'' ?>"><a href="./">Home</a></li>
      <li class="<?php echo $page == 'files' ? 'active':'' ?>"><a href="files.php">Filemanager</a></li>
    </ul>
  </div>
</nav>
</header>