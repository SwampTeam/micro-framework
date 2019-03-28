<?php
require_once __DIR__ . '/../src/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['number']) &&
        in_array($_POST['type'], ['normal', 'VIP', 'Woman', 'Fire'])
    ) {
        $_POST['occupied'] = ($_POST['occupied']??null) === 'on' ? 1:0;

        $park = new \Model\ParkPlace();
        $park->create($_POST);
    }
}
?>
<form method="POST">
    <select name="type">
        <option value="normal">Normal</option>
        <option value="VIP">VIP</option>
        <option value="Woman">Woman place</option>
        <option value="Fire">Fire fighter</option>
    </select>

    <input type="text" name="number" required/>

    <input type="checkbox" name="occupied">

    <button>Submit</button>
</form>