<?php

class Song
{
    private $conn;
    private $table_name = "song";

    public $id;
    public $title;
    public $album_name;
    public $year;
    public $artist_name;
    public $release_date;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT
                `id`, 
                `title`, 
                `album_name`, 
                `year`, 
                `artist_name`, 
                `release_date`
            FROM
                ".$this->table_name."
            ORDER BY
                `id` ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function create(){

        $query = "INSERT INTO
                ".$this->table_name."
            SET
                `title`=:title,
                `album_name`=:album_name, 
                `year`=:year, 
                `artist_name`=:artist_name, 
                `release_date`=:release_date";


        $stmt = $this->conn->prepare($query);

        $this->title            = htmlspecialchars(strip_tags($this->title));
        $this->album_name      = htmlspecialchars(strip_tags($this->album_name));
        $this->year             = htmlspecialchars(strip_tags($this->year));
        $this->artist_name    = htmlspecialchars(strip_tags($this->artist_name));
        $this->release_date     = htmlspecialchars(strip_tags($this->release_date));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":album_name", $this->album_name);
        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":artist_name", $this->artist_name);
        $stmt->bindParam(":release_date", $this->release_date);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function readOne() {

        $query = "SELECT
                `id`, 
                `title`, 
                `album_name`, 
                `year`, 
                `artist_name`, 
                `release_date`
            FROM
                ".$this->table_name."
            WHERE
                id = ?
            LIMIT
                0,1";

        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title            = $row['title'];
        $this->album_name       = $row['album_name'];
        $this->year             = $row['year'];
        $this->artist_name      = $row['artist_name'];
        $this->release_date     = $row['release_date'];
    }

    function update(){

        $query = "UPDATE
                ".$this->table_name."
            SET
                `title`=:title,
                `album_name`=:album_name, 
                `year`=:year, 
                `artist_name`=:artist_name, 
                `release_date`=:release_date
            WHERE
                `id` = :id";

        $stmt = $this->conn->prepare($query);

        $this->title            = htmlspecialchars(strip_tags($this->title));
        $this->album_name      = htmlspecialchars(strip_tags($this->album_name));
        $this->year             = htmlspecialchars(strip_tags($this->year));
        $this->artist_name    = htmlspecialchars(strip_tags($this->artist_name));
        $this->release_date     = htmlspecialchars(strip_tags($this->release_date));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":album_name", $this->album_name);
        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":artist_name", $this->artist_name);
        $stmt->bindParam(":release_date", $this->release_date);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function delete(){
        $query = "DELETE FROM 
                ".$this->table_name."
             WHERE 
                `id` = ?";

        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
