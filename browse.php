<?php
  include('includes/includedFiles.php');
?>

<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">

  <?php
    $stmt = $con->query("SELECT * FROM albums ORDER BY RAND() LIMIT 10");
    foreach ($stmt as $row) {
      $artPath = $row['artworkPath'];

      echo "<div class='gridViewItem'>
              <span onclick='openPage(\"album.php?id=". $row['id'] ."\")'>
                <img src='$artPath'></img> " .
                  "<div class='gridViewInfo'>"
                    . $row['title'] .
                  "</div>
                </span>
            </div>";
    }
  ?>

</div>
