<?php

class Ipdo {

  public function constructeur($host, $username, $password, $db) {
    $link = mysqli_connect($host, $username, $password, $db); 
    if (mysqli_connect_error()) {
      echo "<pre>" ."Erreur de connexion"."</pre>";
    }
    return $this->link = $link;
  }

  public function connect($host, $username, $password, $db) {
    if (isset($this->link)) {
      $fermeture = mysqli_close($this->link);
      $link = mysqli_connect($host, $username, $password, $db); 
        if (mysqli_connect_error()) {
          echo "<pre>" ."Erreur de connexion"."</pre>";
        }
      echo "si connexion existante, ici fermeture et réouverture";
      return $this->link = $link;
    }
    else {
      $link = mysqli_connect($host, $username, $password, $db); 
        if (mysqli_connect_error()) {
          echo "<pre>" ."Erreur de connexion"."</pre>";
        }
      echo "si connexion non existante, ici ouverture";
      return $this->link = $link;
    }
  }

  public function destructeur() {
    if (isset($this->link) AND !isset($this->fermeture)) {
      $this->fermeture = mysqli_close($this->link);
      echo "si connexion existante, destructeur ici";
      return $this->fermeture;
    }
    else {
      echo "Ici destructeur, pas de connexion active";
    }
  }

  public function close() {
    if (isset($this->link) AND !isset($this->fermeture)) {
      $this->fermeture = mysqli_close($this->link);
      echo "si connexion existante, close ici";
      return $this->fermeture;
    }
    else {
      echo "Ici close, pas de connexion active";
    }
  }

  public function execute($query) {
    $query_prepare = mysqli_query($this->link, $query);
    $this->query = $query;
    $result = mysqli_fetch_assoc($query_prepare);
    $this->result = $result;
    echo "<pre>";
    return print_r($this->result); 
    echo "</pre>";
  }

  public function getLastQuery() {
    if (isset($this->result)) {
      echo "<pre>";
      return print_r($this->query); 
      echo "</pre>";
    }
    else {
      echo "<pre>" . "FALSE" . "</pre>" ;
      return FALSE;
    }
  }

  public function getLastResult() {
    if (isset($this->result)) {
      echo "<pre>";
      return print_r($this->result); 
      echo "</pre>";
    }
    else {
      echo "<pre>" . "FALSE" . "</pre>" ;
      return FALSE;
    }
  }

  public function getTables() {
    $query = "SHOW TABLES";
    $query_prepare = mysqli_query($this->link, $query);
    $this->query = $query;
    $result = mysqli_fetch_assoc($query_prepare);
    $this->result = $result;
    echo "<pre>";
    return print_r($this->result); 
    echo "</pre>";
  }

  public function getFields($table) {
    $query = "SELECT * FROM $table";
    $query_prepare = mysqli_query($this->link, $query);
    $this->query = $query;
    $result = mysqli_fetch_all($query_prepare);
    $this->result = $result; 
    echo "<pre>";
    return print_r($this->result); 
    echo "</pre>";
  }

}



$ipdo = new Ipdo ();
$host = $ipdo->host = "localhost";
$username = $ipdo->username = "root";
$password = $ipdo->password = "root";
$db = $ipdo->db = "classes";
$query = $ipdo->query = "SELECT * FROM utilisateurs";
$table = $ipdo->table = "utilisateurs"; 

$ipdo_constructeur = $ipdo->constructeur($host, $username, $password, $db);
// echo "<pre>"; 
// echo var_dump($ipdo_constructeur); 
// echo "</pre>";

// $host = $ipdo->host = "localhost";
// $username = $ipdo->username ="root";
// $password = $ipdo->password = "root";
// $db = $ipdo->db = "classes";

// $ipdo_connect = $ipdo->connect($host, $username, $password, $db);
// echo "<pre>"; 
// echo var_dump($ipdo_connect); 
// echo "</pre>";


// $ipdo_destructeur = $ipdo->destructeur();
// echo "<pre>"; 
// echo var_dump($ipdo_destructeur); 
// echo "</pre>";


// $ipdo_close = $ipdo->close();
// echo "<pre>"; 
// echo var_dump($ipdo_close); 
// echo "</pre>";

// $ipdo_execute = $ipdo->execute($query);
// echo "<pre>"; 
// echo var_dump($ipdo_execute); 
// echo "</pre>";

// $ipdo_getlastquery = $ipdo->getLastQuery();
// echo "<pre>"; 
// echo var_dump($ipdo_getlastquery); 
// echo "</pre>";

// $ipdo_getlastresult = $ipdo->getLastResult();
// echo "<pre>"; 
// echo var_dump($ipdo_getlastquery); 
// echo "</pre>";

// $ipdo_tables = $ipdo->getTables();

$result = $ipdo->getFields($table);
?>
