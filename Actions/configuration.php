<?php
    declare(strict_types=1);

    require 'Classes/AsideHome/Aside.php';

    use AsideHome\Aside;


    class Configuration {
        private array $themes;
        private string $currentTheme;
        
        function __construct() {
            $this->themes = array("bleu", "violet", "rose", "vert");
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