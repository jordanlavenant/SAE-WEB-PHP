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

                    <script>
                        function changeTheme(element) {
                            element.form.submit();
                            let label = element.nextElementSibling;
                            console.log(label);
                            if (element.checked) {
                                label.style.tetxDecoration = 'underline';
                            } else {
                                label.style.tetxDecoration = 'none';
                            }
                        }
                    </script>

                    <div class='header'>
                        <a href='index.php?action=home'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' style='fill: rgba(222, 238, 237, 1);transform: ;msFilter:;'><path d='M13.939 4.939 6.879 12l7.06 7.061 2.122-2.122L11.121 12l4.94-4.939z'></path></svg>
                        </a>
                        <h1>thème</h1>
                    </div>
                    <form class='myform-theme' method='post'>
                        <h2>light</h2>
                        <div class='themeSelector'>";
                        foreach ($this->themesLight as $theme) {
                            $checked = $theme === $this->currentTheme ? 'checked' : '';
                            echo "
                            <input type='radio' id='$theme' name='theme' value='$theme' $checked onchange='changeTheme(this)'>
                            <label for='$theme'>$theme</label>";
                        }
                        echo "</div>";
                        echo "
                        <h2>dark</h2>
                        <div class='themeSelector'>";
                        foreach ($this->themesDark as $theme) {
                            $checked = $theme === $this->currentTheme ? 'checked' : '';
                            echo "
                            <input type='radio' id='$theme' name='theme' value='$theme' $checked onchange='changeTheme(this)'>
                            <label for='$theme'>$theme</label>";
                        }
                        echo "</div>";
                        echo "  
                        </form>
                        </body>
                    </html>
                </main>";
            }
        }

     
?>