<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?= $title ;?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url();?>/template/assets/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=base_url();?>template/assets/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>template/assets/images/favicon-16x16.png">
<link rel="manifest" href="<?=base_url();?>template/assets/images/site.webmanifest">
<link rel="mask-icon" href="<?=base_url();?>template/assets/images/safari-pinned-tab.svg" color="#5bbad5">
<link rel="shortcut icon" href="<?=base_url();?>template/assets/images/favicon.ico">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-config" content="<?=base_url();?>template/assets/images/browserconfig.xml">
<meta name="theme-color" content="#ffffff">
  

    <meta name="description" content="Common form elements and layouts" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?=base_url('template/assets/css/bootstrap.min.css');?>" />
    <link rel="stylesheet" href="<?=base_url('template/assets/font-awesome/4.5.0/css/font-awesome.min.css');?>" />

    <!-- page specific plugin styles -->
   
   
    <link rel="stylesheet" href="<?=base_url('template/assets/css/bootstrap-datepicker3.min.css');?>" />
   
    <!-- text fonts -->
    <link rel="stylesheet" href="<?=base_url('template/assets/css/fonts.googleapis.com.css');?>" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?=base_url('template/assets/css/ace.min.css');?>" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="<?=base_url('template/assets/css/ace-part2.min.css');?>" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="<?=base_url('template/assets/css/ace-skins.min.css');?>" />
    <link rel="stylesheet" href="<?=base_url('template/assets/css/ace-rtl.min.css');?>" />
   

    
      <link rel="stylesheet" href="<?=base_url('template/assets/css/ace-ie.min.css');?>" />
    <link rel="stylesheet" href="<?=base_url('template/assets/swal/sweetalert.css');?>" />
    
    <!-- inline styles related to this page -->

    
    <script src="<?=base_url('template/assets/js/ace-extra.min.js');?>"></script>

    

    
    <script src="<?=base_url('template/assets/js/html5shiv.min.js');?>"></script>
    <script src="<?=base_url('template/assets/js/respond.min.js');?>"></script>
  
  <style>
  input {
    border-left: 2px solid #428BCA!important;
  }
  select  {
    border-left: 2px solid #428BCA!important;
  }
  textarea {
    border-left: 2px solid #428BCA!important;
  }
  .input-group-addon {
    border-left: 2px solid #428BCA!important;
  }
</style>
  
    
  </head>

  <body class="no-skin">
    
    
    <?php echo $_menu; //panggil view menu?> 
    


    
    
    <?php echo $_content; //panggil view konten (dinamis)?>
    
    

    <?php echo $_footer; //panggil view footer?>
    
          

        

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="<?=base_url('template/assets/js/jquery-2.1.4.min.js');?>"></script>

    <!-- <![endif]-->

    <!--[if IE]>
<script src="template/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='<?=base_url('template/assets/js/jquery.mobile.custom.min.js');?>'>"+"<"+"/script>");
    </script>
    <script src="<?=base_url('template/assets/js/bootstrap.min.js');?>"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
      <script src="<?=base_url('template/assets/js/excanvas.min.js');?>"></script>
    <![endif]-->
    
     <!-- <script src="<?=base_url('template/assets/js/jquery-ui.min.js');?>"></script> -->
    
   
    
    <script src="<?=base_url('template/assets/js/bootstrap-datepicker.min.js');?>"></script>
    <script src="<?=base_url('template/assets/js/autosize.min.js');?>"></script>
    <script src="<?=base_url('template/assets/js/select2.min.js');?>"></script>

    <!-- ace scripts -->
    <script src="<?=base_url('template/assets/js/ace-elements.min.js');?>"></script>
    <script src="<?=base_url('template/assets/js/ace.min.js');?>"></script>

    <script src="<?=base_url('template/assets/swal/sweetalert-dev.js');?>"></script>
    <script type="text/javascript">
      function Simbol(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  
    if ((charCode >= 0 && charCode < 32) || (charCode > 47 && charCode < 58) || (charCode > 64 && charCode < 91) 
      || (charCode > 96 && charCode < 123) || (charCode > 44 && charCode < 48)
      || (charCode > 38 && charCode < 42) || (charCode == 37 || charCode == 32 || charCode == 61 || charCode == 44 || charCode == 58)){
          return true;
    }else{
            return false;
    }
  
} 

/*$(document).ready(function(){
    $(document).keydown(function(event) {
        if (event.ctrlKey==true && (event.which == '118' || event.which == '86')) {
            alert('Maaf anda tidak bisa melakukan copy paste');
            event.preventDefault();
         }
    });
});
*/
/* $(function() {
            $(this).bind("contextmenu", function(e) {
                alert('Maaf anda tidak bisa melakukan klik kanan pada mouse');
                e.preventDefault();
            });
        }); */
    </script>
    
    <!-- ace scripts -->
  
   
    <!-- inline scripts related to this page -->
    <!-- inline scripts related to this page -->
  <script type="text/javascript">
      jQuery(function($) {
        $('#id-disable-check').on('click', function() {
          var inp = $('#form-input-readonly').get(0);
          if(inp.hasAttribute('disabled')) {
            inp.setAttribute('readonly' , 'true');
            inp.removeAttribute('disabled');
            inp.value="This text field is readonly!";
          }
          else {
            inp.setAttribute('disabled' , 'disabled');
            inp.removeAttribute('readonly');
            inp.value="This text field is disabled!";
          }
        });

        $('.select2').css('width','200px').select2({allowClear:true})
        .on('change', function(){
          $(this).closest('form').validate().element($(this));
        }); 

     

      
       /* $('#qty').editable({
              type: 'spinner',
          name : 'qty',
          spinner : {
            min : 16,
            max : 99,
            step: 1,
            on_sides: true
            //,nativeUI: true//if true and browser support input[type=number], native browser control will be used
          }
        });*/

      
      
        $('[data-rel=tooltip]').tooltip({container:'body'});
        $('[data-rel=popover]').popover({container:'body'});
      
        autosize($('textarea[class*=autosize]'));
        
        /*$('textarea.limited').inputlimiter({
          remText: '%n character%s remaining...',
          limitText: 'max allowed : %n.'
        });*/
      
        /*$.mask.definitions['~']='[+-]';
        $('.input-mask-date').mask('99/99/9999');
        $('.input-mask-phone').mask('(999) 999-9999');
        $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
        $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
      */
      
      
        /*$( "#input-size-slider" ).css('width','200px').slider({
          value:1,
          range: "min",
          min: 1,
          max: 8,
          step: 1,
          slide: function( event, ui ) {
            var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
            var val = parseInt(ui.value);
            $('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.'+sizing[val]);
          }
        });*/
      
        /*$( "#input-span-slider" ).slider({
          value:1,
          range: "min",
          min: 1,
          max: 12,
          step: 1,
          slide: function( event, ui ) {
            var val = parseInt(ui.value);
            $('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
          }
        });
      */
      
        
        //"jQuery UI Slider"
        //range slider tooltip example
      /*  $( "#slider-range" ).css('height','200px').slider({
          orientation: "vertical",
          range: true,
          min: 0,
          max: 100,
          values: [ 17, 67 ],
          slide: function( event, ui ) {
            var val = ui.values[$(ui.handle).index()-1] + "";
      
            if( !ui.handle.firstChild ) {
              $("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
              .prependTo(ui.handle);
            }
            $(ui.handle.firstChild).show().children().eq(1).text(val);
          }
        }).find('span.ui-slider-handle').on('blur', function(){
          $(this.firstChild).hide();
        });*/
        
     /*   
        $( "#slider-range-max" ).slider({
          range: "max",
          min: 1,
          max: 10,
          value: 2
        });
        */
      /*  $( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
          // read initial values from markup and remove that
          var value = parseInt( $( this ).text(), 10 );
          $( this ).empty().slider({
            value: value,
            range: "min",
            animate: true
            
          });
        });
        */
        //$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
      
        
        $('#id-input-file-1 , #id-input-file-2').ace_file_input({
          no_file:'No File ...',
          btn_choose:'Choose',
          btn_change:'Change',
          droppable:false,
          onchange:null,
          thumbnail:false //| true | large
          //whitelist:'gif|png|jpg|jpeg'
          //blacklist:'exe|php'
          //onchange:''
          //
        });
        //pre-show a file name, for example a previously selected file
        //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
      
      
        $('#id-input-file-3').ace_file_input({
          style: 'well',
          btn_choose: 'Drop files here or click to choose',
          btn_change: null,
          no_icon: 'ace-icon fa fa-cloud-upload',
          droppable: true,
          thumbnail: 'small'//large | fit
          //,icon_remove:null//set null, to hide remove/reset button
          /**,before_change:function(files, dropped) {
            //Check an example below
            //or examples/file-upload.html
            return true;
          }*/
          /**,before_remove : function() {
            return true;
          }*/
          ,
          preview_error : function(filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
          }
      
        }).on('change', function(){
          //console.log($(this).data('ace_input_files'));
          //console.log($(this).data('ace_input_method'));
        });
        
        
        //$('#id-input-file-3')
        //.ace_file_input('show_file_list', [
          //{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
          //{type: 'file', name: 'hello.txt'}
        //]);
      
        
        
      
        //dynamically change allowed formats by changing allowExt && allowMime function
        $('#id-file-format').removeAttr('checked').on('change', function() {
          var whitelist_ext, whitelist_mime;
          var btn_choose
          var no_icon
          if(this.checked) {
            btn_choose = "Drop images here or click to choose";
            no_icon = "ace-icon fa fa-picture-o";
      
            whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
            whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
          }
          else {
            btn_choose = "Drop files here or click to choose";
            no_icon = "ace-icon fa fa-cloud-upload";
            
            whitelist_ext = null;//all extensions are acceptable
            whitelist_mime = null;//all mimes are acceptable
          }
          var file_input = $('#id-input-file-3');
          file_input
          .ace_file_input('update_settings',
          {
            'btn_choose': btn_choose,
            'no_icon': no_icon,
            'allowExt': whitelist_ext,
            'allowMime': whitelist_mime
          })
          file_input.ace_file_input('reset_input');
          
          file_input
          .off('file.error.ace')
          .on('file.error.ace', function(e, info) {
            //console.log(info.file_count);//number of selected files
            //console.log(info.invalid_count);//number of invalid files
            //console.log(info.error_list);//a list of errors in the following format
            
            //info.error_count['ext']
            //info.error_count['mime']
            //info.error_count['size']
            
            //info.error_list['ext']  = [list of file names with invalid extension]
            //info.error_list['mime'] = [list of file names with invalid mimetype]
            //info.error_list['size'] = [list of file names with invalid size]
            
            
            /**
            if( !info.dropped ) {
              //perhapse reset file field if files have been selected, and there are invalid files among them
              //when files are dropped, only valid files will be added to our file array
              e.preventDefault();//it will rest input
            }
            */
            
            
            //if files have been selected (not dropped), you can choose to reset input
            //because browser keeps all selected files anyway and this cannot be changed
            //we can only reset file field to become empty again
            //on any case you still should check files with your server side script
            //because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
          });
          
          
          /**
          file_input
          .off('file.preview.ace')
          .on('file.preview.ace', function(e, info) {
            console.log(info.file.width);
            console.log(info.file.height);
            e.preventDefault();//to prevent preview
          });
          */
        
        });
      
        $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
        .closest('.ace-spinner')
        .on('changed.fu.spinbox', function(){
          //console.log($('#spinner1').val())
        }); 
        $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
        $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
        $('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
      
        //$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
        //or
        //$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
        //$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
      
      
        //datepicker plugin
        //link
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });
      
        //or change it into a date range picker
        //$('.input-daterange').datepicker({autoclose:true});
      
      
        //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
        /*$('input[name=date-range-picker]').daterangepicker({
          'applyClass' : 'btn-sm btn-success',
          'cancelClass' : 'btn-sm btn-default',
          locale: {
            applyLabel: 'Apply',
            cancelLabel: 'Cancel',
          }
        })
        .prev().on(ace.click_event, function(){
          $(this).next().focus();
        });*/
      
      
        /*$('#timepicker1').timepicker({
          minuteStep: 1,
          showSeconds: true,
          showMeridian: false,
          disableFocus: true,
          icons: {
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down'
          }
        }).on('focus', function() {
          $('#timepicker1').timepicker('showWidget');
        }).next().on(ace.click_event, function(){
          $(this).prev().focus();
        });
        */
        
      
        
       /* if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
         //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
         icons: {
          time: 'fa fa-clock-o',
          date: 'fa fa-calendar',
          up: 'fa fa-chevron-up',
          down: 'fa fa-chevron-down',
          previous: 'fa fa-chevron-left',
          next: 'fa fa-chevron-right',
          today: 'fa fa-arrows ',
          clear: 'fa fa-trash',
          close: 'fa fa-times'
         }
        }).next().on(ace.click_event, function(){
          $(this).prev().focus();
        });*/
        
      
        //$('#colorpicker1').colorpicker();
        //$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe
      
        //$('#simple-colorpicker-1').ace_colorpicker();
        //$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
        //$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
        //var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
        //picker.pick('red', true);//insert the color if it doesn't exist
      
      
        //$(".knob").knob();
        
        
        var tag_input = $('#form-field-tags');
        try{
          tag_input.tag(
            {
            placeholder:tag_input.attr('placeholder'),
            //enable typeahead by specifying the source array
            source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
            /**
            //or fetch data from database, fetch those that match "query"
            source: function(query, process) {
              $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
              .done(function(result_items){
              process(result_items);
              });
            }
            */
            }
          )
      
          //programmatically add/remove a tag
          var $tag_obj = $('#form-field-tags').data('tag');
          $tag_obj.add('Programmatically Added');
          
          var index = $tag_obj.inValues('some tag');
          $tag_obj.remove(index);
        }
        catch(e) {
          //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
          tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
          //autosize($('#form-field-tags'));
        }
        
        
        /////////
        $('#modal-form input[type=file]').ace_file_input({
          style:'well',
          btn_choose:'Drop files here or click to choose',
          btn_change:null,
          no_icon:'ace-icon fa fa-cloud-upload',
          droppable:true,
          thumbnail:'large'
        })
        
        //chosen plugin inside a modal will have a zero width because the select element is originally hidden
        //and its width cannot be determined.
        //so we set the width after modal is show
      
        /**
        //or you can activate the chosen plugin after modal is shown
        //this way select element becomes visible with dimensions and chosen works as expected
        $('#modal-form').on('shown', function () {
          $(this).find('.modal-chosen').chosen();
        })
        */
      
        
        
      /*  $(document).one('ajaxloadstart.page', function(e) {
          autosize.destroy('textarea[class*=autosize]')
          
          $('.limiterBox,.autosizejs').remove();
          $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
        });*/
      
      });
    </script>
   <?php if($url=='Admin/akses' OR $url=='admin/akses' OR $url=='Admin/kategori' OR $url=='admin/kategori' OR $url=='Admin/barang' OR $url=='admin/barang' OR $url=='Home/stock' OR $url=='home/stock')  { ?>
<script type="text/javascript" src="<?=base_url('template/assets/js/jszip.min.js');?>"></script>  
   
     <script src="<?=base_url('template/assets/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?=base_url('template/assets/js/jquery.dataTables.bootstrap.min.js');?>"></script>
   <script src="<?=base_url('template/assets/js/dataTables.buttons.min.js');?>"></script>
<script src="<?=base_url('template/assets/js/dataTables.select.min.js');?>"></script>
<script src="<?=base_url('template/assets/js/buttons.flash.min.js');?>"></script>
    <script src="<?=base_url('template/assets/js/buttons.html5.min.js');?>"></script>
    <script src="<?=base_url('template/assets/js/buttons.print.min.js');?>"></script>
    <script src="<?=base_url('template/assets/js/buttons.colVis.min.js');?>"></script>
     <script src="<?=base_url('template/assets/js/jquery.validate.min.js');?>"></script>
 <?php } ?>   

   
 <?php if($url=='Home/profile' OR $url=='home/profile'){ ?>
    
    <script type="text/javascript" src="<?=base_url('template/assets/js/isi_profil.js');?>"></script>
    <script type="text/javascript">
      $('#profil-form').submit(function(){
          var nama = $('#nama').val();
          var matches = nama.match(/admin/);
          var matches1 = nama.match(/Admin/);
          if(matches || matches1){
            $('#pesan').html('<div class="alert alert-danger text-center"><strong>Nama</strong> Tidak Boleh Mengandung Kata <strong>"Admin"</strong></div>');
            $('#nama').focus().css('border-color', '#D68273');
            //$('#error').closest('#nama').removeClass('has-success').addClass('has-error');
          } else {
            return true;
          }
          return false;
      });
    </script>
    <?php } elseif($url=='Admin/akses' OR $url1=='edit_akses') { ?>
    <script type="text/javascript" src="<?=base_url('template/assets/js/akses.js');?>"></script>
    
    <?php } elseif($url=='Admin/kategori' OR $url1=='edit_kategori') { ?>
    <script type="text/javascript" src="<?=base_url('template/assets/js/kategori.js');?>"></script>
     <?php } elseif($url=='Admin/barang' OR $url1=='edit_barang') { ?>

     

    <script type="text/javascript" src="<?=base_url('template/assets/js/barang.js');?>"></script>
     <?php } elseif($url=='Home/stock' OR $url1=='edit_stock') { ?>
      <script type="text/javascript" src="<?=base_url('template/assets/js/stock.js');?>"></script>
    <?php } ?>

    

                   <!-- <script type="text/javascript">
                       $(document).ready(function() {
     $('#btn-search').prop('disabled', true);
     $('#txt_noerpr').keyup(function() {
        if($(this).val().length > 8) {
           $('#btn-search').prop('disabled', false);
        } else {
          $('#btn-search').prop('disabled', true);
        }
     });
 });
                  </script> -->
  </body>
</html>
