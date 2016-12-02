<?php
    if(isset($_COOKIE['uzytkownik'])){
        setcookie("uzytkownik","",time()-3600);
    }
    if(isset($_COOKIE['kom'])){
        setcookie("kom","",time()-3600);
    }
    if(isset($_COOKIE['katalog'])){
        setcookie("katalog","", time()-3600);
    }
	header("Location: index.html");
?>