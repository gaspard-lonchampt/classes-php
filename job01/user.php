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
    public $connect;

    public function __construct($login, $password, $email, $firstname, $lastname) {

      $this->login = $login;
      $this->password = $password;
      $this->email = $email;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->connect = "0";
    }

    public function db_connexion() {
      $db = mysqli_connect("localhost", "root", "root", "classes"); 
      if (mysqli_connect_error()) {
        echo "<pre>" ."Erreur de connexion"."</pre>";
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

      var_dump($checklogin);

      if ($checklogin == FALSE) {

        if (strlen($this->login) > 60) {
               
          // $error = TRUE;
          // $errorMsg = "L'identifiant doit faire moins de 60 caractères";
          echo "L'identifiant doit faire moins de 60 caractères";

       }

                                                                                                                            // elseif (strlen($this->password) < 8 AND 
                                                                                                                            // !preg_match("[A-Z]", $this->password) AND 
                                                                                                                            // !preg_match("[a-z]", $this->password) AND 
                                                                                                                            // !preg_match("[\W_]", $this->password) AND
                                                                                                                            // !preg_match("[0-9]", $this->password) ) {
                                                                                                                              
                                                                                                                            //   // $error = TRUE;
                                                                                                                            //   // $errorMsg = "Le mot de passe doit contenir plus de 8 caractères, doit contenir une majuscule, une majuscule, un chiffre et un caractère spécial";

                                                                                                                            //   echo "Le mot de passe doit contenir plus de 8 caractères, doit contenir une majuscule, une majuscule, un chiffre et un caractère spécial";

                                                                                                                            // }

        elseif ($this->login == $this->password) {
        
          // $error = TRUE;
          // $errorMsg = "L'identifiant et le mot de passe doivent être différents";
          echo "L'identifiant et le mot de passe doivent être différents";

        }

        else {
        
        $hash = password_hash($this->password, PASSWORD_DEFAULT);
        
        $requete_register = "INSERT INTO utilisateurs (login,password,email,firstname,lastname) VALUES('$this->login','$hash','$this->email',' $this->firstname','$this->lastname')";      
        $result_register = mysqli_query($db, $requete_register);
        return [$this->login, $this->password, $this->email, $this->firstname, $this->lastname];  

        }
      }

      else {
        echo "identifiant déjà prit";
      }
    }

    public function connect() {

      $db = $this->db_connexion();

      $requete_connexion = "SELECT * FROM utilisateurs WHERE login = '$this->login'";      
      $result_connexion = mysqli_query($db, $requete_connexion);

      $user = mysqli_fetch_all($result_connexion);

      // var_dump($user);

      if ($user AND password_verify($this->password, $user[0][2])) {
        
        $this->id = $user[0][0];
        $this->login = $user[0][1];
        $this->password = $user[0][2];
				$this->email = $user[0][3];
        $this->firstname = $user[0][4];
        $this->lastname = $user[0][5];
        $this->connect = "1";
        
        return [$this->id, $this->login, $this->password, $this->email, $this->firstname, $this->lastname, $this->connect];
      }
      else {

        // $error = TRUE;
        // $errorMsg = "Mot de passe ou identifiant incorrect"; 
        echo "Mot de passe ou identifiant incorrect"; 

      }
    }

    public function disconnect() {

      unset($this->id, $this->login, $this->password, $this->email, $this->firstname, $this->lastname, $this->connect);
  
    }

    public function delete() {

      $db = $this->db_connexion();
      $requete_delete = "DELETE FROM utilisateurs WHERE id = '$this->id'";
      $requete_delete = mysqli_query($db, $requete_delete);
      $this->disconnect();

    }

    public function update() {
      $db = $this->db_connexion();
      $newlogin = "Login4";
      $requete_update = "UPDATE utilisateurs SET login= '$newlogin', email= '$this->email', password= '$this->password', firstname= '$this->firstname', lastname='$this->lastname' WHERE id = '$this->id'";
      $requete_update = mysqli_query($db, $requete_update);
    }

    public function isConnected() {
      if ($this->connect == 1) {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    public function getAllInfos() {

      $db = $this->db_connexion();
      $requete_allinfos = "SELECT * FROM utilisateurs WHERE id = '$this->id'"; 
      $requete_allinfos = mysqli_query($db, $requete_allinfos);

      $result_allinfos = mysqli_fetch_all($requete_allinfos);

      return print_r($result_allinfos);

    }

    public function getLogin() {
      return $this->login;
    }


    public function getEmail() {
      return $this->email;
    }

    public function getFirstname() {
      return $this->firstname;
    }

    public function getLastname() {
      return $this->lastname;
    }

    public function refresh() {
      $db = $this->db_connexion();
      $requete_refresh = "SELECT * FROM utilisateurs WHERE id = '$this->id'"; 
      $result_refresh = mysqli_query($db, $requete_refresh);

      $user = mysqli_fetch_all($result_refresh);

      $this->login = $user[0][1];
      $this->password = $user[0][2];
			$this->email = $user[0][3];
      $this->firstname = $user[0][4];
      $this->lastname = $user[0][5];

      return [$this->login, $this->password, $this->email, $this->firstname, $this->lastname];

    }

}

$user = new user("Login3", "password12345", "Constructmail", "Constructfirst", "Constructlast");

// $user_checklogin = $user->checklogin();
// echo "<pre>" . "ligne 126". var_dump($user_checklogin). "</pre>";

// $user_register = $user->register();
// echo "<pre>" . var_dump($user_register). "</pre>";

$user_connect = $user->connect();
echo "<pre>" . var_dump($user_connect). "</pre>";


// $user_disconnect = $user->disconnect();
// echo "<pre>" . var_dump($user_disconnect). "</pre>";

// $user_delete = $user->delete();
// echo "<pre>" . var_dump($user_delete). "</pre>";

$user_update = $user->update();
echo "<pre>" . var_dump($user_update). "</pre>";

// $user_isConnected = $user->isConnected();
// echo "<pre>" . var_dump($user_isConnected). "</pre>";

// $user_infos = $user->getAllInfos();
// echo "<pre>" . var_dump($user_infos). "</pre>";

$user_refresh = $user->refresh();
echo "<pre>" . var_dump($user_refresh). "</pre>";

// echo "<pre>" . var_dump($user->isconnect). "</pre>";
?>
