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
		<?php echo "Witaj w chmurze użytkowniku: ".$_COOKIE['uzytkownik']; ?>
			<form method="post" action="dzialania.php" enctype='multipart/form-data'>
				<div id="pierwszy" align="center">
					<input type="submit" name="przycisk" value="Przeglądaj">
					<input type="file" name="plik" placeholder="Niw wybrałeś pliku"><br><br>
					<input type="submit" name="przycisk2" value="Wyślij &#8658;"><br>
				</div>
			</form>
			<?php if($_COOKIE['katalog']===$_COOKIE['uzytkownik']){ ?>
			<form method="post" action="dzialania.php">
				<div id="pierwszy" align="center">
					<p>Podaj nazwe folderu:<input type="text" name="katalog"></p>
					<input type="submit" name="przycisk3" value="Stwórz &#8658;"><br>
				</div>
			</form>
			<?php } ?>
		</body>
</html>
<?php
}
else echo "Nie jesteś zalogowany";
?>