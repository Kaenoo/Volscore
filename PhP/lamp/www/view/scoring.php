<?php
$title = 'Score du match ' . $game->number;

ob_start();
?>

<div class="row text-center">
    <h1>Set <?= $set->number ?></h1>
</div>
<div class="d-flex flex-row justify-content-around">

    <!-- 1ère équipe -->
    <div class="d-flex flex-column order-<?= (($game->toss + $set->number) % 2 == 0) ? 1 : 2 ?>">
        <div class="teamname"><?= $game->receivingTeamName ?></div>
        <div class="setscore"><?= $game->scoreReceiving ?> sets</div>
        <div class="setscore"><?= count($game->receivingTimeouts) ?> timeouts</div>
        <div class="score"><?= $set->scoreReceiving ?></div>
        <div class="row actions d-flex flex-column">
            <form method="post" action="?action=scorePoint" id="actionForm">
                <input type="hidden" name="setid" value="<?= $set->id ?>" />
                <input type="hidden" name="receiving" value="1" />
                <input type="hidden" name="playerId" id="selectedPlayerId1" value="" />

                <!-- Boutons pour afficher les joueurs-->
                <div class="d-flex flex-column align-items-stretch">
                    <?php foreach ($receivingPositions as $player) : ?>
                        <button
                            type="button"
                            class="player"
                            data-player-id="<?= $player->id ?>"
                            data-player-name="<?= $player->number ?> <?= $player->last_name ?>"
                            onclick="scoreBy1(<?= $player->id ?>)">
                            <?= $player->number ?> <?= $player->last_name ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <!-- Boutons pour ajouter un point ou une faute -->
                <div id="actionButtons" class="mt-3">
                    <button type="submit" name="action" value="point" class="btn btn-success w-100 mb-2">Ajouter un point</button>
                        <a class="btn btn-danger m-2" href="?action=selectBooking&teamid=<?= $game->receivingTeamId ?>&setid=<?= $set->id ?>">
                            Sanctions
                        </a>
                        <?php if (count($game->receivingTimeouts) < 2) : ?>
                            <a class="btn btn-secondary m-2" href="?action=timeout&teamid=<?= $game->receivingTeamId ?>&setid=<?= $set->id ?>" <?= count($game->receivingTimeouts) > 1 ? "disabled" : "" ?>>
                                Temps Mort
                            </a>
                        <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- 2ème équipe -->
    <div class="d-flex flex-column order-<?= (($game->toss + $set->number) % 2 == 0) ? 2 : 1 ?>">
        <div class="teamname"><?= $game->visitingTeamName ?></div>
        <div class="setscore"><?= $game->scoreVisiting ?> sets</div>
        <div class="setscore"><?= count($game->visitingTimeouts) ?> timeouts</div>
        <div class="score"><?= $set->scoreVisiting ?></div>

        <div class="row actions d-flex flex-column">
            <form method="post" action="?action=scorePoint" id="actionForm">
                <input type="hidden" name="setid" value="<?= $set->id ?>" />
                <input type="hidden" name="receiving" value="0" />
                <input type="hidden" name="playerId" id="selectedPlayerId2" value="" />

                <div class="d-flex flex-column align-items-stretch">
                    <?php foreach ($visitingPositions as $player) : ?>
                        <button
                            type="button"
                            class="player"
                            data-player-id="<?= $player->id ?>"
                            data-player-name="<?= $player->number ?> <?= $player->last_name ?>"
                            onclick="scoreBy2(<?= $player->id ?>)">
                            <?= $player->number ?> <?= $player->last_name ?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <!-- Boutons pour ajouter un point ou une faute -->
                <div id="actionButtons" class="mt-3">
                    <button type="submit" name="action" value="point" class="btn btn-success w-100 mb-2">Ajouter un point</button>
                        <a class="btn btn-danger m-2" href="?action=selectBooking&teamid=<?= $game->receivingTeamId ?>&setid=<?= $set->id ?>">
                            Sanctions
                        </a>
                        <?php if (count($game->receivingTimeouts) < 2) : ?>
                            <a class="btn btn-secondary m-2" href="?action=timeout&teamid=<?= $game->receivingTeamId ?>&setid=<?= $set->id ?>" <?= count($game->receivingTimeouts) > 1 ? "disabled" : "" ?>>
                                Temps Mort
                            </a>
                        <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'gabarit.php';
?>

<script>
    function scoreBy1(playerid)
    {
        selectedPlayerId1.value = playerid
    }
    function scoreBy2(playerid)
    {
        selectedPlayerId2.value = playerid
    }
</script>