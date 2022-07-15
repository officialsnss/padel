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