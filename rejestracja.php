<?php															
	if(isset($_POST['login'])){														//jeśli jest wpisany login
		$blad = false;																//pod zmienną podstawiamy false
		$polaczenie = mysql_connect('localhost','','');								//łączenie z serwerem MySql
		if($polaczenie){															//jeśli uda się nawiązać połączenie
			mysql_select_db("");													//to wybieramy bazę danych
			$zmienna = mysql_query("SELECT login FROM users;");						//pod zmienną podstawiamy login
			while($wynik = @mysql_fetch_assoc($zmienna)){							//sprawdzamy dla wszystkich loginów w bazie
				if($wynik['login'] === $_POST['login']){							//jeśli login w bazie i ten podany przez użytkownika jest taki sam
					$blad = true;													//to błąd ustawiamy na true 
					break;															//i przerywamy 
				}
			}
			if(!$blad){																//jeśli podany login jest wolny
				mysql_query("SET NAMES utf8");																	
				$zap = "INSERT INTO users VALUES('".$_POST['login']."','".$_POST['hasło']."','".$_POST['telefon']."','".$_POST['email']."');";
				mysql_query($zap);																			//dodajemy dane do bazy
				echo "<center><br>Udało Ci się zarejestrować!</br>";								//wyświetlamy komunikat
				echo "<br><a href='index.html'>Zaloguj się</a></br></center>";					//link do systemu logowania
			}
			else {																							//jeśli podany login jest zajęty
				echo "<center><br>Wybrany login jest już zajęty</br>";										//wyświetlamy komunikat
				echo "<br><a href='rejestracja.html'>Powrót do rejestracji</a></br></center>";		//link powrotny

			}
		}
		else echo "Brak połączenia z bazą danych";									//komunikat o braku połączenia
	}
?>