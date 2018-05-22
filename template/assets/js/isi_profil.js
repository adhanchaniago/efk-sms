
  $('document').ready(function()
{ 
   $("#profil-form").validate({
        rules: {
           nama: {
                required: true,
                maxlength: 50,
                minlength: 3,
                number: false
            },
           
        },
        //For custom messages
        messages: {
           
            nama:{
                required: "Isi Nama Kamu",
                minlength: "Minimal 3 Karakter",
                 maxlength: "Maksimal 50 Karakter",
                 number: "Tidak boleh ada angka"
            },
           
           
           
        },
       
      errorPlacement : function(error, element) {
        $(element).closest('.form-group').find('.help-block').html(error.html());

       },
       highlight : function(element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        
       },
       unhighlight: function(element, errorClass, validClass) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).closest('.form-group').find('.help-block').html('');
        
       },
     
     });
     
     /* daftar submit */
});

   
    