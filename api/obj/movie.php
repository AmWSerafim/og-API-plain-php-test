<?php

class Movie
{
    private $conn;
    private $table_name = "movie";

    public $id;
    public $title;
    public $description;
    public $year;
    public $director_name;
    public $release_date;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT
                `id`, 
                `title`, 
                `description`, 
                `year`, 
                `director_name`, 
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
                `description`=:description, 
                `year`=:year, 
                `director_name`=:director_name, 
                `release_date`=:release_date";


        $stmt = $this->conn->prepare($query);

        $this->title            = htmlspecialchars(strip_tags($this->title));
        $this->description      = htmlspecialchars(strip_tags($this->description));
        $this->year             = htmlspecialchars(strip_tags($this->year));
        $this->director_name    = htmlspecialchars(strip_tags($this->director_name));
        $this->release_date     = htmlspecialchars(strip_tags($this->release_date));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":director_name", $this->director_name);
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
                `description`, 
                `year`, 
                `director_name`, 
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
        $this->description      = $row['description'];
        $this->year             = $row['year'];
        $this->director_name    = $row['director_name'];
        $this->release_date     = $row['release_date'];
    }

    function update(){

        $query = "UPDATE
                ".$this->table_name."
            SET
                `title`=:title,
                `description`=:description, 
                `year`=:year, 
                `director_name`=:director_name, 
                `release_date`=:release_date
            WHERE
                `id` = :id";

        $stmt = $this->conn->prepare($query);

        $this->title            = htmlspecialchars(strip_tags($this->title));
        $this->description      = htmlspecialchars(strip_tags($this->description));
        $this->year             = htmlspecialchars(strip_tags($this->year));
        $this->director_name    = htmlspecialchars(strip_tags($this->director_name));
        $this->release_date     = htmlspecialchars(strip_tags($this->release_date));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":year", $this->year);
        $stmt->bindParam(":director_name", $this->director_name);
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