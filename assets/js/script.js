var currentPlaylist = [];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;

$(document).click(function(click) {
  var target = $(click.target);
  if (!target.hasClass("item") && !target.hasClass("optionsButton")) {
    hideOptionsMenu();
  }
});

$(window).scroll(function() {
  hideOptionsMenu();
});

$(document).on("change", "select.playlist", function() {
  var select = $(this);
  var playlistId = select.val();
  var songId = select.prev(".songId").val();

  $.post("includes/handlers/ajax/addToPlaylist.php" , {playlistId : playlistId, songId : songId})
  .done(function(error) {
    if (error != "") {
      alert(error);
    }
    hideOptionsMenu();
    select.val("");
  });
});

$(document).on("click", ".item.download", function() {
  //console.log("inside download");
  var songId = $(this).prevAll(".songId").val();
  $.post("includes/handlers/ajax/downloadSong.php", {songId: songId}).done(function(response) {
    var link = document.createElement("a");
    link.download = name;
    link.href = response;
    link.click();
  });
});

$(document).on("click", ".item.copySong", function() {
  var songId = $(this).prevAll(".songId").val();
  $.post("includes/handlers/ajax/downloadSong.php", {songId: songId}).done(function(response) {
    alert("Link: " + response);
  });
});

function logout() {
  $.post("includes/handlers/ajax/logout.php", function() {
    location.reload();
  })
}
function openPage(url) {
  if(url.indexOf("?") == -1) {
    url = url + "?";
  }
  var encodedURL = encodeURI(url+"&userLoggedIn="+userLoggedIn);
  $("#mainContent").load(encodedURL);
  $("#body").scrollTop(0);
  history.pushState(null, null, url);
}

function createPlaylist() {
  var popup = prompt("Please enter the name of your playlist");

  if(popup != null) {
    $.post("includes/handlers/ajax/createPlaylist.php",{name : popup, username: userLoggedIn})
    .done(function(error) {
      if (error != "") {
        alert(error);
      }
      //do something
      openPage("yourmusic.php");
    });
  }
}

function deletePlaylist(playlistId) {
  var popup = confirm("Are you sure you want to delete this playlist?");
  if(popup == true) {
    $.post("includes/handlers/ajax/deletePlaylist.php",{id : playlistId})
    .done(function(error) {
      if (error != "") {
        alert(error);
      }
      //do something
      openPage("yourmusic.php");
    });
  }
}

function removeFromPLaylist(button, playlistId) {
  var songId = $(button).prevAll(".songId").val();

  $.post("includes/handlers/ajax/removeFromPlaylist.php",{playlistId : playlistId,
    songId : songId})
  .done(function(error) {
    if (error != "") {
      alert(error);
    }
    //do something
    openPage("playlist.php?id=" + playlistId);
  });

}

function showOptionsMenu(button) {
  var songId = $(button).prevAll(".songId").val();
  var optionsMenu = $(".optionsMenu");
  optionsMenu.find(".songId").val(songId);
  var width = optionsMenu.width();
  var scrollTop = $(window).scrollTop(); //retrieve pixel offset of scroll from top
  var elementOffset = $(button).offset().top; //distance from top of document

  var top = elementOffset - scrollTop;
  var left = $(button).offset().left;

  optionsMenu.css({"top":+top+"px", "left":+(left-width)+"px", "display": "inline"});
}

function hideOptionsMenu() {
  var optionsMenu = $(".optionsMenu");
  if ( optionsMenu.css("display") != "none") {
    optionsMenu.css("display", "none");
  }
}

function updateEmail(emailClass) {
  var emailValue = $("." + emailClass).val();

  $.post("includes/handlers/ajax/updateEmail.php",
    {email: emailValue, username: userLoggedIn}).done(function(response){
      $("." + emailClass).nextAll(".message").text(response);
    });
}

function updatePassword(oldPasswordClass, newPasswordClass1, newPasswordClass2) {
  var oldPassword = $("." + oldPasswordClass).val();
  var newPassword1 = $("." + newPasswordClass1).val();
  var newPassword2 = $("." + newPasswordClass2).val();

  $.post("includes/handlers/ajax/updatePassword.php",
    {oldPassword: oldPassword, newPassword1: newPassword1, newPassword2: newPassword2, username: userLoggedIn})
      .done(function(response){
      $("." + oldPasswordClass).nextAll(".message").text(response);
    });
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
