<?php
$title = 'Accueil';
ob_start();
?>
<div class="row">
    <div class="col-6-index">
        <a href="?action=teams">
            <h1>Equipes</h1>
        </a>
    </div>
    <div class="col-6-index">
        <a href="?action=games">
            <h1>Matches</h1>
        </a>
    </div>
</div>
<?php
$content = ob_get_clean();
require_once 'gabarit.php';
?>

