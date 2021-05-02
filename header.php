<div class="menu">
    <ul class="horizontal">

        <li>
            <a href="./home.php"><button class="btn">Home</button></a>
        </li>
        <li>
            <a href="./allgames.php"><button class="btn">Browse Games</button></a>
        </li>
        <li>
            <a href="./creation.php"><button class="btn">Create Game</button></a>
        </li>

        <li class="right-name">
            <a href="./logout.php" onclick="confirmLogOut()"> <button class="btn "> Log Out</button></a>
        </li>
        <li class="right-name">
            <a>
                <button class="btn"> Logged in as
                    <?php echo $_SESSION['Username'] ?>
                </button>
            </a>

        </li>
    </ul>
</div>