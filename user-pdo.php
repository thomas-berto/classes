<?php


class user 
{
	
	private $id ;
	public $login ;
	public $email ;
	public $firstname ;
    public $lastname ;
    
    public function register ($login, $password, $email, $firstname,
$lastname)
{   
$connexion = new PDO('mysql:host=localhost ;dbname=class ;charset=utf8', 'root','');
$requete = "INSERT INTO utilisateur( login, password, email, firstname, lastname) VALUES ('" . $login . "','" . $password . "','" . $email . "','". $firstname . "','" . $lastname . "')";
$query = $connexion->query($requete);
$array = array 
("login" =>$login ,
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
    
public function delete($login,$password,$email,$firstname,$lastname)
    {
      $connexion = new PDO('mysql:host=localhost;dbname=class', 'root', '');
      $requete="DELETE FROM utilisateur WHERE $login = '".$login."' ";
      $query = $connexion->query($requete);


      session_destroy();
      }



 public function update($login,$password,$email,$firstname,$lastname)
    {
      $connexion = new PDO('mysql:host=localhost;dbname=classe', 'root', '');
      $requete="UPDATE utilisateur SET login = '".$login."' , email = '".$email."' , firstname = '".$firstname."' , lastname = '".$lastname."' WHERE `id` = ".$this->id.";";
      $query = $connexion->query($requete);
  }

  public function isConnected()
  {
      $connexion = new PDO('mysql:host=localhost;dbname=classe', 'root', '');
      if ($login=true){
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	 } 

public function getLogin(){ 
        $connexion = new PDO('mysql:host=localhost;dbname=classe', 'root', '');
		$id = $this->id;
		$requete = "SELECT login FROM utilisateurs WHERE  id = '$id'";
		$query =$connexion->query($requete);
        $fetch = $query->fetchAll();
		var_dump($fetch);
        }
        
public function getEmail()
  {
    $connexion = new PDO('mysql:host=localhost;dbname=classe', 'root', '');
    $id = $this->id;
    $requete = "SELECT email FROM utilisateurs WHERE  id = '$id'";
    $query = $connexion->query($requete);
    $fetch = $query->fetchAll();
		var_dump($fetch);
	  
            }
            
        
            
public function getFirstname()
{
    $connexion = new PDO('mysql:host=localhost;dbname=classe', 'root', '');
    $id = $this->id;
	$requete = "SELECT firstname FROM utilisateurs WHERE  id = '$id'";
    $query = $connexion->query($requete);
    $fetch = $query->fetchAll();
    
				var_dump($fetch);
				}
        
public function getLastname(){  
     $connexion = new PDO('mysql:host=localhost;dbname=classe', 'root', '');
     $id = $this->id;
	 $requete = "SELECT lastname FROM utilisateurs WHERE  id = '$id'";
     $query = $connexion->query($requete);
     $fetch = $query->fetchAll();
    
               var_dump($fetch);

        
				}

            }

            
    ?>