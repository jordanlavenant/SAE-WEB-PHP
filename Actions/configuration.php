<?php
    declare(strict_types=1);

    require 'Classes/AsideHome/Aside.php';

    use AsideHome\Aside;


    class Configuration {
        private array $themesLight;
        private array $themesDark;
        private string $currentTheme;
        
        function __construct() { 
            $this->themesDark = array("bleu", "violet", "rose", "vert");
            $this->themesLight = array("mauve");
            $this->currentTheme = $_SESSION["theme"] ?? "Light"; 
        }
   

        function buildPlaylist() {
            if (isset($_POST["theme"])) {
                $_SESSION["theme"] = $_POST["theme"];
                $this->currentTheme = $_POST["theme"];
                header("Location: index.php?action=configuration");
                exit(); 
            }
        
            $aside = new Aside();
            echo $aside->buildAside();
        
            echo "
                <main>
                    <h1>THEMES</h1>
                    <form class='myform-theme' method='post'>
                        <h2>light</h2>";
                        foreach ($this->themesLight as $theme) {
                            $checked = $theme === $this->currentTheme ? 'checked' : '';
                            echo "
                            <input type='radio' id='$theme' name='theme' value='$theme' $checked onchange='this.form.submit()'>
                            <label for='$theme'>$theme</label>";
                        }
                        echo "
                            <h2>dark</h2>";
                            foreach ($this->themesDark as $theme) {
                                $checked = $theme === $this->currentTheme ? 'checked' : '';
                                echo "
                                <input type='radio' id='$theme' name='theme' value='$theme' $checked onchange='this.form.submit()'>
                                <label  for='$theme'>$theme</label>";
                            }
                        echo "  
                        </form>
                        </body>
                    </html>
                </main>";
            }
        }

     
?>