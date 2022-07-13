$("#rejectform").validate({
  submitHandler: function(form) {
    rules: {
      useremail: {
        required: true
      }
    }
    
    $(form).submit();
  }
 });