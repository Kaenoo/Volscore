<?php
error_reporting(E_ERROR);

$action = isset($_GET['action']) ? $_GET['action'] : 'home';
require_once 'controller/controller.php';
require_once 'model/VolscoreDB.php';
require_once 'vendor/autoload.php';
require_once 'helpers/helpers.php';

switch ($action)
{
    case 'mark':
        markGame($_GET['id']);
        break;
    case 'validate':
        validateTeamForGame($_GET['team'],$_GET['game']);
        break;
    case 'prepareSet':
        prepareSet($_GET['id']);
        break;
    case 'registerToss':
        registerToss($_POST['gameid'], $_POST['cmdTossWinner']);
        break;
    case 'keepScore':
        keepScore($_GET['setid']);
        break;
    case 'timeout':
        timeout($_GET['teamid'],$_GET['setid']);
        break;
    case 'selectBooking':
        showBookings($_GET['teamid'],$_GET['setid']);
        break;
    case 'registerBooking':
        registerBooking($_POST['dpdPlayer'],$_POST['setid'],$_POST['severity']);
        break;
    case 'continueGame':
        continueGame($_GET['gameid']);
        break;
    case 'resumeScoring':
        resumeScoring($_GET['gameid']);
        break;
    case 'scorePoint':
        scorePoint($_POST['setid'],$_POST['receiving'],$_POST['playerid']);
        break;
    case 'setPositions':
        // Données pour l'équipe receveuse
        setPositions(
            $_POST['gameid'], 
            $_POST['setid'], 
            $_POST['receiving_teamid'], 
            $_POST['position_receiving1'], $_POST['position_receiving2'], $_POST['position_receiving3'],
            $_POST['position_receiving4'], $_POST['position_receiving5'], $_POST['position_receiving6'],
            isset($_POST['final_receiving']) ? 1 : 0
        );

        // Données pour l'équipe visiteuse
        setPositions(
            $_POST['gameid'], 
            $_POST['setid'], 
            $_POST['visiting_teamid'], 
            $_POST['position_visiting1'], $_POST['position_visiting2'], $_POST['position_visiting3'],
            $_POST['position_visiting4'], $_POST['position_visiting5'], $_POST['position_visiting6'],
            isset($_POST['final_visiting']) ? 1 : 0
        );

        header('Location: ?action=prepareSet&id=' . $_POST['setid']);
        break;
    case 'teams':
        showTeams();
        break;
    case 'games':
        showGames();
        break;
    case 'sheet':
        showGame($_GET['gameid']);
        break;
    case 'unittests':
        executeUnitTests();
        break;
    default:
        require_once 'view/home.php';
}
?>
