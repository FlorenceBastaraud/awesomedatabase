<?php

  class Database{
    private $dsn = "mysql:host=localhost;dbname=awesomedatabase";
    private $user = "root";
    private $pass = "";
    public $conn;

    public function __construct(){
      try{
        $this->conn = new PDO($this->dsn, $this->user, $this->pass);
      }
      catch(PDOException $e){
        echo $e->getMessage();
      }
    }

    public function insert($nom, $prenom, $email, $telephone){
      $sql = "INSERT INTO membres (nom, prenom, email, telephone) VALUES (:nom, :prenom, :email, :telephone)";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['nom'=>$nom,'prenom'=>$prenom,'email'=>$email,'telephone'=>$telephone,]);

      return true;
    }

    public function read(){
      $data = array();
      $sql = "SELECT * FROM membres";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row){
        $data[] = $row;
      }
      return $data;
    }

    public function getMembreById($id){
      $sql = "SELECT * FROM membres WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    public function update($id, $nom, $prenom, $email, $telephone){
      $sql = "UPDATE membres SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['nom'=>$nom, 'prenom'=>$prenom, 'email'=>$email, 'telephone'=>$telephone, 'id'=>$id]);
      return true;
    }

    public function delete($id){
      $sql = "DELETE FROM membres WHERE id = :id";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);
      return true;
    }

    public function totalRowCount(){
      $sql ="SELECT * FROM membres";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $t_rows = $stmt->rowCount();
      return $t_rows;
    }

  }

  $ob = new Database();

?>