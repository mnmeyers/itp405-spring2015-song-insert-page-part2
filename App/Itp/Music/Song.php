<?php
namespace Itp\Music;
use \Itp\Base\Database;
class Song extends Database{
	protected $title;
	protected $artist_id;
	protected $genre_id;
	protected $price;
	protected $id;
	//sets a title instance property
	public function setTitle($title)
	{
		$this->title = $title;
	}
	//sets an artist_id instance property
	public function setArtistId($artist_id)
	{
		$this->artist_id = $artist_id;
	}
	//sets a genre_id instance property
	public function setGenreId($genre_id)
	{
		$this->genre_id = $genre_id;
	}
	//sets a price
	public function setPrice($price)
	{
		$this->price = $price;
	}
	//performs the insert
	public function save()
	{
		$sql = "
			INSERT INTO songs (title, artist_id, genre_id, price, added, created_at, updated_at)
			VALUES (?, ?, ?, ?, NOW(), NOW(), NOW())

		";
		$statement = static::$pdo->prepare($sql);
		$statement->bindParam(1, $this->title);
		$statement->bindParam(2, $this->artist_id);
		$statement->bindParam(3, $this->genre_id);
		$statement->bindParam(4, $this->price);
		$statement->execute();
		$this->id = static::$pdo->lastInsertId();

	}
	//returns the song title
	public function getTitle()
	{
		return $this->title;
	}
	//returns the id column of this song in the database 
	public function getId()
	{
		return $this->id;
	}
}
