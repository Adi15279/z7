<?php   
	if(isset($_POST['przycisk3'])){
		if(mkdir($_COOKIE['uzytkownik']."/".$_POST['katalog'])){
			header("Location: glowna.php");
		}
		else echo "B³¹d przy tworzeniu katalogu.";
	}
	if(isset($_POST['usun'])){
		if(isset($_POST['zaznacz'])){
			if(is_dir($_COOKIE['katalog']."/".$_POST['zaznacz'])){
				if(@rmdir($_COOKIE['katalog']."/".$_POST['zaznacz'])){
					header("Location: glowna.php");
				}
				else{
					if ($dh = opendir($_COOKIE['katalog']."/".$_POST['zaznacz'])) {	
					    while (($file = readdir($dh)) !== false) {
							if($file!==".." && $file!=="."){
								unlink($_COOKIE['katalog']."/".$_POST['zaznacz']."/".$file);
							}
					    }
					    closedir($dh);
				    }
					rmdir($_COOKIE['katalog']."/".$_POST['zaznacz']);
				}
			}
			else{
				unlink($_COOKIE['katalog']."/".$_POST['zaznacz']);
			}
			header("Location: glowna.php");
		}
	}
	if(isset($_POST['przejdz'])){
		setcookie("katalog", $_COOKIE['uzytkownik']."/".$_POST['przejdz']);
		header("Location: glowna.php");
	}
	if(isset($_POST['wroc'])){
		setcookie("katalog", $_COOKIE['uzytkownik']);
		header("Location: glowna.php");
	}
?> 
