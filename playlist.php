<?php include('includes\includedFiles.php');

if (isset($_GET['id'])) {
  $playlistId = $_GET['id'];
} else {
  header("Location: index.php");
}

$playlist = new Playlist($con, $playlistId);
$user = new User($con, $playlist->getUserName());
?>

<div class="entityInfo">

  <div class="leftSection">
    <div class="playlistIcon">
      <img src="assets/images/icons/playlist.png" alt="Album Artwork">
    </div>
  </div>

  <div class="rightSection">
    <h2><?php echo $playlist->getName(); ?></h2>
    <p>By <?php echo $user->getUserName(); ?></p>
    <p><?php echo $playlist->getNumberOfSongs() . " songs"; ?></p>
    <button type="button" class="button" name="button"
      onclick="deletePlaylist('<?php echo $playlistId ?>')">DELETE PLAYLIST</button>
  </div>

</div>

<div class="trackListContainer">
  <ul class="trackList">
    <?php
      $songIdArray = $playlist->getSongIds();

      $i=1;
      foreach ($songIdArray as $songId) {
        $playlistSong = new Song($con, $songId);
        $songArtist = $playlistSong->getArtist();
        $songDuration = ltrim($playlistSong->getDuration(), '0:');
        echo "<li class='trackListRow'>
                <div class='trackCount'>
                  <img src='assets/images/icons/play-white.png' alt='Play Button'
                    onclick='setTrack(\"". $playlistSong->getId()."\", tempPlaylist, true)'>
                  <span class='number'>" . $i . "</span>
                </div>

                <div class='trackInfo'>
                  <span class='trackName'>" . $playlistSong->getTitle() . "</span>
                  <span class='artistName'>" . $songArtist->getName() . "</span>
                </div>

                <div class='trackOptions'>
                  <img src='assets/images/icons/more.png'>
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
