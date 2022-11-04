$(document).ready(function () {
    // console.log(language);
    //------Fetch Header Token Ajax Code ------//
    var lang = $('#selectedLang').val();
    var MD5 = function(d){var r = M(V(Y(X(d),8*d.length)));return r.toLowerCase()};function M(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function X(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function V(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function Y(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}

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
    $('.clickloader').hide();

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
        $('.clickloader').show();
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
                    $('.clickloader').hide();
                    $('#sendcontactus').attr('disabled', 'disabled');
                    $('#success-text').html(data.message);
                    $('#success-class').show();
                    $("#first_name").val("");
                    $("#last_name").val("");
                    $("#email").val("");
                    $("#mobile").val("");
                    $("#message").val("");
                    setTimeout(function () {
                        $('#success-class').hide();
                    }, 10000);
                    window.location.href = 'contact_us';
                } else {
                    $this.button('reset');
                    $('.clickloader').hide();
                    $('#sendcontactus').removeAttr('disabled');
                    $('#error-text').html(data.message);
                    $('#error-class').show();
                }
            },
            error: function (data) {
                $this.button('reset');
                $('.clickloader').hide();
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
            // console.log(data);
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
                res += '<div class="line-c"><a data-id="' + data.data[i].id + '" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#court-details" id="court-more-details">More Details</a></div>';
                res += '</div>';
                res += '</div>';
                res += '</div>';
            }
            // alert(res);
            // console.log(res);

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

    $(document).on('click','#court-more-details', function () {
        var res = '';
        let dataId = $(this).data("id");
        $.ajax({
            type: 'get',
            url: 'api/get/clubDetails?club_id='+dataId,
            // data: formData.serialize(),
            // headers: {
            //     'Accept-Language' : language,
            // },
            success: function (data) {
                console.log(data.data.amenities.length);
                $('#court-details').show();
                res += '<div class="modal-header">';
                res += '<h3 class="modal-title m-0" id="exampleModalLabel">'+data.data.name+'</h3>';
                res += '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                res += '</div>';

                res += '<div class="modal-body">';

                res += '<div class="swiper mySwiper mb-4">';
                res += '<div class="swiper-wrapper">';
                for(var i=0;i<data.data.club_images.length;i++){
                res += '<div class="swiper-slide"><img src="http://127.0.0.1:8000/Images/'+data.data.club_images[i].image+'" alt="" class="img-fluid"></div>';
                }
                res += '</div>';
                res += '<div class="swiper-pagination"></div>';
                res += '<div class="swiper-button-next"></div>';
                res += '<div class="swiper-button-prev"></div>';
                res += '</div>';

                res += '<p>'+data.data.description+'</p>';

                res += '<h5>ADDRESS</h5>';
                res += '<div class="location-wrap-modal">';
                res += '<div class="row g-2 align-items-center">';
                res += '<div class="col-auto"><div class="modal-icon"><i class="bi bi-geo-alt-fill"></i></div></div>';
                res += '<div class="col">'+data.data.address+'</div>';
                res += '</div>';
                res += '</div>';

                res += '<div class="facilities-wrap-modal">';
                res += '<h5>FACILITIES</h5>';
                res += '<div class="row g-2">';
                for(var j=0;j<data.data.amenities.length;j++){
                res += '<div class="col-6 col-sm-6 col-md-4 col-lg-2">';
                res += '<div class="facilities-block-modal">';
                res += '<div class="line-a"><img src="http://127.0.0.1:8000/Images/'+data.data.amenities[j].image+'" alt="" class="img-fluid"></div>';
                res += '<div class="line-b">'+data.data.amenities[j].name+'</div>';
                res += '</div>';
                res += '</div>';
                }
                res += '</div>';
                res += '</div>';


                res += '<div class="services-wrap-modal">';
                res += '<h5>SERVICES</h5>';
                res += '<div class="row g-2">';
                if(data.data.isBat == true){
                res += '<div class="col-6 col-sm-6 col-md-4 col-lg-3">';
                res += '<div class="services-block-modal">';
                res += '<div class="line-a">Rackets</div>';
                res += '<div class="line-b">Available for Rent</div>';
                res += '</div>';
                res += '</div>';
                }
                res += '<div class="col-6 col-sm-6 col-md-4 col-lg-3">';
                res += '<div class="services-block-modal">';
                res += '<div class="line-a">Courts</div>';
                res += '<div class="line-b">'+data.data.courtsCount+' Courts</div>';
                res += '</div>';
                res += '</div>';
                res += '<div class="col-6 col-sm-6 col-md-4 col-lg-3">';
                res += '<div class="services-block-modal">';
                res += '<div class="line-a">Ratings</div>';
                res += '<div class="line-b"><i class="bi bi-star-fill"></i> '+data.data.rating+'</div>';
                res += '</div>';
                res += '</div>';
                res += '<div class="col-6 col-sm-6 col-md-4 col-lg-3">';
                res += '<div class="services-block-modal">';
                res += '<div class="line-a">Bookings</div>';
                res += '<div class="line-b">'+data.data.bookingsCount+'</div>';
                res += '</div>';
                res += '</div>';
                res += '</div>';
                res += '</div>';

                res += '</div>';

                res += '<div class="modal-footer">';
                res += '<div class="container-fluid">';
                res += '<div class="row justify-content-between g-4 align-items-center">';
                res += '<div class="col-auto"><h3 class="mb-0">'+data.data.price+' KWD / Hour</h3></div>';
                res += '<div class="col-auto"><a class="modal-button" href="/courts-book/'+dataId+'" role="button">BOOK NOW</a></div>';
                res += '</div>';
                res += '</div>';
                res += '</div>';

                $(".modal-content").html(res);
            },
            error: function (error) {
                // alert("Error");
                // console.log(error);
            }
        });
    });

});
