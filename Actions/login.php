<?php

declare(strict_types=1);

class Login {

    function buildLogin() { 

        echo "<div class='Container'>";
            echo "<div class='Login'>";
                echo "<form action='index.php?action=home.php' method='post'>";
                    echo "<label for='email'>email</label>";
                    echo "<input type='text' id='email' name='email' placeholder='email'>";
                    echo "<label for='password'>mot de passe</label>";
                    echo "<input type='password' id='password' name='password' placeholder='mot de passe'>";
                    echo "<input type='submit' value='se connecter'>";
                echo "</form>";
            echo "</div>";
        echo "</div>";
    }
}