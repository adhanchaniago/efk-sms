  $('#stock-form').submit(function(){
      var nama_barang = $('#nama_barang').val();
      var qty_in = $('#qty_in').val(); 
      var qty_out = $('#qty_out').val(); 
       if(!nama_barang || nama_barang==''){
         $('#pesan').html('<div class="alert alert-danger text-center"><strong>Pilih Nama Barang</strong></div>');
         $('.chosen-select').focus().css('border-color', 'red');
      } else if(!qty_in && !qty_out){
         $('#pesan').html('<div class="alert alert-danger text-center">Silahkan isi <strong>In</strong> atau <strong>Out</strong></div>');
        
      } else {
        return true;
      }

      return false;
    });

  $(document).ready(function(){
    $('#min_in').prop('disabled', 'true');
    $('#min_out').prop('disabled', 'true');
  });


var clicks = 0; 
$("#plus_in").click(function(){ 
   var cek =  $('#qty_in').val();
  if(cek<99999){
    cek++; 
  $('#qty_in').val(cek);
  } else {

  }

  disabled_out(cek);
});

$("#min_in").click(function(){ 
  var cek =  $('#qty_in').val();
  if(cek>0){
    cek--; 
  $('#qty_in').val(cek);
  } else if(cek==0){
   
  $('#qty_in').val('');
  }

  disabled_out(cek);
});

  var clicks = 0; 
$("#plus_out").click(function(){ 
   var cek =  $('#qty_out').val();
  if(cek<99999){
    cek++; 
  $('#qty_out').val(cek);
  } else {

  }

  disabled_in(cek);
});

$("#min_out").click(function(){ 
  var cek =  $('#qty_out').val();
  if(cek>0){
    cek--; 
  $('#qty_out').val(cek);
  } else if(cek==0){
   
  $('#qty_out').val('');
  }

  disabled_in(cek);

});


  function disabled_out(cek){
    var stock = $('#stock').val();
    if(cek > 0 || cek!=''){
      $('#qty_out').prop('readonly', true);
      $('#qty_out').val('');
      $('#plus_out').prop('disabled', true);
      $('#min_out').prop('disabled', true);
      $('#min_in').prop('disabled', false);
    } else {
        $('#qty_in').val('');
      $('#qty_out').prop('readonly', false);
      $('#plus_out').prop('disabled', false);
      $('#min_out').prop('disabled', true);
      $('#min_in').prop('disabled', true);
    }

  }

  function disabled_in(cek){
    var stock = $('#stock').val();
    if(cek > 0 || cek!=''){
      $('#qty_in').prop('readonly', true);
      $('#qty_in').val('');
       $('#plus_in').prop('disabled', true);
      $('#min_in').prop('disabled', true);
       $('#min_out').prop('disabled', false);
    } else {
        $('#qty_out').val('');
      $('#qty_in').prop('readonly', false);
       $('#plus_in').prop('disabled', false);
      $('#min_in').prop('disabled', true);
      $('#min_out').prop('disabled', true);
    }

    if(cek == stock){
      $('#plus_out').prop('disabled', true);
    } else {
      $('#plus_out').prop('disabled', false);
    }
  }

  $("#qty_out").on("input", function() {
    var stock = $('#stock').val();

    //alert("Change to " + this.value);
    if(parseInt(this.value) == parseInt(stock)){
        $('#qty_in').prop('readonly', true);
      $('#qty_in').val('');
       $('#plus_in').prop('disabled', true);
      $('#min_in').prop('disabled', true);
       $('#min_out').prop('disabled', false);
       $('#plus_out').prop('disabled', true);
        return false;
    } else if(parseInt(this.value) > parseInt(stock)){
      $('#pesan').html('<div class="alert alert-danger text-center">Stock yang kamu <strong>Out</strong> lebih besar dari Stock yang tersedia</div>');
      $('#qty_out').focus();
      $('#qty_out').val('');

      return false
    } else  if(parseInt(this.value) > 0){
     
        $('#qty_in').prop('readonly', true);
      $('#qty_in').val('');
       $('#plus_in').prop('disabled', true);
      $('#min_in').prop('disabled', true);
       $('#min_out').prop('disabled', false);
      return false
    } else  if(parseInt(this.value) == 0 || parseInt(this.value) < 0){
     
        $('#qty_in').prop('readonly', false);
      $('#qty_out').val('');
       $('#plus_in').prop('disabled', false);
      $('#min_in').prop('disabled', true);
       $('#min_out').prop('disabled', true);
      return false
    } else {
      return true;
    }


});

 $("#qty_in").on("input", function() {
   
    if(parseInt(this.value) > 0){
     
        $('#qty_out').prop('readonly', true);
      $('#qty_out').val('');
       $('#plus_out').prop('disabled', true);
      $('#min_out').prop('disabled', true);
       $('#min_in').prop('disabled', false);
      return false
    } else  if(parseInt(this.value) == 0 || parseInt(this.value) < 0){
     
        $('#qty_out').prop('readonly', false);
      $('#qty_in').val('');
       $('#plus_out').prop('disabled', false);
      $('#min_out').prop('disabled', true);
       $('#min_in').prop('disabled', true);
      return false
    } else {
      return true;
    }


});

  /*$('.chosen').on('change', function() { //selected OR deselected
    //do something
    console.log(this.value);
  });*/

 /* $('.chosen-select').on('change', function() { //selected OR deselected
    //do something
   alert('yes');
  });*/

  

