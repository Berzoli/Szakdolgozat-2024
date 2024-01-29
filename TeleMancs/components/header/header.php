<?php

$loggedIn = isset($_SESSION['loggedIn']);


?>


<header>
    <div id="logo">
        
        <div>
        <a href="http://localhost/szakdolgozat/TeleMancs/pages/index">
        <img src="http://localhost/szakdolgozat/TeleMancs/images/logo.png" alt="logo" height="50px"></a>
        </div>
        <div>
        <a href="http://localhost/szakdolgozat/TeleMancs/pages/index"><p>TeleMancs</p></a>
    </div>
        
        
    </div>
    <nav>
        <ul>
            <li><a href="http://localhost/szakdolgozat/TeleMancs/pages/index">Főoldal</a></li>
            <li><a href="http://localhost/szakdolgozat/TeleMancs/pages/kereses">Keresés</a></li>
            <li><a href="http://localhost/szakdolgozat/TeleMancs/pages/rolunk">Rólunk</a></li>
            <li><a href="http://localhost/szakdolgozat/TeleMancs/pages/kapcsolat">Kapcsolat</a></li>
            <li><a href="http://localhost/szakdolgozat/TeleMancs/pages/hirek">Hírek</a></li>
            <?php
               
                if ($loggedIn) {
                   
                    echo '<li><a href="http://localhost/szakdolgozat/TeleMancs/pages/profilom">Profilom</a></li>';
                }
            ?>
        </ul>
    </nav>
    <div id="loginContainer">
        <?php
       
        if ($loggedIn) {
           
            echo '<div><a href="../backend/logout.php">Kijelentkezés</a></div>';
        } else {
           
            echo '<div><a href="http://localhost/szakdolgozat/TeleMancs/pages/bejelentkezes">Bejelentkezés</a></div>';
        }
        
    ?>

    </div>
    

    
</header>