<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  
<form action="user.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="login">Login</label>
    <input type="email" class="form-control" id="login" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="firstname">Firstname</label>
    <input type="email" class="form-control" id="firstname" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="lastname">Lastname </label>
    <input type="email" class="form-control" id="lastname" aria-describedby="emailHelp" placeholder="Enter email">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>


<?php 

class user {

    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    public $isconnect;

    public function __construct($login, $password, $email, $firstname, $lastname) {

      $this->login = $login;
      $this->password = $password;
      $this->email = $email;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->isconnect = "0";
    }

    public function db_connexion() {
      $db = mysqli_connect("localhost", "root", "root", "classes"); 
      if (mysqli_connect_error()) {
        echo "<pre>" ."Erreur de connexion"."</pre>";
      }
      else {
        echo "<pre>" . "ligne 67"."Connexion réussi"."</pre>";
      }

      return $db;
    }

    public function checklogin() {

      $db = $this->db_connexion();

      $requete_same_login = "SELECT * FROM utilisateurs WHERE login = '$this->login'";
      $result_same_login = mysqli_query($db, $requete_same_login);

      $count = $result_same_login->num_rows;

      if ($count>0) {
        $count = TRUE;
      }
      else {
        $count = FALSE;
      }

      return $count;
    }
    
    public function register() {
      
      $db = $this->db_connexion();
      $checklogin = $this->checklogin();

      if ($checklogin = FALSE) {
        $requete_register = "INSERT INTO utilisateurs (login,password,email,firstname,lastname) VALUES('$this->login','$this->password','$this->email',' $this->firstname','$this->lastname')";      
        $result_register = mysqli_query($db, $requete_register);
        return [$this->login, $this->password, $this->email, $this->firstname, $this->lastname]; 
      }
      else {
        echo "identifiant déjà prit";
      }
    }

    public function connect() {

      $db = mysqli_connect("localhost", "root", "root", "classes");
      if (mysqli_connect_error()) {
        echo "Erreur de connexion";
      }

      $requete_connexion = "SELECT * FROM utilisateurs WHERE login = $this->login";      
      $result_connexion = mysqli_query($db, $requete_connexion);

      $this->isconnect = "1";

      return [$this->login, $this->password];
    }
}

$user = new user("TestConstruct", "Constructpass", "Constructmail", "Constructfirst", "Constructlast");

// $user_checklogin = $user->checklogin();
// echo "<pre>" . "ligne 126". var_dump($user_checklogin). "</pre>";

$user_register = $user->register();
echo "<pre>" . var_dump($user_register). "</pre>";

// $user_connect = $user->connect();
// echo "<pre>" . var_dump($user_connect). "</pre>";

// echo "<pre>" . var_dump($user->isconnect). "</pre>";
?>
