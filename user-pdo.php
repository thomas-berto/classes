<?php
session_start();
class userpdo
{
    private $id;
    public $login = null;
    public $email = null;
    public $firstname = null;
    public $lastname = null;

    // private $dsn = null;
    // private $user = null;
    // private $password = null;

    // private function connectdb()
    // {
    //     try {
    //         $dbh = new PDO($this->dsn, $this->user, $this->password);
    //         echo 'Connecté';
    //     } catch (PDOException $e) {
    //         echo 'Connexion échouée : ' . $e->getMessage();
    //     }
    // }

    // public function initDB($dsn, $user, $password)
    // {
    //     $this->dsn = $dsn;
    //     $this->password = $password;
    //     $this->user = $user;
    //     $this->connectdb();
    // }

    public function register($login, $email, $firstname, $lastname, $password)
    {
        if (!empty($login) && !empty($email) && !empty($firstname) && !empty($lastname) && !empty($password)) {
            $conn = new PDO("mysql:host=localhost;dbname=poo", "root", "");
            $sql = "SELECT * FROM user WHERE login = '" . $login . "' ";
            $usr_data = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
            if ($usr_data == false) {
                $sql = "INSERT INTO `user`(`id`, `login`, `email`, `firstname`, `lastname`, `password`) VALUES (NULL, '" . $login . "', '" . $email . "', '" . $firstname . "', '" . $lastname . "', '" . password_hash($password, PASSWORD_DEFAULT) . "')";
                $usr_insert = $conn->query($sql);
                echo "Inscription Validée";
                return [$login, $email, $firstname, $lastname];
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
            $conn = new PDO("mysql:host=localhost;dbname=poo", "root", "");
            $sql = "SELECT * FROM user WHERE login = '" . $login . "' ";
            $usr_data = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
            if ($conn->query($sql) == true) {
                if (password_verify($password, $usr_data["password"])) {
                    $this->id = $usr_data["id"];
                    $this->login = $usr_data["login"];
                    $this->email = $usr_data["email"];
                    $this->firstname = $usr_data["firstname"];
                    $this->lastname = $usr_data["lastname"];
                    $this->password = $usr_data["password"];
                    echo "Connexion validée<br>";
                    return [$this->id, $this->login, $this->email, $this->firstname, $this->lastname, $this->password];
                } else {
                    echo "Mauvais password";
                }
            } else {
                echo "Login inconnu";
            }
        } else {
            echo "Veuillez remplir les champs";
        }
    }

    public function disconnect()
    {
        if ($this->id != NULL) {
            $this->id = NULL;
            $this->login = NULL;
            $this->email = NULL;
            $this->firstname = NULL;
            $this->lastname = NULL;
            echo "Déconnexion";
            return "Déconnexion";
        }
    }

    public function delete()
    {
        $conn = new PDO("mysql:host=localhost;dbname=poo", "root", "");
        $sql = "DELETE FROM user WHERE id = " . $this->id;
        $usr_data = $conn->query($sql);
        if ($usr_data == true) {
            $this->disconnect();
        }
    }

    public function update($login, $email, $firstname, $lastname, $password)
    {
        if ($this->id != NULL) {
            $conn = new PDO("mysql:host=localhost;dbname=poo", "root", "");
            $sql = "SELECT * FROM user WHERE id =" . $this->id;
            $usr_data = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
            if (!empty($usr_data)) {
                if ($this->login != $login) {
                    $this->login = $login;
                    echo "login modifé<br>";
                } else {
                    echo "login identique<br>";
                }
                if ($this->email != $email) {
                    $this->email = $email;
                    echo "email modifé<br>";
                } else {
                    echo "email identique<br>";
                }
                if ($this->firstname != $firstname) {
                    $this->firstname = $firstname;
                    echo "firstname modifé<br>";
                } else {
                    echo "firstname identique<br>";
                }
                if ($this->lastname != $lastname) {
                    $this->lastname = $lastname;
                    echo "lastname modifé<br>";
                } else {
                    echo "lastname identique<br>";
                }
                if ($this->password != password_verify($password, $this->password)) {
                    $this->password = password_hash($password, PASSWORD_DEFAULT);
                    echo "password modifé<br>";
                } else {
                    echo "password identique<br>";
                }
                $sql = "UPDATE `user` SET `login`= '" . $this->login . "', `email`= '" . $this->email . "', `firstname`= '" . $this->firstname . "', `lastname`= '" . $this->lastname . "', `password`= '" . password_hash($this->password, PASSWORD_DEFAULT) . "' WHERE id = " . $this->id;
                $usr_data = $conn->query($sql);
            }
        }
    }

    public function isConnected()
    {
        if (isset($this->id)) {
            $logstate = true;
            return $logstate;
        }
    }

    public function getAllInfos()
    {
        return [$this->id, $this->login, $this->email, $this->firstname, $this->lastname, $this->password];
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function refresh($login)
    {
        $conn = new PDO("mysql:host=localhost;dbname=poo", "root", "");
        $sql = "SELECT * FROM user WHERE login = '" . $login . "' ";
        $usr_data = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        $this->id = $usr_data["id"];
        $this->login = $usr_data["login"];
        $this->email = $usr_data["email"];
        $this->firstname = $usr_data["firstname"];
        $this->lastname = $usr_data["lastname"];
        $this->password = $usr_data["password"];
    }
}
