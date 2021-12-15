<div class="overlay-message <?= ($_GET['msg']) ? 'success' : 'failed' ?>">
    <?php if ($_GET['msg']) { ?>
        <p>Success!</p>
    <?php } else { ?>
        <p>System failed! Try again later..</p>
    <?php } ?>
    <a href="./<?= strtolower($page) ?>">X</a>
</div>