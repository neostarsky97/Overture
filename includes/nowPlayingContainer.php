<?php
  $songQuery = $con->query("SELECT id FROM songs ORDER BY RAND() LIMIT 10");
  $songArray = array();

  while ($row = $songQuery->fetch()) {
    array_push($songArray, $row['id']);
  }

  $jsonArray = json_encode($songArray);
?>

<script>

  $(document).ready(function() {
    var newPlaylist = <?php echo $jsonArray ?>;
    audioElement = new Audio();

    setTrack(newPlaylist[0], newPlaylist, false);

    $("#nowPlayingContainer").on("mousemove mousedown touchstart touchmove", function(e) {
      e.preventDefault();
    });

    $(".playBackBar .progressBar").mousedown(function () {
      mouseDown = true;
    });

    $(".playBackBar .progressBar").mousemove(function(e) {
      if(mouseDown) {
        timeFromOffset(e, this);
      }
    });

    $(".playBackBar .progressBar").mouseup(function (e) {
      timeFromOffset(e, this);
    });

    $(".volumeBar .progressBar").mousedown(function () {
      mouseDown = true;
    });

    $(".volumeBar .progressBar").mousemove(function(e) {
      if(mouseDown) {
        var percentage = e.offsetX / $(this).width();
        if (percentage >= 0 && percentage <=1)
          audioElement.audio.volume = percentage;
      }
    });

    $(".volumeBar .progressBar").mouseup(function (e) {
      var percentage = e.offsetX / $(this).width();
      if (percentage >= 0 && percentage <=1)
        audioElement.audio.volume = percentage;
    });

    $(document).mouseup(function() {
      mouseDown = false;
    });

  });

  function timeFromOffset(mouse, progressBar) {
    var percentage = mouse.offsetX / $(progressBar).width() * 100;
    var seconds = audioElement.audio.duration * (percentage/100);
    audioElement.setTime(seconds);
  }

  function nextSong() {
    if(repeat == true) {
      audioElement.setTime(0);
      playSong();
      return;
    }
    if (currentIndex == currentPlaylist.length - 1) {
      currentIndex = 0;
    } else {
      currentIndex++;
    }
    var trackToPlay = shuffle? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
  }

  function prevSong() {
    if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
      audioElement.setTime(0);
    } else {
      currentIndex--;
    }
    var trackToPlay = currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
  }

  function setTrack(trackId, newPlaylist, play) {

    if(newPlaylist != currentPlaylist) {
      currentPlaylist = newPlaylist;
      shufflePlaylist = newPlaylist.slice();
      shuffleArray(shufflePlaylist);
    }

    if(shuffle == true) {
      currentIndex = shufflePlaylist.indexOf(trackId);
    } else {
      currentIndex = currentPlaylist.indexOf(trackId);
    }

    $.post("includes/handlers/ajax/getSongJSON.php", {songId : trackId}, function(data) {
      var track = JSON.parse(data);
      console.log(track);
      $(".trackName span").text(track.title);
      audioElement.setTrack(track);

      $.post("includes/handlers/ajax/getArtistJSON.php", {artistId : track.artist}, function(data) {
        var artist = JSON.parse(data);
        console.log(artist);
        $(".artistName span").text(artist.name);
      });

      $.post("includes/handlers/ajax/getAlbumJSON.php", {albumId : track.album}, function(data) {
        var album = JSON.parse(data);
        console.log(album);
        $(".albumLink img").attr("src", album.artworkPath);
      });

      if (play) {
        audioElement.play();
      }
    });
  }

  function setRepeat() {
    repeat = !repeat;
    var imageName = repeat? "repeat-active.png" : "repeat.png";
    $(".controlButton.Repeat img").attr("src", "./assets/images/icons/"+imageName);
  }

  function setMute() {
    var imageName;
    audioElement.audio.muted = !audioElement.audio.muted;
    var imageName = audioElement.audio.muted? "volume-mute.png" : "volume.png";
    $(".controlButton.volume img").attr("src","./assets/images/icons/"+imageName);
  }

  function setShuffle() {
    shuffle = !shuffle;
    var imageName = shuffle? "shuffle-active.png" : "shuffle.png";
    $(".controlButton.Shuffle img").attr("src","./assets/images/icons/"+imageName);

    if (shuffle) {
      shuffleArray(shufflePlaylist);
      currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
    } else {
      currenIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
    }
  }

  function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
}

  function playSong() {

    if(audioElement.audio.currentTime == 0) {
      $.post("includes/handlers/ajax/updatePlaysJSON.php", { songId : audioElement.currentlyPlaying.id});
    }

    $(".controlButton.Play").hide();
    $(".controlButton.Pause").show();
    audioElement.play();
  }

  function pauseSong() {
    $(".controlButton.Play").show();
    $(".controlButton.Pause").hide();
    audioElement.pause();
  }

</script>


<div id="nowPlayingContainer">
  <div id="nowPlayingBar">
      <div id="nowPlayingLeft">
        <div class="content">

          <div class="albumLink">
            <img src=""class="albumArtwork"  alt="Artwork" >
          </div>

          <div class="trackInfo">
            <div class="trackName">
              <span></span>
            </div>
            <div class="artistName">
              <span>Avicii</span>
            </div>
          </div>

        </div>
      </div>

      <div id="nowPlayingCenter">
          <div class="content playerControls">
            <div class="buttons">

              <button class="controlButton Shuffle" title="Shuffle button" onclick="setShuffle()">
                <img src="assets/images/icons/shuffle.png" alt="Shuffle">
              </button>

              <button class="controlButton Previous" title="Previous button" onclick="prevSong()">
                <img src="assets/images/icons/previous.png" alt="Previous">
              </button>

              <button class="controlButton Play" title="Play button" onclick="playSong()">
                <img src="assets/images/icons/play.png" alt="Play">
              </button>

              <button class="controlButton Pause" title="Pause button" onclick="pauseSong()">
                <img src="assets/images/icons/pause.png" alt="Pause">
              </button>

              <button class="controlButton Next" title="Next button" onclick="nextSong()">
                <img src="assets/images/icons/next.png" alt="Next">
              </button>

              <button class="controlButton Repeat" title="Repeat button" onclick="setRepeat()">
                <img src="assets/images/icons/repeat.png" alt="Repeat">
              </button>
            </div>

            <div class="playBackBar">

              <div class="progressTime Current">
                <span>0.00</span>
              </div>

              <div class="progressBar">
                <div class="progressBarBg">
                  <div class="progress">

                  </div>
                </div>
              </div>

              <div class="progressTime Remaining">
                <span>0.00</span>
              </div>

            </div>

          </div>
      </div>

      <div id="nowPlayingRight">
        <div class="volumeBar">

            <button name="Volume" class="controlButton volume" title="Volume button" onclick="setMute()">
              <img src="assets/images/icons/volume.png" alt="Volume">
            </button>

            <div class="progressBar">
              <div class="progressBarBg">
                <div class="progress">

                </div>
              </div>
            </div>


        </div>
      </div>
  </div>
</div>
