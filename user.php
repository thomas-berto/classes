<?php
session_start();
class User
{
    private $id;
    public $login = null;
    public $email = null;
    public $firstname = null;
    public $lastname = null;

    public function register($login, $email, $firstname, $lastname, $password)
    {
        if (!empty($login) && !empty($email) && !empty($firstname) && !empty($lastname) && !empty($password)) {
            $connect = mysqli_connect("localhost", "root", "", "poo");
            $request = "SELECT login FROM user WHERE login = '" . $login . "' ";
            $query = mysqli_query($connect, $request);
            $result = mysqli_fetch_all($query);
            if (empty($result)) {
                $request = "INSERT INTO `user`(`id`, `login`, `email`, `firstname`, `lastname`, `password`) VALUES (NULL, '" . $login . "', '" . $email . "', '" . $firstname . "', '" . $lastname . "', '" . password_hash($password, PASSWORD_DEFAULT) . "')";
                $query = mysqli_query($connect, $request);
                echo "Inscription Validée";
                return [$login, $email, $firstname, $lastname, $password];
            } else {
                echo "Login déja pris!";
            }
        } else {
            echo "Informations manquantes";
        }
    }

    public function connect($login, $password)
    {
        if (!empty($login) && !empty($password)) {
            $connect = mysqli_connect("localhost", "root", "", "poo");
            $request = "SELECT * FROM user WHERE login = '" . $login . "' ";
            $query = mysqli_query($connect, $request);
            $result = mysqli_fetch_all($query);
            //var_dump($result);
            if (!empty($result)) {
                if (password_verify($password, $result[0][5])) {
                    $this->id = $result[0][0];
                    $this->login = $result[0][1];
                    $this->email = $result[0][2];
                    $this->firstname = $result[0][3];
                    $this->lastname = $result[0][4];
                    echo "Connexion validée<br>";
                    return [$this->login, $this->email, $this->firstname, $this->lastname];
                } else {
                    echo "Mauvais password";
                }
            } else {
                echo "Login déja existant";
            }
        } else {
            echo "Veuillez remplir les champs";
        }
    }

    public function disconnect()
    {
        if ($this->login != NULL) {
            $this->id = NULL;
            $this->login = NULL;
            $this->email = NULL;
            $this->firstname = NULL;
            $this->lastname = NULL;
            session_destroy();
            return "Déconnexion";
        }
    }
}
$sam = new User();  // Création d'user
//var_dump($sam->register("sam", "sam@sam.fr", "sam", "jolly", "0000")); //exo 1
($sam->connect("sam", "0000")); // exo 2
echo $sam->disconnect();
