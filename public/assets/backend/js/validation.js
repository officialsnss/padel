$.validator.addMethod("check_b", function( value, element, param ) {

  var val_a = $("#totalamount").val();

 return this.optional(element) || (parseFloat(value) <= parseFloat(val_a));
},"Your refund amount is greater than Amount Paid.");

 $("#refundform").validate({

  rules: {
    refund_amt: {
    required: true,
    number: true,
    check_b: true
    }

  },
  messages: {
    refund_amt: {
      required: "Please enter refund amount",
      number:"Please enter numeric value"
      }

  },

})

$("#rejectform").validate({

  rules: {
    messagebody: {
    required: true,
   }

  },
  messages: {
    messagebody: {
      required: "Please enter message",
      }

  },

})

// Vendor Form


jQuery.validator.addMethod("lettersonly", function(value, element)
{
return this.optional(element) || /^[a-z," "]+$/i.test(value);
}, "Please enter Letters only");


$("#vendorform").validate({

  rules: {
    club_rating: {
      required: true,
      number: true,
      max: 5
    },
    fullname: {
      required: true,
      lettersonly: true
    },
    full_name_arabic: {
      required: true,
      },
    phone: {
      digits: true
    },
    email: {
    required: true,
    email: true
    },
    clubname: {
    required: true,
    },
    name_arabic: {
      required: true,
      },
    password: {
    required: true,
    minlength: 8
    },
    password_confirmation: {
    required: true,
    equalTo: "#password"
    },
    commission: {
      required: true,
      number: true,
      max: 100
    },
    service_charge: {
      required: true,
      number: true,
    },
    single_price: {
      required: true,
      number: true,
    },
    start_time: {
      required: true,
      regex: "^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$"
   },
    end_time: {
     required: true,
     regex: "^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$",
     endtime:true,
  },
    double_price: {
      required: true,
      number: true,
    },
    indoor_courts: {
     required: true,
     number: true,
   },
    outdoor_courts: {
    required: true,
    number: true,
    },
    latitude:{
      required: true,
    },
    longitude:{
      required: true,
    },
    zipcode: {
      number: true,
    },
    featured_image: {
      extension: "jpg|jpeg|png"
    },

  },
  messages: {
    password_confirmation: {
      required: "Please enter same password",
      },
      featured_image: {
        extension: "Please upload file in these format only (jpg, jpeg, png)."
    }

  },

})

// Clubs

$("#club-edit").validate({
  ignore: [],
  rules: {
    club_rating: {
      required: true,
      number: true,
      max: 5
    },
    fullname:{
      required : function(element) {
        var action = $("#userrole").val();
        if(action != "5") {
            return true;
        } else {
            return false;
        }
    },
    lettersonly: function(element) {
      var action = $("#userrole").val();
      if(action != "5") {
          return true;
      } else {
          return false;
      }
  },
    },

    email:{
      required : function(element) {
        var action = $("#userrole").val();
        if(action != "5") {
            return true;
        } else {
            return false;
        }
    },
    email : function(element) {
      var action = $("#userrole").val();
      if(action != "5") {
          return true;
      } else {
          return false;
      }
  },
    },
    phone: {
      digits: function(element) {
        var action = $("#userrole").val();
        if(action != "5") {
            return true;
        } else {
            return false;
        }
    }
    },
    fullname: {
      required: true,
      lettersonly: true
      },
      full_name_arabic: {
        required: true,
        },
      phone: {
        digits: true
      },
      email: {
      required: true,
      email: true
      },
    commission:{
      required : function(element) {
        var action = $("#userrole").val();
        if(action != "5") {
            return true;
        } else {
            return false;
        }
    },
    number:function(element) {
      var action = $("#userrole").val();
      if(action != "5") {
          return true;
      } else {
          return false;
      }
    },
    },
    clubname: {
    required: true,
    },
    name_arabic: {
      required: true,
      },
    service_charge: {
      required: true,
      number: true,
    },
    single_price: {
      required: true,
      number: true,
    },
    double_price: {
      required: true,
      number: true,
    },
    indoor_courts: {
     required: true,
     number: true,
   },
    outdoor_courts: {
    required: true,
    number: true,
    },
    start_time: {
      required: true,
      regex: "^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$"
   },
    end_time: {
     required: true,
     regex: "^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$",
     endtime:true,
  },
    latitude:{
      required: true,
    },
    longitude:{
      required: true,
    },
    zipcode: {
      number: true,
    },
    featured_image: {
      extension: "jpg|jpeg|png"
    }

  },
  messages: {
    featured_image: {
        extension: "Please upload file in these format only (jpg, jpeg, png)."
    }
 },



})

// Time Slots

$.validator.addMethod("endtime", function(value, element, params){

  var startvalue = $('#start_time').val();

  var stt = new Date("November 13, 2013 " + startvalue);
stt = stt.getTime();

var endt = new Date("November 13, 2013 " + value);
endt = endt.getTime();

   return stt < endt;
}, 'End Time should be greater than Start Time.');

$.validator.addMethod(
  "regex",
  function(value, element, regexp) {
    var re = new RegExp(regexp);
    return this.optional(element) || re.test(value);
  },
  "Invalid Time format"
);

$("#time_save").validate({
  //ignore: [],
  rules: {
    'start_time[]': {
        required: true,
        regex: "^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$"
    },
    'end_time[]': {
       required: true,
       regex: "^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$",
       endtime:true,
    },

  },

})


$.validator.addMethod("endtimeupdate", function(value, element, params){

  var startvalue = $('#start').val();

var stt = new Date("November 13, 2013 " + startvalue);
stt = stt.getTime();

var endt = new Date("November 13, 2013 " + value);
endt = endt.getTime();

   return stt <= endt;
}, 'End Time should be greater than equal to Start Time.');

$("#time_update").validate({
  //ignore: [],
  rules: {
    'start_time': {
        required: true,
        regex: "^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$"
    },
    'end_time': {
       required: true,
       regex: "^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$",
       endtimeupdate:true

    },

  },




})
$(".bookforms").each(function() {
   var form = $(this);
form.validate({

  rules: {
    user_email: {
    required: true,
    email:true,
   }

  },


})
});

$(".bookforms").each(function() {
   var form = $(this);
form.validate({

  rules: {
    user_email: {
    required: true,
    email:true,
   }

  },


})
});


$("#batform").validate({
  //ignore: [],
  rules: {
    bat_name: {
        required: true,

    },
    name_arabic: {
      required: true,

  },
    featured_image: {
      required: function(element) {
        if ($(".thumb-image").attr('src') !== '') {
            return false;
        } else {
            return true;
        }
      },
      extension: "jpg|jpeg|png"

    },

  },

  messages: {
    featured_image: {
        extension: "Please upload file in these format only (jpg, jpeg, png)."
    }
  }


})


$("#vendorcreateform").validate({
  //ignore: [],
  rules: {
    bat_id: {
        required: true,

    },
    price: {
      required: true,
      number: true,
    },
    quantity: {
      required: true,
      number: true,
    },

  },

  messages: {
    bat_id: {
      required: "Please Select the bat."
    }
  }


})

$.validator.addMethod("balance", function( value, element, param ) {

  var val_a = $("#balamount").val();

 return this.optional(element) || (parseFloat(value) <= parseFloat(val_a));
},"Your amount is greater than wallet balance");

 $("#withdrawalform").validate({

  rules: {
    withdrawal_amt: {
    required: true,
    number: true,
    balance: true
    }

  },
  messages: {
    withdrawal_amt: {
      required: "Please enter amount",
      number:"Please enter numeric value"
      }

  },

})

//amenity validation
// Clubs

$("#amenity-form").validate({
  ignore: [],
  rules: {
    amenity: {
    required: true,
    },
    name_arabic: {
      required: true,
      },

    icon_image: {

        required: function(element) {
          if ($(".thumb-image").attr('src') !== '') {
              return false;
          } else {
              return true;
          }
      },
    // required: true,
      extension: "jpg|jpeg|png"
    }

  },
  messages: {

    icon_image: {
        extension: "Please upload file in these format only (jpg, jpeg, png)."
    }
 },

})

//Coupons Validation
$("#couponform").validate({
 // ignore: [],
  rules: {
    name: {
    required: true,
    },
    code: {
    required: true,
    },
    no_of_users_used: {
    required: true,
    number: true,
    },
    no_of_times: {
    required: true,
    number: true,
    },
    discount_type: {
    required: true,
    },
    amount: {
    required: true,
    number: true,

    },
    minimum_amount: {
    required: true,
    number: true,
    },
    status: {
    required: true,
    },

  },


})

//coaches

$("#coachform").validate({

  onkeyup: false ,
  rules: {
    coach_name: {
    required: true,
    },
    name_arabic: {
      required: true,
    },
    coach_email: {
      required: true,
      email: true,

    },
    price: {
      required: true,
      number: true,
    },
    'assign_club[]': {
      required: true,
      },
    experience: {
        required: true,
        number: true,
    },
    password: {
      required: true,
      minlength: 8
      },
    password_confirmation: {
      required: true,
      equalTo: "#password"
      },
    profile_img: {
      extension: "jpg|jpeg|png"
    }


  },
  messages: {
    profile_img: {
        extension: "Please upload file in these format only (jpg, jpeg, png)."
    }
 },

})

// Holidays

$("#holidaysform").validate({
  ignore: [],
  rules: {
    start_date: {
    required: false,
    },
    end_date: {
      required: false,

    },
    leave_type: {
        required: true,
    }

  },


})

// homeslider
$("#slideform").validate({


  rules: {
    slide_heading: {
    required: true,
    },

    button_label: {
      required: true,

    },

    button_label: {
        required: true,

    },
    button_val: {
      required: true,
      url: true

      },

    image: {
      required: function(element) {
        if ($(".thumb-image").attr('src') !== '') {
            return false;
        } else {
            return true;
        }
    },
    extension: "jpg|jpeg|png"

    }


  },
  messages: {
    image: {
        extension: "Please upload file in these format only (jpg, jpeg, png)."
    }
 },

})

// cms pages
$("#cms-pages").validate({

  ignore: [],
  rules: {
    title: {
    required: true,
    },

    title_arabic: {
      required: true,

    },
    content:{
      required: true,
    },
    content_arabic:{
      required: true,
    }


  },


})

//Regions Form
$("#regions-form").validate({
  //ignore: [],
  rules: {
    country_name: {
        required: true,

    },
    region: {
      required: true,
      lettersonly: true

    },
    arabic_region: {
      required: true,

    },


  },
})


//Regions Form
$("#cities-form").validate({
  //ignore: [],
  rules: {

    region_name: {
      required: true,

    },
    city: {
      required: true,
      lettersonly: true

    },
    arabic_city: {
      required: true,

    },


  },
})






