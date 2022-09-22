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
            for(var i=0; i<data.data.length; i++){
                res += '<div class="swiper-slide">';
                res += '<div class="courts-div">';
                res +=  '<h4>Play Padel</h4>';
                res +=  '<div class="star-rating">';
                res +=      '<input type="radio" id="5-stars" name="rating" value="5" />';
                res +=       '<label for="5-stars" class="star">&#9733;</label>';
                res +=      '<input type="radio" id="4-stars" name="rating" value="4" />';
                res +=      '<label for="4-stars" class="star" style="color: #fc0;">&#9733;</label>';
                res +=      '<label for="4-stars" class="star" style="color: #fc0;">&#9733;</label>';
                res +=      '<input type="radio" id="3-stars" name="rating" value="3" />';
                res +=      '<label for="3-stars" class="star" style="color: #fc0;">&#9733;</label>';
                res +=      '<input type="radio" id="2-stars" name="rating" value="2" />';
                res +=     ' <label for="2-stars" class="star" style="color: #fc0;">&#9733;</label>';
                res +=     ' <input type="radio" id="1-star" name="rating" value="1" />';
                res +=      '<label for="1-star" class="star" style="color: #fc0;">&#9733;</label>';
                res +=  '</div>';
                res +=  '<div class="clearfix-space"></div>';
                res +=  '<div class="row">';
                res +=      '<div class="col-6 col-lg-6 col-md-6 col-sm-6">';
                res +=         ' <span><img src="http://retalkapp.com/tbaree/01/images/icons/wallet.png" class="img-fluid" alt=""> 30KD/hr</span>';
                res +=     ' </div>';
                res +=     ' <div class="col-6 col-lg-6 col-md-6 col-sm-6">';
                res +=         ' <span><img src="http://retalkapp.com/tbaree/01/images/icons/location-pin.png" class="img-fluid" alt=""> Salmiya, Kuwait</span>';
                res +=     ' </div>';
                res += ' </div>';
                res += ' <div class="clearfix-space"></div>';
                res +=  '<div class="row">';
                res +=      '<div class="col-2 col-lg-2 col-md-2 col-sm-2">';
                res +=          '<div class="court-icons">';
                res +=              '<img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-1.png" class="img-fluid" alt="">';
                res +=          '</div>';
                res +=      '</div>';
                res +=      '<div class="col-2 col-lg-2 col-md-2 col-sm-2">';
                res +=          '<div class="court-icons">';
                res +=              '<img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-2.png" class="img-fluid" alt="">';
                res +=          '</div>';
                res +=      '</div>';
                res +=      '<div class="col-2 col-lg-2 col-md-2 col-sm-2">';
                res +=          '<div class="court-icons">';
                res +=              '<img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-3.png" class="img-fluid" alt="">';
                res +=          '</div>';
                res +=      '</div>';
                res +=      '<div class="col-2 col-lg-2 col-md-2 col-sm-2">';
                res +=          '<div class="court-icons">';
                res +=              '<img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-4.png" class="img-fluid" alt="">';
                res +=          '</div>';
                res +=      '</div>';
                res +=      '<div class="col-2 col-lg-2 col-md-2 col-sm-2">';
                res +=          '<div class="court-icons">';
                res +=              '<img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-5.png" class="img-fluid" alt="">';
                res +=          '</div>';
                res +=      '</div>';
                res +=  '</div>';
                res +='</div>';
                res +='<img src="http://retalkapp.com/tbaree/01/images/court-img-1.webp" class="img-fluid" alt="">';
                res +='</div>';
                res +='<div class="know-more-arrow">';
                res +='<a href="javascript:void(0)"><img src="http://retalkapp.com/tbaree/01/images/arrow-next-icon.png" class="img-fluid" alt=""></a>';
                res +='</div>';
                res +='</div>';
            }
            alert(res);

            $(".res-data").append(res);

        },
        error: function (error) {
            console.log(error);
        }
    });

    //------Players List Ajax Code ------//

    $.ajax({
        type: 'get',
        url: 'api/popular/players',
        // data: formData.serialize(),
        success: function (playerslist) {
            console.log(playerslist);
        },
        error: function (playererror) {
            console.log(playererror);
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
