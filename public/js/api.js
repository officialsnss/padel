$(document).ready(function () {
    // console.log(language);
    //------Fetch Header Token Ajax Code ------//
    var lang = $('#selectedLang').val();

    $.ajaxSetup({
        headers: {
            "Authorization": localStorage.getItem('token'),
            'Accept-Language' : language,
        }
    });

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
                res += '<div class="line-b"><div class="rateyo" id="rateyo" data-rateyo-rating="'+rating+'"></div></div>';
                res += '<div class="line-c">';
                res += '<div class="row g-4 justify-content-between align-items-center">';
                res += '<div class="col-auto"><img src="http://127.0.0.1:8000/frontend/images/wallet-icon.png" alt=""> ' + data.data[i].price + ' KD/hr</div>';
                res += '<div class="col-auto"><img src="http://127.0.0.1:8000/frontend/images/location-icon.png" alt=""> ' + data.data[i].address + '</div>';
                res += '</div>';
                res += '</div>';
                res += '<div class="line-d">';
                res += '<div class="row g-2">';
                for (var j = 0; j < data.data[i].amenities.length; j++) {
                res += '<div class="col-auto"><a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="'+data.data[i].amenities[j].name+'" data-bs-custom-class="custom-tooltip"><img title="'+data.data[i].amenities[j].name+'" src="http://127.0.0.1:8000/Images/'+data.data[i].amenities[j].image+'" alt="'+data.data[i].amenities[j].name+'"></a></div>';
                }
                res += '</div>';
                res += '</div>';
                if(data.data[i].featured_image == ''){
                    featured_image = "club_images/202208191047vpro_azul_gris_amarillo.jpg";
                } else{
                    featured_image = data.data[i].featured_image;
                }
                res += '<div class="line-e"><img src="http://127.0.0.1:8000/Images/'+featured_image+'" alt="" class="img-fluid"></div>';
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

    //------Players List Ajax Code ------//

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
                if(playerslistdata.data[i].image == ''){
                    ply += '<div class="line-a"><img src="images/player-coach/a.jpg" alt="" class="img-fluid"></div>';
                } else {
                    ply += '<div class="line-a"><img src="http://127.0.0.1:8000/Images/'+playerslistdata.data[i].image+'" alt="" class="img-fluid"></div>';
                }
                ply += '<div class="line-b">'+playerslistdata.data[i].name+'</div>';
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
                coa += '<div class="line-a"><img src="http://127.0.0.1:8000/Images/'+coachslistdata.data[i].image+'" alt="" class="img-fluid"></div>';
                coa += '<div class="line-b">'+coachslistdata.data[i].name+'</div>';
                coa += '<div class="line-c">Experience: '+coachslistdata.data[i].experience+'</div>';
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

    //------Contact Us Ajax Code ------//

    $("#sendcontactus").submit(function (event) {
        var contactformData = {
            name: "Navjot Singh",
            email: "enridise@gmail.com",
            phone: "7777799999",
            message: "This is a test message of contact us",
        };

        $.ajax({
            type: "POST",
            url: "api/contact",
            data: contactformData,
            dataType: "json",
            encode: true,
            success: function (data) {

                if (data.success === true) {
                    console.log("Message sent successfully!");
                } else {
                    console.log("Something Went Wrong!");
                }
            },
            error: function (data) {
                // console.log(data);
                console.log(data.responseJSON.message);
            }
        });

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
                coa += '<img src="http://127.0.0.1:8000/Images/'+coachslistdata.data[i].image+'" class="img-fluid players-coach-img" alt="">';
                coa += '</div>';
                coa += '<div class="playerscoach-details">';
                coa += '<h4>'+coachslistdata.data[i].name+'</h4>';
                coa += '<h6>Experience: '+coachslistdata.data[i].experience+'</h6>';
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



});
