<?php
if(isset($_COOKIE['uzytkownik']) && $_COOKIE['uzytkownik']!==""){
	if(!is_dir($_COOKIE['uzytkownik'])){
		mkdir($_COOKIE['uzytkownik']);
	}
	if(isset($_COOKIE['katalog'])){
        if($_COOKIE['katalog']===""){
            setcookie("katalog", $_COOKIE['uzytkownik']);
        }
    } 
    else{   
        setcookie("katalog", $_COOKIE['uzytkownik']);
    }
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" >
		<link href="glowna.css" rel="stylesheet">
	<title>Witaj w chmurze</title>
	</head>
		<body>
		<a href="wyloguj.php">Wyloguj</a>
		<?php echo "<p id='tytul'>Witaj w chmurze użytkowniku: ".$_COOKIE['uzytkownik']."</p>"; 
			if(isset($_COOKIE['kom']) && $_COOKIE['kom']!==""){
				echo "<p>Czas ostatniego błędnego logowania: ".$COOKIE['kom']."</p>";
			}
		?>
			<form method="post" action="odbierz.php" enctype='multipart/form-data'>
				<div id="pierwszy" align="center">
					<input type="file" name="plik" placeholder="Nie wybrałeś pliku"><br><br>
					<input type="submit" name="przycisk2" value="Wyślij &#8658;"><br>
				</div>
			</form>
			<?php if($_COOKIE['katalog']===$_COOKIE['uzytkownik']){ ?>
					<form method="post" action="dzialania.php">
						<div id="pierwszy" align="center">
							<p id="tytul">Podaj nazwe folderu:<input type="text" name="katalog"></p>
							<input type="submit" name="przycisk3" value="Stwórz &#8658;"><br>
						</div>
					</form>
			<?php
				}
				else{
					echo "<form action='dzialania.php' method='post'><input type='submit' name='wroc' value='Powrót'></form>";
				}
				echo "<form action='dzialania.php' method='post'>";
				echo "<input type='submit' name='usun' value='Usuń zaznaczony plik/katalog'>";
				echo "<p>Bieżący katalog: ".$_COOKIE['katalog']."</p>";
				if (is_dir($_COOKIE['katalog'])) {
					if ($dh = opendir($_COOKIE['katalog'])) {	
					    while (($file = readdir($dh)) !== false) {
							if($file!==".." && $file!=="."){
								if(is_dir($_COOKIE['katalog']."/".$file)){
									echo "<p id='folder'><input type='radio' name='zaznacz' value='".$file."'>";
									echo "<input type='submit' name='przejdz' value='".$file."'></p>";
								}
								else{
									echo "<p id='plik'><input type='radio' name='zaznacz' value='".$file."'><a href='".$_COOKIE['katalog']."/".$file."' download>".$file."</a></p>";
								}
							}
					    }
					    closedir($dh);
				    }
				} 
				echo "</form>";
?>
		</body>
</html>
<?php
}
else echo "Nie jesteś zalogowany";
?>