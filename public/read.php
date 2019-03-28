<?php
require_once __DIR__ . '/../src/bootstrap.php';

use Model\ParkPlace;

$parkPlaces = ParkPlace::findAll();
?>
<table>
    <tr>
        <th>Type</th>
        <th>Place #</th>
        <th>Availability</th>
        <th>edit</th>
    </tr>
    <?php
    foreach ($parkPlaces

    as $parkPlace) { ?>

    <tr>
        <td><b><?php echo $parkPlace->getType(); ?></b></td>
        <td><?php echo $parkPlace->getNumber(); ?></td>
        <?php
        if ($parkPlace->isOccupied() == 0) {
            echo "<td><span style='color:green'>Parking is free</span></td>";
        } else {
            echo "<td><span style='color:red'>Parking is in use</span></td>";
        } ?>
        <td><a href="update.php?id=<?php echo $parkPlace->getId(); ?>"><img
                        src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-1/512/edit-icon.png"
                        width="20px"></a></td>
        <?php
        }
        ?>
    </tr>
</table>