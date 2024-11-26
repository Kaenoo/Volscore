<?php
$title = 'Score du match '.$game->number;

ob_start();
?>

<div class="row text-center"><h1>Set <?= $set->number ?></h1></div>
<div class="d-flex flex-row justify-content-around">

    <!-- 1ère équipe -->
    <div class="d-flex flex-column order-<?= (($game->toss+$set->number) % 2 == 0) ? 1 : 2 ?>">
        <div class="teamname"><?= $game->receivingTeamName ?></div>
        <div class="setscore"><?= $game->scoreReceiving ?> sets</div>
        <div class="setscore"><?= count($game->receivingTimeouts) ?> timeouts</div>
        <div class="score"><?= $set->scoreReceiving ?></div>
        <div class="row actions d-flex flex-column">
            <form method="post" action="?action=scorePoint" id="actionForm">
                <input type="hidden" name="setid" value="<?= $set->id ?>" />
                <input type="hidden" name="receiving" value="1" />
                <input type="hidden" name="playerId" id="selectedPlayerId" value="" />

                <div class="d-flex flex-column align-items-stretch">
                    <?php foreach ($receivingPositions as $player) : ?>
                        <button 
                            type="button" 
                            class="btn btn-primary mb-2 w-100 player-button" 
                            data-player-id="<?= $player->id ?>"
                            data-player-name="<?= $player->number ?> <?= $player->last_name ?>">
                            <?= $player->number ?> <?= $player->last_name ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                
                <!-- Boutons pour ajouter un point ou une faute -->
                <div id="actionButtons" class="mt-3" style="display: none;">
                    <button type="submit" name="action" value="point" class="btn btn-success w-100 mb-2">Ajouter un point</button>
                    <button type="submit" name="action" value="fault" class="btn btn-danger w-100">Enregistrer une faute</button>
                </div>
            </form>
        </div>


    </div>

    <!-- 2ème équipe -->
    <div class="d-flex flex-column order-<?= (($game->toss+$set->number) % 2 == 0) ? 2 : 1 ?>">
        <div class="teamname"><?= $game->visitingTeamName ?></div>
        <div class="setscore"><?= $game->scoreVisiting ?></div>
        <div class="setscore"><?= count($game->visitingTimeouts) ?> timeouts</div>
        <div class="score"><?= $set->scoreVisiting ?></div>

        <div class="row actions d-flex flex-column">
    <form method="post" action="?action=scorePoint" id="actionForm">
        <input type="hidden" name="setid" value="<?= $set->id ?>" />
        <input type="hidden" name="receiving" value="0" />
        <input type="hidden" name="playerId" id="selectedPlayerId" value="" />

        <div class="d-flex flex-column align-items-stretch">
            <?php foreach ($visitingPositions as $player) : ?>
                <button 
                    type="button" 
                    class="btn btn-primary mb-2 w-100 player-button" 
                    data-player-id="<?= $player->id ?>"
                    data-player-name="<?= $player->number ?> <?= $player->last_name ?>">
                    <?= $player->number ?> <?= $player->last_name ?>
                </button>
            <?php endforeach; ?>
        </div>
        
        <!-- Boutons pour ajouter un point ou une faute -->
        <div id="actionButtons" class="mt-3" style="display: none;">
            <button type="submit" name="action" value="point" class="btn btn-success w-100 mb-2">Ajouter un point</button>
            <button type="submit" name="action" value="fault" class="btn btn-danger w-100">Enregistrer une faute</button>
        </div>
    </form>
</div>


    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'gabarit.php';
?>