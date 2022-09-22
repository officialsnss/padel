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
            var res = "";
            for (var i = 0; i < data.data.length; i++) {
                res += '<div class="swiper-slide">';
                res += '<div class="courts-div">';
                res += ' <div class="courts-name-desc">';
                res += '<h4 class="text-white">' + data.data[i].name + '</h4>';
                res += '<div class="star-rating">';

                if (data.data[i].rating > 4.9) {
                    res += '<label for="5-stars" class="star" style="color: #fc0;">&#9733;</label>';
                    res += '<label for="4-stars" class="star" style="color: #fc0;">&#9733;</label>';
                    res += '<label for="3-stars" class="star" style="color: #fc0;">&#9733;</label>';
                    res += '<label for="2-stars" class="star" style="color: #fc0;">&#9733;</label>';
                    res += '<label for="1-star" class="star" style="color: #fc0;">&#9733;</label>';
                } else if (data.data[i].rating >= 4 && data.data[i].rating <= 4.9) {
                    res += '<label for="5-stars" class="star">&#9733;</label>';
                    res += '<label for="4-stars" class="star" style="color: #fc0;">&#9733;</label>';
                    res += '<label for="3-stars" class="star" style="color: #fc0;">&#9733;</label>';
                    res += '<label for="2-stars" class="star" style="color: #fc0;">&#9733;</label>';
                    res += '<label for="1-star" class="star" style="color: #fc0;">&#9733;</label>';
                } else if (data.data[i].rating >= 3 && data.data[i].rating <= 3.9) {
                    res += '<label for="5-stars" class="star">&#9733;</label>';
                    res += '<label for="4-stars" class="star">&#9733;</label>';
                    res += '<label for="3-stars" class="star" style="color: #fc0;">&#9733;</label>';
                    res += '<label for="2-stars" class="star" style="color: #fc0;">&#9733;</label>';
                    res += '<label for="1-star" class="star" style="color: #fc0;">&#9733;</label>';
                } else if (data.data[i].rating >= 2 && data.data[i].rating <= 2.9) {
                    res += '<label for="5-stars" class="star">&#9733;</label>';
                    res += '<label for="4-stars" class="star">&#9733;</label>';
                    res += '<label for="3-stars" class="star">&#9733;</label>';
                    res += '<label for="2-stars" class="star" style="color: #fc0;">&#9733;</label>';
                    res += '<label for="1-star" class="star" style="color: #fc0;">&#9733;</label>';
                } else if (data.data[i].rating >= 1 && data.data[i].rating <= 1.9) {
                    res += '<label for="5-stars" class="star">&#9733;</label>';
                    res += '<label for="4-stars" class="star">&#9733;</label>';
                    res += '<label for="3-stars" class="star">&#9733;</label>';
                    res += '<label for="2-stars" class="star">&#9733;</label>';
                    res += '<label for="1-star" class="star" style="color: #fc0;">&#9733;</label>';
                } else {
                    res += '<label for="5-stars" class="star">&#9733;</label>';
                    res += '<label for="4-stars" class="star">&#9733;</label>';
                    res += '<label for="3-stars" class="star">&#9733;</label>';
                    res += '<label for="2-stars" class="star">&#9733;</label>';
                    res += '<label for="1-star" class="star">&#9733;</label>';
                }
                res += '</div>';
                res += '<div class="clearfix-space"></div>';
                res += '<div class="row">';
                res += '<div class="col-6 col-lg-6 col-md-6 col-sm-6">';
                res += ' <span><img src="http://retalkapp.com/tbaree/01/images/icons/wallet.png" class="img-fluid" alt=""> ' + data.data[i].price + 'KD/hr</span>';
                res += ' </div>';
                res += ' <div class="col-6 col-lg-6 col-md-6 col-sm-6">';
                res += ' <span><img src="http://retalkapp.com/tbaree/01/images/icons/location-pin.png" class="img-fluid" alt=""> ' + data.data[i].address + '</span>';
                res += ' </div>';
                res += ' </div>';
                res += ' <div class="clearfix-space"></div>';
                res += '<div class="row">';
                res += '<div class="col-2 col-lg-2 col-md-2 col-sm-2">';
                res += '<div class="court-icons">';
                res += '<img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-1.png" class="img-fluid" alt="">';
                res += '</div>';
                res += '</div>';
                res += '<div class="col-2 col-lg-2 col-md-2 col-sm-2">';
                res += '<div class="court-icons">';
                res += '<img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-2.png" class="img-fluid" alt="">';
                res += '</div>';
                res += '</div>';
                res += '<div class="col-2 col-lg-2 col-md-2 col-sm-2">';
                res += '<div class="court-icons">';
                res += '<img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-3.png" class="img-fluid" alt="">';
                res += '</div>';
                res += '</div>';
                res += '<div class="col-2 col-lg-2 col-md-2 col-sm-2">';
                res += '<div class="court-icons">';
                res += '<img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-4.png" class="img-fluid" alt="">';
                res += '</div>';
                res += '</div>';
                res += '<div class="col-2 col-lg-2 col-md-2 col-sm-2">';
                res += '<div class="court-icons">';
                res += '<img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-5.png" class="img-fluid" alt="">';
                res += '</div>';
                res += '</div>';
                res += '</div>';
                res += '</div>';
                res += '<img src="http://127.0.0.1:8000/Images/'+data.data[i].featured_image+'" class="img-fluid" alt="">';
                res += '</div>';
                res += '<div class="know-more-arrow">';
                res += '<a href="javascript:void(0)"><img src="http://retalkapp.com/tbaree/01/images/arrow-next-icon.png" class="img-fluid" alt=""></a>';
                res += '</div>';
                res += '</div>';
                res += '</div>';
            }
            // alert(res);

            $(".res-data").append(res);

        },
        error: function (error) {
            console.log(error);
        }
    });

    //------Players List Ajax Code ------//

    $.ajax({
        type: 'get',
        url: 'api/get/players',
        // data: formData.serialize(),
        success: function (playerslistdata) {
            var ply = "";
            console.log(playerslistdata);
            for (var i = 0; i < playerslistdata.data.length; i++) {

                ply += '<div class="swiper-slide">';
                ply += '<div class="playerscoach-div">';
                ply += '<img src="http://127.0.0.1:8000/Images/'+playerslistdata.data[i].image+'" class="img-fluid players-coach-img" alt="">';
                ply += '</div>';
                ply += '<div class="playerscoach-details">';
                ply += '<h4>'+playerslistdata.data[i].name+'</h4>';
                // ply += '<h6>Experience: 12 Years</h6>';
                // ply += '<div class="star-rating-players">';
                // ply += '<div class="star-rating">';
                // ply += '<label for="5-stars" class="star" style="color: #fc0;">&#9733;</label>';
                // ply += '<label for="5-stars" class="star" style="color: #fc0;">&#9733;</label>';
                // ply += '</div>';
                // ply += '</div>';
                ply += '</div>';
                ply += '</div>';
            }
            $(".player-list-data").append(ply);
        },
        error: function (error) {
            console.log(error);
        }
    });

    //------Coach List Ajax Code ------//

    $.ajax({
        type: 'get',
        url: 'api/get/coaches',
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
