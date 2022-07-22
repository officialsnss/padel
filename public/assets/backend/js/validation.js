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
    fullname: {
    required: true,
    lettersonly: true
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
    password: {
    required: true,
    minlength: 8
    },
    password_confirmation: {
    required: true,
    equalTo: "#password"
    },
    
  },
  messages: {
    password_confirmation: {
      required: "Please enter same password",
      }
  
  },
  
})

// Clubs
  
$("#club-edit").validate({
  ignore: [],
  rules: {
    clubname: {
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
 
  var j = $(element).closest('tr').attr('id');
  if(j){
    var startclass = "#start"+j;
  }
  else{
    var startclass = "#start";
  }
  var startvalue = $(startclass).val();

var stt = new Date("November 13, 2013 " + startvalue);
stt = stt.getTime();

var endt = new Date("November 13, 2013 " + value);
endt = endt.getTime();

   return stt <= endt;
}, 'End Time should be greater than equal to Start Time.');

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