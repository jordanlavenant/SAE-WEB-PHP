<?php

declare(strict_types=1);

require 'BD/gestionBd.php';

class Login {

    function buildLogin() { 

        echo "<div class='Container'>";
            echo "<div class='Login'>";
                echo "<form action='index.php?action=home' method='post'>";

                    echo "<div class='input'>";
                    echo "<label for='email'>email</label>";
                    echo "<input type='text' id='email' name='email' placeholder='email' required>";
                    echo "</div>";

                    echo "<div class='input'>";
                    echo "<label for='password'>mot de passe</label>";
                    echo "<input type='password' id='password' name='password' placeholder='mot de passe' required>";
                    echo "</div>";

                    echo "<input type='submit' value='se connecter'>";
                    echo "<a href='index.php?action=register'>s'inscrire</a>";
                echo "</form>";
            echo "</div>";
        echo "</div>";

        if ($_POST['passwordRegister'] != $_POST['passwordConfirmRegister']) {
            header('Location: index.php?action=register');
        } else {
            insererUtilisateur($_POST['emailRegister'],$_POST['passwordRegister']);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            verificationMdpUser($_GET['email'], $_GET['password']);
        }
    }
}