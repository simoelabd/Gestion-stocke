<?php
include 'entet.php';
?>

<div class="home-content">
    <div class="overvie-boxes">
        <div class="overview-boxes">
            <div class="box">
                <form action="../model/changPassword.php" method="post">
                    <h2 style = "color: #06b7e9; text-align: center;">Change Password</h2>
                    <br>
                    <?php

                    ?>
                    <label for="oldPassword">Old Password</label>
                    <input type="password" name="oldPassword" id="oldPassword">

                    <label for="newPassword">New Password</label>
                    <input type="password" name="newPassword" id="newPassword">

                    <label for="confirmPassword">Confirm New Password</label>
                    <input type="password" name="confirmPassword" id="confirmPassword">

                    <button type="submit" name="submit">Update Password</button>

                    <?php
                    if(!empty($_SESSION['message']['text'])){
                    ?>
                        <div class="alert <?=$_SESSION['message']['type']?>">
                            <?=$_SESSION['message']['text']?>
                        </div>
                        <?php
                    }
                    ?>
                </form>
            </div>  
        </div>
    </div>
</div>

<?php
include 'pied.php';
?>