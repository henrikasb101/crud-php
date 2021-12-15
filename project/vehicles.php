<?php

require_once 'app/config.php';
require_once 'app/models/Vehicle.php';
require_once 'app/models/Type.php';
use app\models\Vehicle;
use app\models\Type;

$page = 'Vehicles';
$showForm = false;

if (isset($_POST['submit'])) {
    $status = (isset($_POST['id'])) ? Vehicle::update($_POST) : Vehicle::create($_POST);
    header('Location: ./'.strtolower($page).'?msg='.$status);
    die();
}

if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'new':
            $showForm = true;
            break;
        case 'edit':
            $editObj = Vehicle::getById($_GET['id']);
            $showForm = true;
            break;
        case 'delete':
            $status = Vehicle::delete($_GET['id']);
            header('Location: ./'.strtolower($page).'?msg='.$status);
            die();
    }
}

$cars = Vehicle::getCars();
$trucks = Vehicle::getTrucks();
$types = Type::getAll();

?>

<!DOCTYPE html>
<html lang="en">
    <?php require 'app/components/head.php' ?>
    <body <?= (isset($_GET['act'])) ? 'class="not-scrollable"' : '' ?>>
        <?php require 'app/components/nav.php' ?>
        <?php if ($showForm) { require 'app/components/form.php'; } ?>
        <div class="container">
            <?php if (isset($_GET['msg'])) { require 'app/components/message.php'; } ?>
            <div class="row end">
                <a class="table-btn" href="./<?= strtolower($page) ?>?act=new">Add New</a>
            </div>
            <?php if (sizeof($cars) > 0 || sizeof($trucks) > 0) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Engine</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="split">
                            <td>Cars</td>
                            <td></td><td></td><td></td>
                        </tr>
                        <?php foreach ($cars as $car) { ?>
                            <tr>
                                <td><?=$car->getMake()?></td>
                                <td><?=$car->getModel()?></td>
                                <td><?=$car->getEngine()?></td>
                                <td>
                                    <div class="link-wrapper">
                                        <a href="./<?= strtolower($page) ?>?act=edit&id=<?= $car->getId() ?>" class="link">Edit</a>
                                        <a href="./<?= strtolower($page) ?>?act=delete&id=<?= $car->getId() ?>" class="link danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr class="split">
                            <td>Trucks</td>
                            <td></td><td></td><td></td>
                        </tr>
                        <?php foreach ($trucks as $truck) { ?>
                            <tr>
                                <td><?=$truck->getMake()?></td>
                                <td><?=$truck->getModel()?></td>
                                <td><?=$truck->getEngine()?></td>
                                <td>
                                    <div class="link-wrapper">
                                        <a href="./<?= strtolower($page) ?>?act=edit&id=<?= $truck->getId() ?>" class="link">Edit</a>
                                        <a href="./<?= strtolower($page) ?>?act=delete&id=<?= $truck->getId() ?>" class="link danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>There are no vehicles saved yet!</p>
            <?php } ?>
        </div>
    </body>
</html>
