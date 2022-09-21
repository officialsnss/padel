$(document).ready(function () {

    //------Fetch Header Token Ajax Code ------//


    $.ajaxSetup({
        headers: {
            "Authorization": localStorage.getItem('token')
        }
    });

    //------Popular Club Ajax Code ------//

    $.ajax({
        type: 'get',
        url: 'api/popularClubs',
        // data: formData.serialize(),
        success: function (data) {
            console.log(data);
        },
        error: function (error) {
            console.log(error);
        }
    });

    //------Login Ajax Code ------//

    $("#login").submit(function (event) {
        var formData = {
            // email: $("#email").val(),
            // password: $("#password").val(),

            email: "enridise@gmail.com",
            password: "12345678",
        };

        $.ajax({
            type: "POST",
            url: "api/login",
            data: formData,
            dataType: "json",
            encode: true,
            success: function (data) {

                if (data.success === true) {
                    console.log(data);
                    localStorage.setItem('token', data.token);
                } else {
                    console.log(data.responseJSON.message);
                }
            },
            error: function (data) {
                // console.log(data);
                console.log(data.responseJSON.message);
            }
        });

        // event.preventDefault();
    });

    //------Registration Ajax Code ------//

    $("#register").submit(function (event) {
        var formData = {
            // email: $("#email").val(),
            // password: $("#password").val(),

            name: "Navjot Singh",
            email: "enridise@gmail.com",
            password: "12345678",
            confirm_password: "12345678",
            phone: "9113764578",
            device_id: ""
        };

        $.ajax({
            type: "POST",
            url: "api/register",
            data: formData,
            dataType: "json",
            encode: true,
            success: function (data) {

                if (data.success === true) {
                    console.log(data.message);
                } else {
                    console.log(data);
                }
            },
            error: function (data) {
                // console.log(data);
                console.log(data.responseJSON.message);
            }
        });

        // event.preventDefault();
    });
});
