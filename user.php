<?php


class user 
{
	
	private $id ;
	public $login ;
	public $email ;
	public $firstname ;
    public $lastname ;
    
 public function register ($login, $password, $email, $firstname,$lastname)
 {   
$connexion = mysqli_connect("localhost", "root", "", "class");
$query = "INSERT INTO utilisateur( login, password, email, firstname, lastname) VALUES ('" . $login . "','" . $password . "','" . $email . "','". $firstname . "','" . $lastname . "')";
$resultat =  mysqli_query($connexion, $query);
$array = array 
(	"login" =>$login ,
"password" => $password,
"firstname" => $firstname,
"lastname" => $lastname,
"email" => $email);
return $array;
}



public function disconnect()
	{
		session_destroy();
	}

 public function delete($login,$password,$email,$firstname,$lastname){
	$connexion = mysqli_connect("localhost", "root", "", "class");
    $query="DELETE FROM utilisateur WHERE $login = '".$login."' ";
	$resultat=mysqli_query($connexion,$query);
	session_destroy();
	}

public function update($login, $email, $firstname, $lastname)
	{
		$connexion=mysqli_connect("localhost","root","","class");
		$query="UPDATE utilisateur SET login = '".$login."' , email = '".$email."' , firstname = '".$firstname."' , lastname = '".$lastname."' WHERE `id` = ".$this->id.";";
		$resultat=mysqli_query($connexion,$query);
	}

 public function isConnected()
	{$connexion=mysqli_connect("localhost","root","","class");
	 if ($login=true)
		{
			return true;
		}
		else
		{
			return false;
		}
	

	 } 

	


public function getAllInfos()
	{
		$array = 
		array
		(
    		"id" =>$this->id ,
    		"login" =>$this->login ,
    		"password" => $this->password,
    		"firstname" => $this->firstname,
    		"lastname" => $this->lastname,
    		"email" => $this->email
    	);
    	return $array;
	}
	
public function getLogin(){ 
		$connexion = mysqli_connect ("localhost", "root", "", "class");
		$id = $this->id;
		$query = "SELECT login FROM utilisateurs WHERE  id = '$id'";
		$requete = mysqli_query($connexion,$query);
		$resultat = mysqli_fetch_array($requete);
		var_dump($resultat);
		}

public function getEmail(){
			$connexion = mysqli_connect ("localhost", "root", "", "class");
			$id = $this->id;
			$query = "SELECT email FROM utilisateurs WHERE  id = '$id'";
			$requete = mysqli_query($connexion,$query);
			$resultat = mysqli_fetch_array($requete);
			var_dump($resultat);
	  
			}

public function getFirstname(){
				$connexion = mysqli_connect ("localhost", "root", "", "class");
				$id = $this->id;
				$query = "SELECT firstname FROM utilisateurs WHERE  id = '$id'";
				$requete = mysqli_query($connexion,$query);
				$resultat = mysqli_fetch_array($requete);
				var_dump($resultat);
				}
		  
public function getLastname(){
				$connexion = mysqli_connect ("localhost", "root", "", "class");
				$id = $this->id;
				$query = "SELECT lastname FROM utilisateurs WHERE  id = '$id'";
				$requete = mysqli_query($connexion,$query);
				$resultat = mysqli_fetch_array($requete);
				var_dump($resultat);
				}
		  



			}

	

    ?>
