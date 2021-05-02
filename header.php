<div class="menu">
    <ul class="nav">
        <li>
            Logged in as <?php echo $_SESSION['Username'] ?>
        </li>
        <li>
            <a href="./home.php"><button class="btn">Home</button></a>
        </li>
        <li>
            <a href="./allgames.php"><button class="btn">Browse Games</button></a>
        </li>
        <li>
            <a href="./creation.php"><button class="btn">Create Game</button></a>
        </li>
        <li style="float:right;">
            <a href="./logout.php" onclick="confirmLogOut()"> <button class="btn "> Log Out</button></a>
        </li>
    </ul>
</div>