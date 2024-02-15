<?php
    declare(strict_types=1);

    require 'Classes/AsideHome/Aside.php';

    use AsideHome\Aside;


    class Configuration {
        private array $themes;
        private string $currentTheme;
        
        function __construct() {
            $this->themes = array("bleu", "violet", "rose", "Green", "vert");
            $this->currentTheme = $_SESSION["theme"] ?? "Light"; // Default to "Light" if no theme is set
        }
   

        function buildPlaylist() {
            if (isset($_POST["theme"])) {
                // Save the selected theme to the session
                $_SESSION["theme"] = $_POST["theme"];
                // Update the current theme
                $this->currentTheme = $_POST["theme"];
            }
        
            $aside = new Aside();
            echo $aside->buildAside();
        
            echo "
                <main>
                <head>
                    <title>Choisir un thème</title>
                </head>
                <body class='theme-{$this->currentTheme}'>
                    <form id='themeForm' method='post'>";
                        foreach ($this->themes as $theme) {
                            $checked = $theme === $this->currentTheme ? 'checked' : '';
                            echo "
                            <input type='radio' id='$theme' name='theme' value='$theme' $checked onchange='this.form.submit()'>
                            <label for='$theme'>$theme</label>";
                        }
                echo "  </form>
                </body>
                </html>
                </main>";
            }
        }
        

     
?>