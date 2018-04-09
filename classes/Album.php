<?php

  class Album {

    private $con;
    private $id;
    private $title;
    private $artistId;
    private $genre;
    private $artworkPath;

    public function __construct($con, $id) {
      $this->con = $con;
      $this->id = $id;

      $stmt = $this->con->query("SELECT * FROM albums WHERE id='$this->id'");
      $album = $stmt->fetch();

      $this->title = $album['title'];
      $this->artistId = $album['artist'];
      $this->genre = $album['genre'];
      $this->artworkPath = $album['artworkPath'];
    }

    public function getTitle() {
      return $this->title;
    }

    public function getArtist() {
      return new Artist($this->con, $this->artistId);
    }

    public function getGenre() {
      return $this->genre;
    }

    public function getArtworkPath() {
      return $this->artworkPath;
    }

    public function getNumberOfSongs() {
      $stmt = $this->con->query("SELECT id FROM songs WHERE album='$this->id'");
      return $stmt->rowCount();
    }

    public function getSongIds() {
      $stmt = $this->con->query("SELECT id FROM songs WHERE album='$this->id' ORDER BY albumOrder ASC");

      $songsIdArr = array();

      while ($row = $stmt->fetch()) {
        array_push($songsIdArr, $row['id']);
      }

      return $songsIdArr;
    }
  }

?>
