<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  
<form action="user-pdo.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="login">Login</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="Enter login">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="firstname">Firstname</label>
    <input type="text" class="form-control" id="firstname"  name="firstname" placeholder="Enter firstname">
  </div>
  <div class="form-group">
    <label for="lastname">Lastname </label>
    <input type="text" class="form-control" id="lastname" " name="lastname" placeholder="Enter lastname">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>


<?php 

class user {

  private $id;
  private $connect;
  private $db;
  public $login;
  public $password;
  public $email;
  public $firstname;
  public $lastname;
   
    public function __construct($login, $password, $email, $firstname, $lastname) {
      $this->login = $login;
      $this->password = $password;
      $this->email = $email;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
      $this->connect = "0";
      $this->db = $this->db_connexion();
    }
    
    public function db_connexion() {
      try {
          $db = new PDO("mysql:host=localhost;dbname=classes", 'root', 'root');
          $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $db;
      }
      
      catch (PDOException $e) {
          echo 'Echec de la connexion : ' . $e->getMessage();
      }
    }


    public function checklogin() {

      $requete_same_login = $this->db->prepare("SELECT * FROM utilisateurs WHERE login = ?");
      $requete_same_login->execute([$this->login]);
      $loginExist = $requete_same_login->fetch();
      return $loginExist;
    }
    
    public function register() {
      
      $checklogin = $this->checklogin();

      if ($checklogin == FALSE) {

        if (strlen($this->login) > 60) {
          echo "L'identifiant doit faire moins de 60 caractères";
       }

        elseif ($this->login == $this->password) {
          echo "L'identifiant et le mot de passe doivent être différents";
        }

        else {
            $hash = password_hash($this->password, PASSWORD_DEFAULT);
            $requete_register = $this->db->prepare("INSERT INTO utilisateurs (login,password,email,firstname,lastname) VALUES(:login,:password,:email,:firstname,:lastname)");      
            $requete_register->execute([
                    'login' => $this->login,
                    'password' => $hash,
                    'email' => $this->email,
                    'firstname' => $this->firstname,
                    'lastname' => $this->lastname]);

            return [$this->login, $hash, $this->email, $this->firstname, $this->lastname];  
        }
      }

      else {
        echo "identifiant déjà prit";
      }
    }

    public function connect() {
      $requete_connexion = $this->db->prepare("SELECT * FROM utilisateurs WHERE login = ?");
	    $requete_connexion->execute([$this->login]);
	    $user = $requete_connexion->fetchall(); 
      
    //   var_dump($user);

      if ($user AND password_verify($this->password, $user[0]['password'])) {
        $this->id           = $user[0]['id'];
        $this->login        = $user[0]['login'];
        $this->password     = $user[0]['password'];
		    $this->email        = $user[0]['email'];
        $this->firstname    = $user[0]['firstname'];
        $this->lastname     = $user[0]['lastname'];
        $this->connect      = "1";      
        return [$this->id, $this->login, $this->password, $this->email, $this->firstname, $this->lastname, $this->connect];
      }

      else {
        echo "Mot de passe ou identifiant incorrect"; 
      }
    }

    public function disconnect() {
            unset($this->id, $this->login, $this->password, $this->email, $this->firstname, $this->lastname, $this->connect);  
    }

    public function delete() {
      $requete_delete = $this->db->prepare("DELETE FROM utilisateurs WHERE id = ?");
      $requete_delete->execute([$this->id]);
      $this->disconnect();
    }

    public function update() {
      $hash = password_hash($this->password, PASSWORD_DEFAULT);
      $requete_update = $this->db->prepare("UPDATE utilisateurs SET login= :login, email= :email, password= :password, firstname= :firstname, lastname= :lastname WHERE id = :id");
      $requete_update->execute(
        array(
            'id' => $this->id,
            'login' => "Update",
            'password' => $hash,
            'email' => "update_email",
            'firstname' => "update_firstname",
            'lastname' => "update_lastname",
        ));
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
      $requete_allinfos = $this->db->prepare("SELECT * FROM utilisateurs WHERE id = ?"); 
      $requete_allinfos->execute([$this->id]);
      $result_allinfos = $requete_allinfos->fetchall();
      return [$this->id, $this->login, $this->password, $this->email, $this->firstname, $this->lastname, $this->connect];
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
      $requete_refresh = $this->db->prepare("SELECT * FROM utilisateurs WHERE id = ?"); 
      $requete_refresh->execute([$this->id]);
      $user = $requete_refresh->fetchall();

      $this->login        = $user[0]['login'];
      $this->password     = $user[0]['password'];
      $this->email        = $user[0]['email'];
      $this->firstname    = $user[0]['firstname'];
      $this->lastname     = $user[0]['lastname'];

      return [$this->login, $this->password, $this->email, $this->firstname, $this->lastname];
    }
}

$login = $_POST['login'];
$password = $_POST['password'];
$email = $_POST['email'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$user = new user("$login", "$password", "$email", "$firstname", "$lastname");

// $user_checklogin = $user->checklogin();
// echo "<pre>" . "ligne 126". var_dump($user_checklogin). "</pre>";

$user_register = $user->register();
echo "<pre>" . var_dump($user_register). "</pre>";

// $user_connect = $user->connect();
// echo "<pre>" . var_dump($user_connect). "</pre>";

// $user_disconnect = $user->disconnect();
// echo "<pre>" . var_dump($user_disconnect). "</pre>";

// $user_delete = $user->delete();
// echo "<pre>" . var_dump($user_delete). "</pre>";

// $user_update = $user->update();
// echo "<pre>" . var_dump($user_update). "</pre>";

// $user_isConnected = $user->isConnected();
// echo "<pre>" . var_dump($user_isConnected). "</pre>";

// $user_infos = $user->getAllInfos();
// echo "<pre>" . var_dump($user_infos). "</pre>";

// $user_refresh = $user->refresh();
// echo "<pre>" . var_dump($user_refresh). "</pre>";

// echo "<pre>" . var_dump($user->isconnect). "</pre>";


?>