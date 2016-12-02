<?php
	if (is_uploaded_file($_FILES['plik']['tmp_name'])){      
       $sciezka = $_COOKIE['katalog']."/".$_FILES['plik']['name'];
       if(move_uploaded_file($_FILES['plik']['tmp_name'],$_COOKIE['katalog']."/".$_FILES['plik']['name'])){
            header("Location: glowna.php");
       }            
       else{
           echo "B³¹d przy przesy³aniu pliku.";
       }
    }            
    else {echo 'B³¹d przy przesy³aniu danych!';} 
?>