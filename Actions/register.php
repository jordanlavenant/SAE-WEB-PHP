<?php

declare(strict_types=1);

require 'BD/gestionBd.php';

class Register {

    function buildRegister() { 

        echo "<div class='Container'>";
            echo "<div class='Register'>";
                echo "<form action='index.php?action=login' method='post'>";

                    echo "<div class='input'>";
                    echo "<label for='email'>email</label>";
                    echo "<input type='text' id='email' name='emailRegister' placeholder='email' required>";
                    echo "</div>";

                    echo "<div class='input'>";
                    echo "<label for='password'>mot de passe</label>";
                    echo "<input type='password' id='password' name='passwordRegister' placeholder='mot de passe' required>";
                    echo "</div>";

                    echo "<div class='input'>";
                    echo "<label for='passwordConfirm'>confirmer le mot de passe</label>";
                    echo "<input type='password' id='passwordConfirm' name='passwordConfirmRegister' placeholder='confirmer le mot de passe' required>";
                    echo "</div>";

                    echo "<input type='submit' value='s&apos;inscrire'>";
                echo "</form>";
            echo "</div>";
        echo "</div>";
    }
}