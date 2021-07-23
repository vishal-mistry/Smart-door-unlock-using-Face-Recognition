
<!DOCTYPE html>
<html>
<head>
	<title>Automatic Door Unlock system</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


<style>

body {
background-color: #212121;
}

div.gallery {
  margin: 5px;
  float: left;
  width: 250px;
}


div.gallery img {
  width: auto;
  height: auto;
}

</style>
   
</head>
<body>
<br>
<a class="waves-effect waves-light btn-large" href="faceauth.php">Go Back</a>
<br>
<br>
<br>

<a class="waves-effect waves-light btn-large" href="blocked.php">Refresh</a>


<div class='container' style='margin-top: 100px;'><h3 style='color: white'><b>List of Blocked Entries through the door as they were Unauthorized:</b></h3><br>


<?php

$rfiles = glob("Unauthorized/*.*");
$files = array_reverse($rfiles);
for ($i = 0; $i < count($files); $i++) {
    $image = $files[$i];
    $j=$i+1;
    $title = "Entry ".$j;
    

    $flnm = basename($image); //filename
    $year = substr($flnm,6,4);
    $month = substr($flnm,11,2);
    $day = substr($flnm,14,2);
    $time = substr($flnm,17,8);
    $date = $day."-".$month."-".$year;



    echo '<div class="gallery"><div class="card"><div class="card-image waves-effect waves-block waves-light">
    <img class="activator" src="'. $image .'" width="800" height="450">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4"><b>'.$title.'</b></span>
      <p><a target="_blank" href="'.$image.'">Open Image</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Details:</span>
      <p>The attempted entry was made on:<br><strong>'.$date.' <br>at<br> '.$time.'</strong></p>
    </div>
  </div>
  </div>';

}

?>



</div>



</body>
</html>



