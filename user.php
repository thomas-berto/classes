<?php

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
                $request = "INSERT INTO `user`(`id`, `login`, `email`, `firstname`, `lastname`, `password`) VALUES (NULL, '" . $login . "', '" . $email . "', '" . $firstname . "', '" . $lastname . "', '" . $password . "')";
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
}
//$sam = new User();
//var_dump($sam->register("sam", "sam@sam.fr", "sam", "jolly", "0000"));
