<?php

    session_start();


    $noteContent = "";

    if (array_key_exists("id", $_COOKIE)) {

        $_SESSION['id'] = $_COOKIE['id'];

    }

    if (array_key_exists("id", $_SESSION)) {

        echo "<p class='notePage'>Jesteś zalogowany <a href='index.php?logout=1'>Wyloguj</a></p>";

        include("database.php");

        $query = "SELECT note FROM `users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";

        $row  = mysqli_fetch_array(mysqli_query($link, $query));

        $noteContent = $row['note'];

    } else {

        header("Location: index.php");

    }

    include("header.php");
?>

    <div class="container-fluid">

        <textarea id="note" class="form-control"><?php echo $noteContent; ?></textarea>


    </div>




<?php

    include("footer.php");

?>