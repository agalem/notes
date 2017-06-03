<?php

session_start();

$error = "";

if (array_key_exists("logout", $_GET)) {

    unset($_SESSION);
    setcookie("id", "", time() - 60*60);
    $_COOKIE["id"] = "";

    session_destroy();

} else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {

    header("Location: loggedinpage.php");

}

if (array_key_exists("submit", $_POST)) {

    include("database.php");

    if (!$_POST['email']) {

        $error .= "Podaj adres email<br>";

    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $error .= "Podany adres email nie jest prawidłowy<br>";

    }

    if (!$_POST['password']) {

        $error .= "Podaj hasło<br>";

    }
    

    if ($error != "") {

        $error = "<p>W twoim formularzu wystapiły błędy:</p>".$error;

    } else {

        if ($_POST['signUp'] == '1') {

            $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) > 0) {

                $error = "Ten adres email jest zajęty.";

            } else {

                $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";

                if (!mysqli_query($link, $query)) {

                    $error = "<p>Nie udało się utworzyć konta, spróbuj później.</p>";

                } else {

                    $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";

                    $id = mysqli_insert_id($link);

                    mysqli_query($link, $query);

                    $_SESSION['id'] = $id;

                    if ($_POST['stayLoggedIn'] == '1') {

                        setcookie("id", $id, time() + 60*60*24*365);

                    }

                    header("Location: loggedinpage.php");

                }

            }

        } else {

            $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

            $result = mysqli_query($link, $query);

            $row = mysqli_fetch_array($result);

            if (isset($row)) {

                $hashedPassword = md5(md5($row['id']).$_POST['password']);

                if ($hashedPassword == $row['password']) {

                    $_SESSION['id'] = $row['id'];

                    if (isset($_POST['stayLoggedIn']) AND $_POST['stayLoggedIn'] == '1') {

                        setcookie("id", $row['id'], time() + 60*60*24*365);

                    }

                    header("Location: loggedinpage.php");

                } else {

                    $error = "To hasło nie odpowiada podanemu adresowy email.";

                }

            } else {

                $error = "To hasło nie odpowiada podanemu adresowi email.";

            }

        }

    }


}


?>

<?php include("header.php"); ?>

<div class="homePageContainer">

    <h1>Notatnik</h1>

    <p><strong>Bezpiecznie przechowuj swoje myśli.</strong></p>

    <div id="error"><?php if ($error!="") {

            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';

        } ?></div>

    <form method="post" id = "signUpForm">

        <p>Zarejestruj się już teraz!</p>

        <fieldset class="form-group">

            <input class="form-control" type="email" name="email" placeholder="Twój Email">

        </fieldset>

        <fieldset class="form-group">

            <input class="form-control" type="password" name="password" placeholder="Hasło">

        </fieldset>

        <div class="checkbox">

            <label>

                <input type="checkbox" name="stayLoggedIn" value=1>Nie wylogowuj mnie

            </label>

        </div>

        <fieldset class="form-group">

            <input type="hidden" name="signUp" value="1">

            <input class="btn btn-success" type="submit" name="submit" value="Zarejestruj się!">

        </fieldset>

        <p><a class="toggleForms">Logowanie</a></p>

    </form>

    <form method="post" id = "logInForm">

        <p>Cieszymy się, że wróciłeś :)</p>

        <fieldset class="form-group">

            <input class="form-control" type="email" name="email" placeholder="Twój Email">

        </fieldset>

        <fieldset class="form-group">

            <input class="form-control"type="password" name="password" placeholder="Hasło">

        </fieldset>

        <div class="checkbox">

            <label>

                <input type="checkbox" name="stayLoggedIn" value=1>Nie wylogowuj mnie

            </label>

        </div>

        <input type="hidden" name="signUp" value="0">

        <fieldset class="form-group">

            <input class="btn btn-success" type="submit" name="submit" value="Zaloguj się!">

        </fieldset>

        <p><a class="toggleForms">Rejestracja</a></p>

    </form>

</div>

<?php include("footer.php"); ?>


