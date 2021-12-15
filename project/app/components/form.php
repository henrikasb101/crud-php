<div class="overlay-form">
    <a class="close" href="./<?= strtolower($page) ?>">x</a>
    <form action="<?= './'.strtolower($page) ?>" method="post">
        <?php if (isset($editObj) && $editObj != null) { ?>
            <input type="hidden" name="id" value="<?= $editObj->getId() ?>">
            <input class="input" type="text" name="make" placeholder="Vehicle make" value="<?= $editObj->getMake() ?>" required>
            <input class="input" type="text" name="model" placeholder="Vehicle model" value="<?= $editObj->getModel() ?>" required>
            <input class="input" type="text" name="engine" placeholder="Engine" value="<?= $editObj->getEngine() ?>" required>
            <select class="with-disclaimer" name="type" required>
                <option value="" disabled <?= (isset($editObj) && $editObj != null) ? '' : 'selected' ?>>Vehicle type</option>
                <?php foreach ($types as $type) { ?>
                    <?php if ($type->getId() == $editObj->getType()->getId()) { ?>
                        <option value="<?= $type->getId() ?>" selected><?= ucfirst($type->getName()) ?></option>
                    <?php } else { ?>
                        <option value="<?= $type->getId() ?>"><?= ucfirst($type->getName()) ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <span class="disclaimer">If certain vehicle type is not present - you need to add it first!</span>
            <button type="submit" name="submit">Submit Vehicle Changes</button>
        <?php } else { ?>
            <input class="input" type="text" name="make" placeholder="Vehicle make" required>
            <input class="input" type="text" name="model" placeholder="Vehicle model" required>
            <input class="input" type="text" name="engine" placeholder="Engine" required>
            <select class="with-disclaimer" name="type" required>
                <option value="" disabled selected>Vehicle type</option>
                <?php foreach ($types as $type) { ?>
                    <option value="<?= $type->getId() ?>"><?= ucfirst($type->getName()) ?></option>
                <?php } ?>
            </select>
            <span class="disclaimer">If certain vehicle type is not present - you need to add it first!</span>
            <button type="submit" name="submit">Add Vehicle</button>
        <?php } ?>
    </form>
</div>