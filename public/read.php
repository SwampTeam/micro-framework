<?php
require_once __DIR__ . '/../src/bootstrap.php';

use Model\ParkPlace;

$parkPlaces = ParkPlace::findAll();

//echo($park['id']);
foreach ($parkPlaces as $parkPlace) { ?>
<table><tr>

    <td><b><?php echo $parkPlace->getType(); ?></b></td>
        <td><?php echo $parkPlace->getNumber(); ?></td>
    <?php
    if ($parkPlace->isOccupied() == 0) {
        echo "<td><span style='color:green'>Parking is free</span></td>";
    }else{
        echo "<td><span style='color:red'>Parking is in use</span></td>";
    } ?>
    <?php
    }
    ?></tr>
</table>