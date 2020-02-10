<?php
session_start();
class user
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
                return [$this->id, $this->login, $this->email, $this->firstname, $this->lastname, $this->password];
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
            var_dump($request);
            $query = mysqli_query($connect, $request);
            $result = mysqli_fetch_all($query);
            var_dump($result);
            if (!empty($result)) {
                if (password_verify($password, $result[0][5])) {
                    $this->id = $result[0][0];
                    $this->login = $result[0][1];
                    $this->email = $result[0][2];
                    $this->firstname = $result[0][3];
                    $this->lastname = $result[0][4];
                    $this->password = $result[0][5];
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
            return "Déconnexion";
        }
    }

    public function delete()
    {
        $connect = mysqli_connect("localhost", "root", "", "poo");
        $request = "DELETE FROM user WHERE id = " . $this->id;
        $query = mysqli_query($connect, $request);

        if ($query == true) {
            $this->disconnect();
        }
    }

    public function update($login, $email, $firstname, $lastname, $password)
    {
        if ($this->id != NULL) {
            $connect = mysqli_connect("localhost", "root", "", "poo");
            $request = "SELECT * FROM user WHERE id = " . $this->id;
            $query = mysqli_query($connect, $request);
            $result = mysqli_fetch_all($query);

            if (!empty($result)) {
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
                $request = "UPDATE `user` SET `login`= '" . $this->login . "', `email`= '" . $this->email . "', `firstname`= '" . $this->firstname . "', `lastname`= '" . $this->lastname . "', `password`= '" . password_hash($this->password, PASSWORD_DEFAULT) . "' WHERE id = " . $this->id;
                $query = mysqli_query($connect, $request);
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

    public function refresh()
    {
        $connect = mysqli_connect("localhost", "root", "", "poo");
        $request = "SELECT * FROM user WHERE id = " . $this->id;
        $query = mysqli_query($connect, $request);
        $result = mysqli_fetch_all($query);
        $this->id = $result[0][0];
        $this->login = $result[0][1];
        $this->email = $result[0][2];
        $this->firstname = $result[0][3];
        $this->lastname = $result[0][4];
        $this->password = $result[0][5];
    }
}
