<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript">

    $(".toggleForms").click(function() {

        $("#signUpForm").toggle();
        $("#logInForm").toggle();

    });

    $('#note').bind('input propertychange', function () {

        $.ajax({
            method: "POST",
            url: "updateDatabase.php",
            data: { content: $("#note").val() }
        });

    });


</script>
</body>
</html>
