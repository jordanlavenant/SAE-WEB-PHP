<?php

declare(strict_types=1);

require 'BD/insertBd.php';
require 'BD/getBd.php';

class Login {

    function buildLogin() { 

        session_destroy();

        // Si les mots de passes ne correspondent pas
        if ($_POST['passwordRegister'] != $_POST['passwordConfirmRegister']) {
            $_REQUEST['warning-message'] = "Les mots de passe doivent correspondre";
            header('Location: index.php?action=register');
            exit();
        } 

        // Insertion
        if ($_SERVER['REQUEST_METHOD'] === 'POST'
                && isset($_POST['emailRegister']) 
                && isset($_POST['nom']) 
                && isset($_POST['prenom']) 
                && isset($_POST['passwordRegister'])) {
            insererUtilisateur($_POST['emailRegister'], $_POST['nom'], $_POST['prenom'], $_POST['passwordRegister']);
        }

        echo "<div class='Login'>";

            echo "<div class='arrival-content'>";
            echo "<img src='static/images/VisualStudioMusicLogo-" . $_SESSION['theme'] . ".png' alt='logo'>";
            echo "<h1>visual studio music</h1>";
            echo "</div>";

            echo "<form action='index.php?action=verifConnexion' method='post'>";

                echo "<div class='header'>";
                    echo "<a href='index.php?action=login'>";
                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" style="fill: rgba(222, 238, 237, 1);transform: ;msFilter:;"><path d="M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z"></path></svg>';
                    echo "</a>";
                    echo "<h1>se connecter</h1>";
                echo "</div>";

                echo "<div class='input'>";
                echo "<label for='email'>email</label>";
                echo "<input type='text' id='email' name='email' placeholder='email' required>";
                echo "</div>";

                echo "<div class='input'>";
                echo "<label for='password'>mot de passe</label>";
                echo "<input type='password' id='password' name='password' placeholder='' required>";
                echo "</div>";

                echo "<div class='bottom'>";
                echo "<input type='submit' value='se connecter'>";
                echo "<a href='index.php?action=register'>s'inscrire</a>";
                echo "</div>";
            echo "</form>";
        echo "</div>";
    }
}