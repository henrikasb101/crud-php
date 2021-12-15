<nav>
    <span class="title"><?= WEB_TITLE ?></span>
    <ul id="fullNav">
        <li class="<?= (isset($page) && $page == 'Dashboard') ? 'active' : '' ?>">
            <a href="./">Dashboard</a>
        </li>
        <li class="<?= (isset($page) && $page == 'Vehicles') ? 'active' : '' ?>">
            <a href="./vehicles">Vehicles</a>
        </li>
    </ul>
    <ul id="mobileNav" >
        <li class="<?= (isset($page) && $page == 'Dashboard') ? 'active' : '' ?>">
            <a href="./">Dashboard</a>
        </li>
        <li class="<?= (isset($page) && $page == 'Vehicles') ? 'active' : '' ?>">
            <a href="./vehicles">Vehicles</a>
        </li>
    </ul>
    <button id="mobileNavButton" onclick="$('#mobileNav').toggle(200)">=</button>
</nav>