<?php include('includes\includedFiles.php');

if (isset($_GET['id'])) {
  $albumId = $_GET['id'];
} else {
  header("Location: index.php");
}

$album = new Album($con, $albumId);
$artist = $album->getArtist();

?>

<div class="entityInfo">

  <div class="leftSection">
    <img src="<?php echo $album->getArtworkPath(); ?>" alt="Album Artwork">
  </div>

  <div class="rightSection">
    <h2><?php echo $album->getTitle(); ?></h2>
    <p><?php echo $artist->getName(); ?></p>
    <p><?php echo $album->getNumberOfSongs() . " songs"; ?></p>
  </div>

</div>

<div class="trackListContainer">
  <ul class="trackList">
    <?php
      $songIdArray = $album->getSongIds();

      $i=1;
      foreach ($songIdArray as $songId) {
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

<nav class="optionsMenu">
  <input type="hidden" class="songId"></input>
  <?php echo Playlist::getPLaylistsDropdown($con, $userLoggedIn); ?>
  <div class="item">
      Copy song link
  </div>
  <div class="item">
    Share song link
  </div>
  <div class="item download">
    Download song
  </div>
</nav>
