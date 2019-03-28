<?php
require_once __DIR__ . '/../src/bootstrap.php';

use Model\ParkPlace;

$parkPlaces = ParkPlace::findAll();

//echo($park['id']);
foreach ($parkPlaces as $parkPlace) { ?>
<table>
    <b><?php echo $parkPlace->getType(); ?></b>
    <?php echo $parkPlace->getNumber(); ?>
    <?php
    if ($parkPlace->isOccupied() == 0) {
        echo "<span style='color:green'>Parking is free</span>";
    }else{
        echo "<span style='color:red'>Parking is in use</span>";
    } ?>
    <?php
    }
    ?>
</table>