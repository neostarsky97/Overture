var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;

function openPage(url) {
  if(url.indexOf("?") == -1) {
    url = url + "?";
  }
  var encodedURL = encodeURI(url+"&userLoggedIn="+userLoggedIn);
  $("#mainContent").load(encodedURL);
  $("#body").scrollTop(0);
  history.pushState(null, null, url);

}

function formatTime(seconds) {
  var time = Math.round(seconds);
  var minutes = Math.floor(time / 60);
  var seconds = time % 60;

  var extraZero;
  if(seconds < 10) {
    extraZero = "0";
  } else {
    extraZero = "";
  }
  var duration = minutes + ":" + extraZero + seconds;
  return duration;
}

function updateProgressBar(audio) {
  $(".progressTime.Current span").text(formatTime(audio.currentTime));
  $(".progressTime.Remaining span").text(formatTime(audio.duration - audio.currentTime));

  var progress = audio.currentTime/audio.duration * 100;
  $(".playBackBar .progress").css("width", progress+"%");
}

function updateVolumeProgressBar(audio) {
  var volume = audio.volume * 100;
  $(".volumeBar .progress").css("width", volume+"%");
}

function playArtistSong() {
  setTrack(tempPlaylist[0], tempPlaylist, true);
}

function Audio() {
  this.currentlyPlaying;
  this.audio = document.createElement('audio');

  this.audio.addEventListener("ended", function() {
    nextSong();
  });

  this.audio.addEventListener("canplay", function() {
    var formattedDuration = formatTime(this.duration);
    $(".progressTime.Remaining span").text(formattedDuration);
    updateVolumeProgressBar(this);
  });

  this.audio.addEventListener("volumechange", function() {
    updateVolumeProgressBar(this);
  });

  this.audio.addEventListener("timeupdate", function() {
    if(this.duration) {
      updateProgressBar(this);
    }
  });
  this.setTrack = function(track) {
    this.currentlyPlaying = track;
    this.audio.src = track.path;
  }

  this.play = function() {
    this.audio.play();
  }

  this.pause = function() {
    this.audio.pause();
  }

  this.setTime = function(seconds) {
    this.audio.currentTime = seconds;
  }
}
