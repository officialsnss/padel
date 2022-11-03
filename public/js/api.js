$(document).ready(function () {
    // console.log(language);
    //------Fetch Header Token Ajax Code ------//
    var lang = $('#selectedLang').val();

    $.ajaxSetup({
        headers: {
            "Authorization": localStorage.getItem('token'),
            'Accept-Language': language,
        }
    });

    $('#error-class').hide();
    $('#success-class').hide();
    setTimeout(function () {
        $('#otp-success-class').hide();
    }, 10000);


    //------Popular Club Ajax Code ------//

    $.ajax({
        type: 'get',
        url: 'api/popularClubs',
        // data: formData.serialize(),
        // headers: {
        //     'Accept-Language' : language,
        // },
        success: function (data) {
            // alert(lang);
            // console.log(data);
            var res = "";
            for (var i = 0; i < data.data.length; i++) {
                res += '<div class="swiper-slide">';
                res += '<div class="pc-block">';
                res += '<div class="pc-button"><a href="javascript:void(0)"><i class="bi bi-chevron-right"></i></a></div>';
                res += '<div class="line-a">' + data.data[i].name + '</div>';
                var rating = data.data[i].rating;
                res += '<div class="line-b"><div class="rateyo" id="rateyo" data-rateyo-rating="' + rating + '"></div></div>';
                res += '<div class="line-c">';
                res += '<div class="row g-4 justify-content-between align-items-center">';
                res += '<div class="col-auto"><img src="http://127.0.0.1:8000/frontend/images/wallet-icon.png" alt=""> ' + data.data[i].price + ' KD/hr</div>';
                res += '<div class="col-auto"><img src="http://127.0.0.1:8000/frontend/images/location-icon.png" alt=""> ' + data.data[i].address + '</div>';
                res += '</div>';
                res += '</div>';
                res += '<div class="line-d">';
                res += '<div class="row g-2">';
                for (var j = 0; j < data.data[i].amenities.length; j++) {
                    res += '<div class="col-auto"><a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="' + data.data[i].amenities[j].name + '" data-bs-custom-class="custom-tooltip"><img title="' + data.data[i].amenities[j].name + '" src="http://127.0.0.1:8000/Images/' + data.data[i].amenities[j].image + '" alt="' + data.data[i].amenities[j].name + '"></a></div>';
                }
                res += '</div>';
                res += '</div>';
                if (data.data[i].featured_image == '') {
                    featured_image = "club_images/202208191047vpro_azul_gris_amarillo.jpg";
                } else {
                    featured_image = data.data[i].featured_image;
                }
                res += '<div class="line-e"><img src="http://127.0.0.1:8000/Images/' + featured_image + '" alt="" class="img-fluid"></div>';
                res += '</div>';
                res += '</div>';
            }
            // alert(res);

            $(".res-data").append(res);
            $(".rateyo").rateYo({
                // rating: 5,
                starWidth: "25px",
                numStars: 5,
                minValue: 0,
                maxValue: 5,
                normalFill: "gray",
                ratedFill: "orange",
                readOnly: true
            });

        },
        error: function (error) {
            // alert("Error");
            // console.log(error);
        }
    });

    //------Players List Ajax Code Home Page ------//

    $.ajax({
        type: 'get',
        url: 'api/get/playersList',
        // data: formData.serialize(),
        success: function (playerslistdata) {
            var ply = "";
            // console.log(playerslistdata);
            for (var i = 0; i < playerslistdata.data.length; i++) {

                ply += '<div class="swiper-slide">';
                ply += '<div class="players-coach-block">';
                if (playerslistdata.data[i].image == '') {
                    ply += '<div class="line-a"><img src="images/player-coach/a.jpg" alt="" class="img-fluid"></div>';
                } else {
                    ply += '<div class="line-a"><img src="http://127.0.0.1:8000/Images/' + playerslistdata.data[i].image + '" alt="" class="img-fluid"></div>';
                }
                ply += '<div class="line-b">' + playerslistdata.data[i].name + '</div>';
                ply += '<div class="line-c">Experience: 12 years</div>';
                ply += '<div class="line-d"><img src="images/star.png" alt=""></div>';
                ply += '</div>';
                ply += '</div>';
            }
            $(".player-list-data").append(ply);
        },
        error: function (error) {
            // console.log(error);
        }
    });

    //------Players List Ajax Code Player Page ------//
    $.ajax({
        type: 'get',
        url: 'api/get/playersList',
        // data: formData.serialize(),
        success: function (playerslistdata) {
            var ply = "";
            // console.log(playerslistdata);
            for (var i = 0; i < playerslistdata.data.length; i++) {

                ply += '<div class="col-lg-3 col-md-3 col-sm-4 playes-col">';
                ply += '<div class="players-coach-block">';
                if (playerslistdata.data[i].image == '') {
                    ply +=
                        '<div class="line-a"><img src="images/player-coach/a.jpg" alt="" class="img-fluid"></div>';
                } else {
                    ply += '<div class="line-a"><img src="http://127.0.0.1:8000/Images/' + playerslistdata
                        .data[i].image + '" alt="" class="img-fluid"></div>';
                }
                ply += '<div class="line-b">' + playerslistdata.data[i].name + '</div>';
                ply += '<div class="line-c">Experience: 12 years</div>';
                ply += '<div class="line-d"><img src="images/star.png" alt=""></div>';
                ply += '</div>';
                ply += '</div>';
            }
            $(".players-data").append(ply);
        },
        error: function (error) {
            // console.log(error);
        }
    });

    //------Coach List Ajax Code ------//

    $.ajax({
        type: 'get',
        url: 'api/get/coaches',
        // data: formData.serialize(),
        success: function (coachslistdata) {
            var coa = "";
            // console.log(coachslistdata);
            for (var i = 0; i < coachslistdata.data.length; i++) {
                coa += '<div class="swiper-slide">';
                coa += '<div class="players-coach-block">';
                coa += '<div class="line-a"><img src="http://127.0.0.1:8000/Images/' + coachslistdata.data[i].image + '" alt="" class="img-fluid"></div>';
                coa += '<div class="line-b">' + coachslistdata.data[i].name + '</div>';
                coa += '<div class="line-c">Experience: ' + coachslistdata.data[i].experience + '</div>';
                coa += '<div class="line-d"><img src="images/star.png" alt=""></div>';
                coa += '</div>';
                coa += '</div>';
            }
            $(".coach-list-data").append(coa);
        },
        error: function (error) {
            // console.log(error);
        }
    });

    //------Login Ajax Code ------//

    $("#login").click(function () {
        var formData = {
            email: $("#login-email").val(),
            password: $("#login-password").val(),

            // email: "enridise@gmail.com",
            // password: "12345678",
        };

        $.ajax({
            type: "POST",
            url: "api/login",
            data: formData,
            dataType: "json",
            encode: true,
            success: function (data) {

                if (data.success === true) {
                    $('#error-class').hide();
                    console.log(data);
                    writeCookie('token',data.token,1);
                    writeCookie('data',data.data,1);
                    console.log(document.cookie);
                    alert(document.cookie.token);
                    localStorage.setItem('token', data.token);
                    // window.location.href = "/authenticate";
                } else {
                    $('#error-text').html(data.message);
                    $('#error-class').show();
                    // console.log(data.message);
                }
            }
            // error: function (data) {
            //     console.log(data);
            // }
        });

        // event.preventDefault();
    });

    function writeCookie(name,value,days) {
        var date, expires;
        if (days) {
            date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            expires = "; expires=" + date.toGMTString();
                }else{
            expires = "";
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    //------Registration Ajax Code ------//

    $("#register").click(function () {
        $('#register').attr('disabled', 'disabled');
        var name = $("#signup-name").val();
        var email = $("#signup-email").val();
        var phone = $("#signup-mobile").val();
        var password = $("#signup-password").val();
        var device_id = $("#ip").val();
        var confirmpassword = $("#signup-confirm-password").val();
        if (name === "" || email === "" || phone === "" || password === "" || confirmpassword === "") {
            $('#register').removeAttr('disabled');
            $('#error-text').html("All fields must be field.");
            $('#error-class').show();
        } else {
            if (password == confirmpassword) {
                var formData = {
                    name: $("#signup-name").val(),
                    email: $("#signup-email").val(),
                    password: $("#signup-password").val(),
                    phone: $("#signup-mobile").val(),
                    device_id: $("#ip").val()
                };

                $.ajax({
                    type: "POST",
                    url: "api/register",
                    data: formData,
                    dataType: "json",
                    encode: true,
                    success: function (data) {

                        if (data.success === true) {
                            window.location.href = "/verify/" + device_id + "/" + phone;
                            console.log(data.message);
                        } else {
                            $('#register').removeAttr('disabled');
                            $('#error-text').html(data.message);
                            $('#error-class').show();
                        }
                    },
                    error: function (data) {
                        $('#register').removeAttr('disabled');
                        console.log(data.responseJSON.message);
                    }
                });
            } else {
                $('#register').removeAttr('disabled');
                $('#error-text').html("Password and  Confirm password does not match.");
                $('#error-class').show();
            }
        }
        setTimeout(function () {
            $('#error-class').hide();
        }, 5000);
        setTimeout(function () {
            $('#success-class').hide();
        }, 5000);
    });

    //------Contact Us Ajax Code ------//

    $("#sendcontactus").click(function () {
        $('#sendcontactus').attr('disabled', 'disabled');
        var $this = $(this);
        $this.button('loading');
        var contactformData = {
            name: $("#first_name").val() + " " + $("#last_name").val(),
            email: $("#email").val(),
            phone: $("#mobile").val(),
            message: $("#message").val(),
        };

        $.ajax({
            type: "POST",
            url: "api/contact",
            data: contactformData,
            dataType: "json",
            encode: true,
            success: function (data) {

                if (data.success === true) {
                    $this.button('reset');
                    $('#sendcontactus').attr('disabled', 'disabled');
                    $('#success-text').html(data.message);
                    $('#success-class').show();
                    $("#first_name").val("");
                    $("#last_name").val("");
                    $("#email").val("");
                    $("#mobile").val("");
                    $("#message").val("");
                } else {
                    $this.button('reset');
                    $('#sendcontactus').removeAttr('disabled');
                    $('#error-text').html(data.message);
                    $('#error-class').show();
                }
            },
            error: function (data) {
                $this.button('reset');
                $('#sendcontactus').removeAttr('disabled');
                $('#error-text').html(data.message);
                $('#error-class').show();
            }
        });
        setTimeout(function () {
            $('#error-class').hide();
        }, 10000);
        setTimeout(function () {
            $('#success-class').hide();
        }, 10000);
        // event.preventDefault();
    });

    //------CMS Pages Ajax Code ------//

    $.ajax({

        type: 'get',
        url: 'api/policy?id=',
        // data: formData.serialize(),
        success: function (coachslistdata) {
            var coa = "";
            console.log(coachslistdata);
            for (var i = 0; i < coachslistdata.data.length; i++) {

                coa += '<div class="swiper-slide">';
                coa += '<div class="playerscoach-div">';
                coa += '<img src="http://127.0.0.1:8000/Images/' + coachslistdata.data[i].image + '" class="img-fluid players-coach-img" alt="">';
                coa += '</div>';
                coa += '<div class="playerscoach-details">';
                coa += '<h4>' + coachslistdata.data[i].name + '</h4>';
                coa += '<h6>Experience: ' + coachslistdata.data[i].experience + '</h6>';
                // coa += '<div class="star-rating-players">';
                // coa += '<div class="star-rating">';
                // coa += '<label for="5-stars" class="star" style="color: #fc0;">&#9733;</label>';
                // coa += '<label for="5-stars" class="star" style="color: #fc0;">&#9733;</label>';
                // coa += '</div>';
                // coa += '</div>';
                coa += '</div>';
                coa += '</div>';
            }
            $(".coach-list-data").append(coa);
        },
        error: function (error) {
            console.log(error);
        }
    });

    //------Verify OTP Ajax Code ------//

    $("#verify").click(function () {
        $('#verify').attr('disabled', 'disabled');
        var $this = $(this);
        $this.button('loading');
        var contactformData = {
            otp: $("#otp").val(),
            device_id: $("#ip").val(),
            phone: $("#phone").val(),
        };

        $.ajax({
            type: "POST",
            url: "/api/verifyOtp",
            data: contactformData,
            dataType: "json",
            encode: true,
            success: function (data) {

                if (data.success === true) {
                    $this.button('reset');
                    $('#verify').attr('disabled', 'disabled');
                    $('#success-text').html("Account successfully verified. Redirecting you to loging page.");
                    $('#success-class').show();
                    setTimeout(function () {
                        window.location.href = "/login";
                    }, 10000);
                } else {
                    $this.button('reset');
                    $('#verify').removeAttr('disabled');
                    $('#error-text').html(data.message);
                    $('#error-class').show();
                    console.log(data);
                }
            },
            error: function (data) {
                $this.button('reset');
                $('#verify').removeAttr('disabled');
                $('#error-text').html(data.message);
                $('#error-class').show();
            }
        });
        setTimeout(function () {
            $('#error-class').hide();
        }, 10000);
        setTimeout(function () {
            $('#success-class').hide();
        }, 10000);
        // event.preventDefault();
    });

    //------All Club Ajax Code ------//

    $.ajax({
        type: 'get',
        url: 'api/clubs',
        // data: formData.serialize(),
        // headers: {
        //     'Accept-Language' : language,
        // },
        success: function (data) {
            // alert(lang);

            var res = "";
            console.log(data);
            for (var i = 0; i < data.data.length; i++) {
                res += '<div class="col-12 col-sm-12 col-md-6 col-lg-4">';
                res += '<div class="courts-block">';
                res += '<div class="courts-block-img">';
                console.log("All club listing");
                if (data.data[i].featured_image == '') {
                    featured_image = "club_images/202208191047vpro_azul_gris_amarillo.jpg";
                } else {
                    featured_image = data.data[i].featured_image;
                }
                res += '<img src="http://127.0.0.1:8000/Images/' + featured_image + '" alt="' + featured_image + '" class="img-fluid">';
                var rating = data.data[i].rating;
                res += '<span class="rating"><i class="bi bi-star-fill"></i> '+data.data[i].rating+'</span>';
                res += '<span class="price"><i class="bi bi-ticket-fill"></i> ' + data.data[i].price + ' KWD/hr</span>';
                res += '</div>';
                res += '<div class="courts-block-desc">';
                res += '<div class="line-a">' + data.data[i].name + '</div>';
                res += '<div class="line-b">';
                res += '<div class="row g-1">';
                for (var j = 0; j < data.data[i].amenities.length; j++) {
                res += '<div class="col-2"><div class="courts-icons" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="' + data.data[i].amenities[j].name + '" data-bs-custom-class="custom-tooltip"><img title="' + data.data[i].amenities[j].name + '" src="http://127.0.0.1:8000/Images/' + data.data[i].amenities[j].image + '" alt="' + data.data[i].amenities[j].name + '" class="img-fluid"></div></div>';
                }
                res += '</div>';
                res += '</div>';
                res += '<div class="line-c"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#court-details">More Details</a></div>';
                res += '</div>';
                res += '</div>';
                res += '</div>';
            }
            // alert(res);
            console.log(res);

            $(".all-club-data").append(res);
            $(".rateyo").rateYo({
                // rating: 5,
                starWidth: "25px",
                numStars: 5,
                minValue: 0,
                maxValue: 5,
                normalFill: "gray",
                ratedFill: "orange",
                readOnly: true
            });

        },
        error: function (error) {
            // alert("Error");
            // console.log(error);
        }
    });


});
