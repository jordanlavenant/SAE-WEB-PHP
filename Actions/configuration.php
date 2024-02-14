<?php
    declare(strict_types=1);

    require 'Classes/AsideHome/Aside.php';

    class Configuration {
        private array $themes;
        private string $currentTheme;
        
        function __construct() {
            $this->themes = array("Light", "Dark", "Blue", "Green", "Red");
            $this->currentTheme = $_SESSION["theme"] ?? "Light"; // Default to "Light" if no theme is set
        }
    }

    function buildPlaylist() {
        $aside = new Aside();
        echo $aside->buildAside();
    }

    echo "
        <main>

            <html>
            <head>
                <title>Select Theme</title>
            </head>
            <body>
                <h1>Current Theme: <?php echo $currentTheme; ?></h1>
                <form method='post'>
                    <label for='theme'>Select a theme:</label>
                    <select id='theme' name='theme'>
                        <?php foreach ($themes as $theme): ?>
                            <option value='<?php echo $theme; ?>' <?php echo $theme === $currentTheme ? 'selected' : ''; ?>>
                                <?php echo $theme; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type='submit' value='Save'>
                </form>
            </body>
            </html>
        </main>';

?>