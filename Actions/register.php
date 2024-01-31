<?php

declare(strict_types=1);

require 'BD/gestionBd.php';

class Register {

    function buildRegister() { 

        echo "<div class='Container'>";
            echo "<div class='Register'>";
                echo "<form action='index.php?action=login' method='post'>";

                    echo "<div class='header'>";
                        echo "<a href='index.php?action=login'>";
                            echo '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" style="fill: rgba(222, 238, 237, 1);transform: ;msFilter:;"><path d="M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z"></path></svg>';
                        echo "</a>";
                        echo "<h1>créer un compte</h1>";
                    echo "</div>";

                    echo "<div class='input'>";
                    echo "<label for='nom'>nom</label>";
                    echo "<input type='text' id='nom' name='nom' placeholder='nom' required>";
                    echo "</div>";

                    echo "<div class='input'>";
                    echo "<label for='prenom'>prénom</label>";
                    echo "<input type='text' id='prenom' name='prenom' placeholder='prenom' required>";
                    echo "</div>";

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

                    echo "<div class='bottom'>";
                    echo "<input type='submit' value='s&apos;inscrire'>";
                    echo "</div>";

                echo "</form>";
            echo "</div>";

            // if (isset($_REQUEST['warning-message'])) {
            //     echo "<div id='warning'>{$_REQUEST['warning-message']}</div>";
            //     unset($_REQUEST['warning-message']); // Clear the warning message after displaying it
            // }

        echo "</div>";
    }
}