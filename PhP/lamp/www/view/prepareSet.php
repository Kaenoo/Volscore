<?php
$title = 'Préparation du match ' . $game->number;
ob_start();
?>
<link rel="stylesheet" href="../css/stylePrepareSet.css">
<h2>Préparation du set <?= $set->number ?> du match <?= $game->number ?>, <?= $game->receivingTeamName ?> - <?= $game->visitingTeamName ?></h2>
<table>
    <tr>
        <td class="teamPrep">
            <?php if ($receivingPositionsLocked || $visitingPositionsLocked) : ?>
                <!-- Affiche les deux équipes même si les positions sont verrouillées -->
                <table>
                    <tr>
                        <td>
                            <h3>Positions équipe receveuse</h3>
                            <table>
                                <?php foreach ($receivingPositions as $player) : ?>
                                    <tr>
                                        <td><?= $player->playerInfo['number'] ?></td>
                                        <td><?= $player->last_name ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </td>
                        <td>
                            <h3>Positions équipe visiteuse</h3>
                            <table>
                                <?php foreach ($visitingPositions as $player) : ?>
                                    <tr>
                                        <td><?= $player->playerInfo['number'] ?></td>
                                        <td><?= $player->last_name ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                </table>
            <?php else : ?>
                <!-- Affichage du formulaire pour définir les positions -->
                <form method="post" action="?action=setPositions">
                    <!-- Envoi des informations nécessaires pour identifier le match et le set -->
                    <input type="hidden" name="gameid" value="<?= $game->number ?>" />
                    <input type="hidden" name="setid" value="<?= $set->id ?>" />
                    <input type="hidden" name="receiving_teamid" value="<?= $game->receivingTeamId ?>" />
                    <input type="hidden" name="visiting_teamid" value="<?= $game->visitingTeamId ?>" />

                    <table>
                        <tr>
                            <th>Positions <?= $game->receivingTeamName ?></th>
                            <th>Positions <?= $game->visitingTeamName ?></th>
                        </tr>
                        <tr>
                            <!-- Positions Équipe Receveuse -->
                            <td>
                                <?php for ($pos = 1; $pos <= 6; $pos++) : ?>
                                    <label for="pos_receiving<?= $pos ?>">Position <?= $pos ?> :</label>
                                    <select name="position_receiving<?= $pos ?>" id="pos_receiving<?= $pos ?>">
                                        <option value="0"></option>
                                        <?php foreach ($receivingRoster as $player) : ?>
                                            <option value="<?= $player->playerInfo['playerid'] ?>">
                                                <?= $player->playerInfo['number'] ?> - <?= $player->last_name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select><br>
                                <?php endfor; ?>
                                <label>
                                    <!-- Case à cocher pour verrouiller les positions équipe receveuse -->
                                    <input type="checkbox" name="final_receiving"> Finales équipe receveuse
                                </label>
                            </td>

                            <!-- Positions Équipe Visiteuse -->
                            <td>
                                <?php for ($pos = 1; $pos <= 6; $pos++) : ?>
                                    <label for="pos_visiting<?= $pos ?>">Position <?= $pos ?> :</label>
                                    <select name="position_visiting<?= $pos ?>" id="pos_visiting<?= $pos ?>">
                                        <option value="0"></option>
                                        <?php foreach ($visitingRoster as $player) : ?>
                                            <option value="<?= $player->playerInfo['playerid'] ?>">
                                                <?= $player->playerInfo['number'] ?> - <?= $player->last_name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select><br>
                                <?php endfor; ?>
                                <label>
                                    <!-- Case à cocher pour verrouiller les positions équipe visiteuse -->
                                    <input type="checkbox" name="final_visiting"> Finales équipe visiteuse
                                </label>
                            </td>
                        </tr>
                    </table>

                    <!-- Bouton d'enregistrement -->
                    <div style="text-align: center;">
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                    </div>
                </form>
            <?php endif; ?>
        </td>
    </tr>
</table>

<!-- Bouton pour démarrer le set si les deux équipes ont verrouillé leurs positions -->
<?php if ($receivingPositionsLocked && $visitingPositionsLocked) : ?>
    <a href="?action=keepScore&setid=<?= $set->id ?>" class="btn btn-primary">Démarrer le set</a>
<?php endif; ?>

<?php
$content = ob_get_clean();
require_once 'gabarit.php';
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form');

        forms.forEach(form => {
            form.addEventListener('submit', function(event) {
                const selects = form.querySelectorAll('select');
                const selectedValues = [];

                // Validation pour éviter la sélection du même joueur plusieurs fois
                for (const select of selects) {
                    if (select.value !== "0" && selectedValues.includes(select.value)) {
                        alert('Un joueur ne peut pas être sélectionné plusieurs fois.');
                        event.preventDefault(); // Empêche l'envoi du formulaire
                        return;
                    }
                    if (select.value !== "0") {
                        selectedValues.push(select.value);
                    }
                }
            });
        });
    });
</script>
