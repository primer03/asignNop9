<?php 
session_start();
if(!isset($_SESSION['admin'])){
    echo "<script>";
    echo " window.location.href = '../index.html'";
    echo "</script>";
    echo "sd";
}
 ?>
<nav>
    <div class="nav-start">
        <a href="index.php"><img src="../img/logo.png" alt=""></a>
    </div>
    <div class="nav-end">
        <ul id="menuXDX">
            <li><a class="btnXD" href="reportkamen.php">Kamen Series</a></li>
            <li><a class="btnXD" href="reportera.php">Kamen Era</a></li>
            <li class="drob">
                <a class="btnXD" href="#">ADMIN</a>
                <ul class="menudrob">
                    <li><a class="menulink" href="">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<br>