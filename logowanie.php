<?php  
	session_start(); 																		
	$login=$_POST['login'];                													
	$hasło=$_POST['hasło'];                     											
	$link = mysqli_connect('localhost','','','');   	    
	if(!$link) { echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); }          
	mysqli_query($link, "SET NAMES 'utf8'");                       							
	$result = mysqli_query($link, "SELECT * FROM users WHERE login='$login'");               
	$rekord = mysqli_fetch_assoc($result);                       
	if(!$rekord){ 																			 
	  mysqli_close($link);                    												
	  echo "<center><h2>Błędne dane logowania !</h2><hr><br>";
	  echo "<a href='index.html'>Powrót</a></center>";                  
	}   
	else{                                                     								
		if($rekord['haslo']===$hasło){  													
			$zapytanie = "select id, data_godz, limit_prob from logi where login='".$login."'";
			$wynik = mysqli_query($link, $zapytanie);
			if($wiersz = mysqli_fetch_assoc($wynik)){
				if($wiersz['limit_prob']<4){
					if($wiersz['limit_prob']>0) {setcookie("kom",$wiersz['data_godz']);}
					else {
						if(isset($_COOKIE['kom'])) {setcookie ("kom",'',time()-3600);}                                   
					}
					setcookie('uzytkownik', $login);
					setcookie('katalog', $login);
					$zapytanie = "update logi set limit_prob=0, data_godz=null where id=".$wiersz['id'];
					mysqli_query($link, $zapytanie);
					header('Location: glowna.php'); 
				}
				else{
					$seconds = (strtotime(date("Y-m-d H:i:s", time()))-strtotime($wiersz['data_godz']));
					if($seconds<121){
						echo "Twoje konto zostało zablokowane na 2 minuty.";
					}
					else{
						setcookie("kom",$wiersz['data_godz']);
						setcookie('uzytkownik', $login);
						setcookie('katalog',$login);
						$zapytanie = "update logi set limit_prob=0, data_godz=null where id=".$wiersz['id'];
						mysqli_query($link, $zapytanie); 
						header('Location: glowna.php'); 
					}
				}
			}
			else{
				setcookie('uzytkownik', $login);
				setcookie('katalog',$login);
				$zapytanie = "insert into logi values(null,'".$login."',null,0);";
				mysqli_query($link, $zapytanie);
				header('Location: glowna.php');
			}
			mysqli_close($link);
		}   
		else                          														
		{   
			$zapytanie = "select id, limit_prob from logi where login='".$login."'";
			$wynik = mysqli_query($link, $zapytanie);
			if($wiersz = mysqli_fetch_row($wynik)){
				$zapytanie = "update logi set limit_prob=".($wiersz[1]+1).", data_godz=null where id=".$wiersz[0];
				mysqli_query($link, $zapytanie);
			}
			else{
				$zapytanie="insert into logi values(null,'".$login."',null,1)";
				mysqli_query($link, $zapytanie);
			}
			mysqli_close($link);   															
			echo "<center><h2>Błędne dane logowania!</h2><hr><br>";							
			echo "<a href='index.html'>Powrót</a></center>";	
		}  
	} 
?>
