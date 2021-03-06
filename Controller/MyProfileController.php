<?php

declare(strict_types=1);

class MyProfileController
{
    private $databaseManager;

    public function render(array $GET, array $POST)
    {
        $this->getInfo($_SESSION['student-id']);
        require 'View/myprofile.php';
    }

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function getInfo($id)
    {
        try {
            $query = "SELECT * FROM student WHERE student_id = $id;";
            $sth = $this->databaseManager->dbconnection->prepare($query);
            $sth->execute();
            $result = $sth->fetchAll();
            $_SESSION["last-name"] = $result[0]['last_name'];
            $_SESSION["job"] = $result[0]['current_job'];
            $_SESSION["company"] = $result[0]['current_company'];
            $_SESSION["location"] = $result[0]['current_location'];
            $_SESSION["bio"] = $result[0]['bio'];
            $_SESSION["skills"] = $result[0]['skills'];
            return $result;
        } catch (PDOException $error) {
            echo "Connection Error - " . $error->getMessage();
        }
    }

    public function getExperience($id)
    {
        $query = "SELECT * FROM experience WHERE student_id = $id;";
        $jobs = $this->databaseManager->dbconnection->query($query);
        return $jobs;
    }

    public function getEducation($id)
    {
        $query = "SELECT * FROM education WHERE student_id = $id;";
        $jobs = $this->databaseManager->dbconnection->query($query);
        return $jobs;
    }

    public function getImages($id)
    {
        try {
            $query = "SELECT profile_pic FROM profilepic WHERE student_id = $id;";
            $statement = $this->databaseManager->dbconnection->prepare($query);
            $statement->execute();
            $images = $statement->fetch(\PDO::FETCH_ASSOC);
            foreach ($images as $image) {
                return $image;
            }
        } catch (PDOException $error) {
            echo "Connection Error - " . $error->getMessage();
        }
    }

    public function getSocialMedia($id)
    {
        // $query = "SELECT * from social_media where student_id = $id;";
        // $socialMedia = $this->databaseManager->dbconnection->query($query);
        // return $socialMedia;

        try {
            $query = "SELECT * from social_media where student_id = $id;";
            $statement = $this->databaseManager->dbconnection->prepare($query);
            $statement->execute();
            $images = $statement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($images as $image) {
                return $image;
            }
        } catch (PDOException $error) {
            echo "Connection Error - " . $error->getMessage();
        }
    }
}
