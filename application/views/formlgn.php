<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="author" content="W-Mantap">
	<!--[if lt IE 9]>
	<script src="assets/dist/html5shiv.js"></script>
	<![endif]-->
	<!--[if lte IE 8]><script src="assets/js/selectivizr.js"></script><![endif] 

	
	-->
<title></title>
<body onload="document.forms['eaform2'].submit()">
<?php
$distinguished=$this->session->userdata('dn');
//$nik=$this->session->userdata('nik');
$nik = $this->uri->segment(3);
$periodeuri = $this->uri->segment(4);
$password=$this->session->userdata('password');
?>
<form action="<?=base_url('login/Cek_logincnuser');?>" name="eaform2" method="POST">
<!--<input type="text" class="form-control" name="user" value="<?=$user;?>" style="border-top:0px;border-bottom:0px;border-left:0px;border-right:0px;color:black;0028920704 0223480510 0100840407 0413911116 0422630717 0426020917 ">-->

<input type="hidden" class="form-control" name="dn" value="<?=$distinguished;?>">

<input type="hidden" class="form-control" name="usr" value="<?=$nik;?>">
<input type="hidden" class="form-control" name="passwd" value="<?=$password;?>">



</form>
</body>
</head>
</html>