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