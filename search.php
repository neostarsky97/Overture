<?php
  include("includes/includedFiles.php");

  if (isset($_GET['term'])) {
    $searchQuery = urldecode($_GET['term']);
  } else {
    $searchQuery = "";
  }
?>

<div class="searchContainer">
  <h4>Search for an artist, album or song</h4>
  <input type="text" class="searchInput" value="<?php echo $searchQuery; ?>"
    placeholder="Start typing..." ></input>
</div>

<script type="text/javascript">
  $(".searchInput").focus();

  $(function() {
    var timer;

    $(".searchInput").keyup(function() {
        clearTimeout(timer);

        timer = setTimeout(function() {
          var val = $(".searchInput").val();
          openPage('search.php?term='+val);
        }, 2000);
    });

  });
</script>

<?php
  if ($searchQuery == "")
    exit();
?>

<div class="songsContainer">
  <div class="listHeading songSearch">
    <h1>Songs</h1>
  </div>
  <div class="trackListContainer borderBottom">
    <ul class="trackList">
      <?php
        $songQuery = $con->query("SELECT id FROM songs WHERE title
          COLLATE latin1_general_ci LIKE '$searchQuery%'");
        if ($songQuery->rowCount() == 0) {
          echo "<span class='noResults'>No songs match your search: " .  $searchQuery ."</span>";
        } else {
          $i=1;
          $songIdArray = array();
          while ($row = $songQuery->fetch(PDO::FETCH_ASSOC)) {
            if ($i > 10) {
              break;
            }
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

<div class="artistsContainer borderBottom">
  <div class="listHeading">
    <h1>Artists</h1>
  </div>
  <?php
    $artistsQuery = $con->query("SELECT id FROM artists WHERE name
      COLLATE latin1_general_ci LIKE '$searchQuery%'");
    if ($artistsQuery->rowCount() == 0) {
      echo "<span class='noResults'>No artists match your search: ". $searchQuery."</span>" ;
    }
      while ($row = $artistsQuery->fetch()) {
        $artistFound = new Artist($con, $row['id']);

        echo "<div class='searchResultRow'>
                <div class='artistName'>
                  <span onclick='openPage(\"artist.php?id=" . $artistFound->getId() . "\")'>
                    " . $artistFound->getName() . "
                  </span>
                </div>
            </div>";
      }

  ?>
</div>

<div class="albumInfoContainer">
  <div class="listHeading artistAlbums">
    <h1>Albums</h1>
  </div>
  <div class="gridViewContainer">
    <?php
      $albumsQuery = $con->query("SELECT * FROM albums WHERE title
        COLLATE latin1_general_ci LIKE '$searchQuery%'");
      if ($albumsQuery->rowCount() == 0) {
        echo "<span class='noResults'>No albums match your search: ". $searchQuery ." </span>" ;
      } else {
        while ($row = $albumsQuery->fetch()) {
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
      }
    ?>
  </div>
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
</nav>
