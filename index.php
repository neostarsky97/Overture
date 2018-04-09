<?php include('includes\header.php'); ?>

<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">

  <?php
    $stmt = $con->query("SELECT * FROM albums ORDER BY RAND() LIMIT 10");
    foreach ($stmt as $row) {
      $artPath = $row['artworkPath'];

      echo "<div class='gridViewItem'>
              <a href='album.php?id=". $row['id'] ."'>".
                "<img src='$artPath'></img> " .
                  "<div class='gridViewInfo'>"
                    . $row['title'] .
                  "</div>
                </a>
            </div>";
    }
  ?>

</div>
<?php include('includes\footer.php'); ?>
