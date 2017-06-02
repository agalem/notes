<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Internetowy notatnik</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>

        html {
            background: url(img/bckg.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        body {
            background: none;
            color: darkblue;
        }

        .homePageContainer {
            max-width: 600px;
            width: 80%;
            margin: 0 auto;
            margin-top: 5%;
            text-align: center;
        }

        .toggleForms {
            font-weight: bold;
            color: white;
        }

        p {
            margin-top: 10px;
        }

        #logInForm {
            display: none;
        }

        #note {
            width: 90vw;
            height: 95vw;
            margin: 0 auto;
        }

        .notePage {
            text-align: right;
            font-size: 14px;
            padding: 5px;
            padding-right: 30px;
        }

    </style>

</head>
<body>
