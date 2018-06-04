<?php
  include("includes/includedFiles.php");

  if(isset($_GET['id'])) {
    $artistId = $_GET['id'];
  } else {
    header("Location: index.php");
  }

  $artist = new Artist($con, $artistId);
?>

<div class="entityInfo borderBottom">

  <div class="centerSection">

    <div class="artistInfo">
      <h1 class="artistName"><?php echo $artist->getName(); ?></h1>
      <div class="headerButtons">
        <button type="button" name="button" class="button green" onclick="playArtistSong()">PLAY</button>
      </div>
    </div>

  </div>

</div>

<div class="artistInfoContainer">
  <div class="listHeading artistTracks">
    <h1>Popular</h1>
  </div>
  <div class="trackListContainer borderBottom">
    <ul class="trackList">
      <?php
        $songIdArray = $artist->getSongIds();

        $i=1;
        foreach ($songIdArray as $songId) {

          if ($i > 5) {
            break;
          }

          $albumSong = new Song($con, $songId);
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
      ?>
    </ul>
    <script type="text/javascript">
      var songAsIDs = '<?php echo json_encode($songIdArray); ?>';
      tempPlaylist = JSON.parse(songAsIDs);
    </script>
  </div>

</div>

<div class="albumInfoContainer">
  <div class="listHeading artistAlbums">
    <h1>Albums</h1>
  </div>
  <div class="gridViewContainer">
    <?php
      $stmt = $con->query("SELECT * FROM albums WHERE artist=$artistId");
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
</div>

<nav class="optionsMenu">
  <input type="hidden" class="songId"></input>
  <!-- calling without instance -->
  <?php echo Playlist::getPLaylistsDropdown($con, $userLoggedIn); ?>
  <div class="item copySong">
      Generate song link
  </div>
  <div class="item download">
    Download song
  </div>
</nav>
