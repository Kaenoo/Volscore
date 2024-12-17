<?php
$title = 'Equipes';

ob_start();
?>
<div class="container">
    <h1>Equipes</h1>
    <div class="team">
        <ul>

            <?php
            foreach ($teams as $team) {
                echo "<li>" . $team->name . "</li>";
            }
            ?>
        </ul>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'gabarit.php';
?>