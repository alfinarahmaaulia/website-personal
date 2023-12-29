$(document).ready(function () {
    $("#login-form").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "login1.php",
            data: $(this).serialize(),
            success: function (response) {
                alert(response);
            },
            error: function (error) {
                console.error("Error during login request");
            }
        });
    });

    $("#register-form").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "register.php",
            data: $(this).serialize(),
            success: function (response) {
                alert(response);
            },
            error: function (error) {
                console.error("Error during registration request");
            }
        });
    });
});
