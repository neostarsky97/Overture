<?php
  include('includes/includedFiles.php');
?>

<div class="playlistContainer">
    <div class="playlistHeader">
      <h1 class="playlistHeading">Playlists</h1>
      <div class="headerButtons">
        <button type="button" name="button" class="button green"
          onclick="createPlaylist()">NEW PLAYLIST</button>
      </div>
    </div>


    <div class="gridViewContainer">
      <?php
      $userId = $userLoggedIn->getUserID();
        $playlistQuery = $con->query("SELECT * FROM playlists WHERE user =  $userId");

        if ($playlistQuery->rowCount() == 0) {
          echo "No playlists found. Create a new one!";
        }
        foreach ($playlistQuery as $row) {

          $playlist = new Playlist($con, $row);

          echo "<div class='gridViewItem'
            onclick='openPage(\"playlist.php?id=" . $playlist->getId() . "\")'>
                  <div class='playlistIcon'>
                    <img src='assets\images\icons\playlist.png'></img>
                  </div>
                  <div class='gridViewInfo'>"
                    . $playlist->getName() .
                  "</div>
                </div>";
        }
      ?>
    </div>



  </div>

</div>
