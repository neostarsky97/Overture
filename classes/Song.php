<?php

  class Song {

    private $con;
    private $id;
    private $songData;
    private $title;
    private $artistId;
    private $albumId;
    private $genreId;
    private $duration;
    private $path;

    public function __construct($con, $id) {
      $this->con = $con;
      $this->id = $id;

      $stmt = $this->con->query("SELECT * FROM songs WHERE id='$this->id'");
      $songData = $stmt->fetch();
      $this->title = $songData['title'];
      $this->artistId = $songData['artist'];
      $this->albumId = $songData['album'];
      $this->genre = $songData['genre'];
      $this->duration = $songData['duration'];
      $this->path = $songData['path'];
    }

    public function getTitle() {
      return $this->title;
    }

    public function getArtist() {
      return new Artist($this->con, $this->artistId);
    }

    public function getAlbum() {
      return new Album($this->con, $this->albumId);
    }

    public function getGenre() {
      return $this->genreId;
    }

    public function getDuration() {
      return $this->duration;
    }

    public function getPath() {
      return $this->path;
    }

  }
?>
