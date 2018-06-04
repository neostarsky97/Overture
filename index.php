<?php
  include('includes/includedFiles.php');
?>
<div class="songsContainer">
  <div class="listHeading songSearch">
    <h1>Top tracks</h1>
  </div>
  <div class="trackListContainer borderBottom">
    <ul class="trackList">
      <?php
        $songQuery = $con->query("SELECT id FROM songs ORDER BY plays DESC LIMIT 5");
        if ($songQuery->rowCount() == 0) {
          echo "<span class='noResults'> No songs in the database </span>";
        } else {
          $i=1;
          $songIdArray = array();
          while ($row = $songQuery->fetch(PDO::FETCH_ASSOC)) {
            array_push($songIdArray, $row['id']);
            $albumSong = new Song($con, $row['id']);
            $albumArtist = $albumSong->getArtist();
            $songDuration = ltrim($albumSong->getDuration(), '0:');
            echo "<li class='trackListRow'>
                    <div class='trackCount'>
                      <img src='assets/images/icons/play-white.png' alt='Play Button'
                        onclick='setTrack(\"". $albumSong->getId()."\", tempPlaylist, true)'>
                      <span class='number'>" . $i . "</span>
                    </div>

                    <div class='trackInfo'>
                      <span class='trackName'>" . $albumSong->getTitle() . "</span>
                      <span class='artistName'>" . $albumArtist->getName() . "</span>
                    </div>

                    <div class='trackOptions'>
                      <input type='hidden' class='songId' value='" .$albumSong->getID() ."'>
                      <img class='optionsButton' src='assets/images/icons/more.png' onclick='showOptionsMenu(this)'>
                    </div>

                    <div class='trackDuration'>
                      <span> " . $songDuration . "</span>
                    </div>
                  </li>";
            $i++;
          }
        }
      ?>
    </ul>
    <script type="text/javascript">
      var songAsIDs = '<?php echo json_encode($songIdArray); ?>';
      tempPlaylist = JSON.parse(songAsIDs);
    </script>
  </div>
</div>

<nav class="optionsMenu">
  <input type="hidden" class="songId"></input>
  <?php echo Playlist::getPLaylistsDropdown($con, $userLoggedIn); ?>
  <div class="item copySong">
      Generate song link
  </div>
  <div class="item download">
    Download song
  </div>
</nav>
