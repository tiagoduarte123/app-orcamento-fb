﻿<?php require_once('config.php'); ?><?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_config, $config);
$query_ativacaodigital = "SELECT * FROM servico WHERE idarea = 6 ORDER BY nome_servico ASC";
$ativacaodigital = mysql_query($query_ativacaodigital, $config) or die(mysql_error());
$row_ativacaodigital = mysql_fetch_assoc($ativacaodigital);
$totalRows_ativacaodigital = mysql_num_rows($ativacaodigital);

mysql_select_db($database_config, $config);
$query_marketingperformance = "SELECT * FROM servico WHERE idarea = 2 ORDER BY nome_servico ASC";
$marketingperformance = mysql_query($query_marketingperformance, $config) or die(mysql_error());
$row_marketingperformance = mysql_fetch_assoc($marketingperformance);
$totalRows_marketingperformance = mysql_num_rows($marketingperformance);

mysql_select_db($database_config, $config);
$query_relacional = "SELECT * FROM servico WHERE idarea = 3 ORDER BY nome_servico ASC";
$relacional = mysql_query($query_relacional, $config) or die(mysql_error());
$row_relacional = mysql_fetch_assoc($relacional);
$totalRows_relacional = mysql_num_rows($relacional);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!-- TemplateBeginEditable name="doctitle" -->
<title>Aplicação de Orçamento FB</title>

<style type="text/css">
<!--
.maindiv{ width:640px; margin:0 auto; padding:20px; background:#CCC;}
.innerbg{ padding:6px; background:#FFF;}
.result{ border:solid 1px #CCC; margin:10px 2px; padding:4px 2px;}
.title a{ font-weight:bold; color:#c24f00; text-decoration:none; font-size:14px;}
.discptn a{ text-decoration:none; color:#999;}
.link a{ color:#008000; text-decoration:none;}
-->
</style>
<script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js" ></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="js/Ajaxfile-upload.css" />
<script type="text/javascript" >
	$(function(){
		
		var btnUpload=$('#me');
		var mestatus=$('#mestatus');
		var files=$('#files');
		new AjaxUpload(btnUpload, {
			action: 'uploadPhoto.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif|pdf|doc|docx)$/.test(ext))){ 
				 
                    // extension is not allowed 
					mestatus.text('Formato não suportado.');
					return false;
				}
				mestatus.html('<img src="ajax-loader.gif" height="16" width="16">');
			},
			onComplete: function(file, response){
				//On completion clear the status
				mestatus.text('Concluído ! \n Existem ficheiros em anexo.');
				//On completion clear the status
				files.html('');
				//Add uploaded file to list
				var escolhido = 'http://site007.site88.net/images/webinfopedia_'+file;
					var junta = escolhido + "\n";
					
	 document.getElementById("uploads").value = junta;
					
				if(response=="success"){
					//ficheiro = ficheiro +1;
					
					
					$('<li></li>').appendTo('#files').html('<img src="images/webinfopedia_'+file+'" alt="" height="30" /><br />').addClass('success');
					alert('http://site007.site88.net/images/webinfopedia_'+file);
					
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
					
				}
			}
		});
		
	});
</script>

 <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
      $(function () {
		   var divs = document.getElementsByTagName("div");
            var textToTransfer = "";
            var pattern = new RegExp("test1");

           for(var i=0;i<divs.length;i++)
            {
            if(pattern.test(divs[i].className))
                {
                   textToTransfer += (divs[i].innerText || divs[i].textContent)+"|";
                }
             }
         document.getElementById("selecao").value = textToTransfer;
		
		var saldo = document.getElementById("amount").value;
		document.getElementById("dinheiro").value = saldo;
		
        $('#teste').on('submit', function (e) {
			 var divs = document.getElementsByTagName("div");
            var textToTransfer = "";
            var pattern = new RegExp("test1");

           for(var i=0;i<divs.length;i++)
            {
            if(pattern.test(divs[i].className))
                {
                   textToTransfer += (divs[i].innerText || divs[i].textContent)+"|";
                }
             }
         document.getElementById("selecao").value = textToTransfer;
		
		var saldo = document.getElementById("amount").value;
		document.getElementById("dinheiro").value = saldo;
          $.ajax({
            type: 'post',
            url: 'sendmail.php',
            data: $('#teste').serialize(),
            success: function () {
              scrollTo('#firstone');
            }
          });
          e.preventDefault();
        });
      });
    </script>

<script type='text/javascript' src='http://code.jquery.com/jquery-1.4.4.min.js'></script>

<link rel="stylesheet" href="js/style.css" type="text/css" media="screen">
<link rel="stylesheet" id="classic-css" href="js/jquery.lightbox.css" type="text/css" media="screen">

<script type="text/javascript" src="js/jquery.1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>	
<script type="text/javascript" src="js/modernizr.2.5.3.min.js"></script>	
<link rel="stylesheet" href="js/style.css" type="text/css" media="screen">

<script type="text/javascript" async src="js/ga.js"></script>
<script src="js/webfont.js" type="text/javascript" async></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/sga.js"></script>



<script type="text/javascript">
WebFontConfig = {
google: { families: [ 'Open+Sans::latin' ] }
};
(function() {
var wf = document.createElement('script');
wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
  '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
wf.type = 'text/javascript';
wf.async = 'true';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(wf, s);
})(); 
</script>

<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans&subset=latin">
<link rel="stylesheet" type="text/css" href="chrome-extension://lfjamigppmepikjlacjdpgjaiojdjhoj/css/menu.css">
<style type="text/css">
@import url("webfonts/asansreg/stylesheet.css");
@import url("webfonts/Amble_Regular/stylesheet.css");
@import url("webfonts/amble_regularr/stylesheet.css");
@import url("webfonts/HelveticaNeueLTPro_Lt/stylesheet.css");

#apDiv1 {
	position: absolute;
	left: 39px;
	top: 6538px;
	width: 290px;
	height: 56px;
	z-index: 2;
}
#apDiv2 {
	position: absolute;
	left: 386px;
	top: 677px;
	width: 2px;
	height: 430px;
	z-index: 2;
}
#apDiv3 {
	position: absolute;
	left: 35px;
	top: 943px;
	width: 334px;
	height: 2px;
	z-index: 3;
}
#apDiv4 {
	position: absolute;
	left: 625px;
	top: 2212px;
	width: 110px;
	height: 23px;
	z-index: 4;
}
#apDiv5 {
	position: absolute;
	left: 13px;
	top: 4474px;
	width: 637px;
	height: 160px;
	z-index: 6;
}
#apDiv6 {
	position: absolute;
	left: -30px;
	top: 3972px;
	width: 282px;
	height: 349px;
	z-index: 1;
}
#apDiv7 {
	position: absolute;
	left: 95px;
	top: 4096px;
	width: 300px;
	height: 210px;
	z-index: 9999;
	text-align: justify;
	font-family: "HelveticaNeueLTPro Lt";
	font-weight: normal;
	color: #FFF;
}
#apDiv8 {
	position: absolute;
	left: 628px;
	top: 4381px;
	width: 114px;
	height: 47px;
	z-index: 10000;
}
#page div #three .section-wrap center #form2 table tr td .ie7 font {
	font-family: Impact;
}
#page div #three .section-wrap center #form2 table tr td .ie7 font {
	color: #29abe1;
}
#page div #three .section-wrap center #form2 table tr td .ie7 font {
	font-size: 70px;
}
asreg {
	font-family: asansreg;
}
asreg {
	font-size: 18px;
}
#apDiv9 {
	position: absolute;
	left: -45px;
	top: 2888px;
	width: 332px;
	height: 518px;
	z-index: 10001;
}
#apDiv10 {
	position: absolute;
	left: 95px;
	top: 3006px;
	width: 317px;
	height: 218px;
	z-index: 10002;
	font-family: "HelveticaNeueLTPro Lt";
	text-align: justify;
}
#apDiv11 {
	position: absolute;
	left: 626px;
	top: 3276px;
	width: 115px;
	height: 47px;
	z-index: 10003;
}
#apDiv12 {
	position: absolute;
	left: -14px;
	top: 1846px;
	width: 264px;
	height: 313px;
	z-index: 1;
}
#apDiv13 {
	position: absolute;
	left: 69px;
	top: 1979px;
	width: 337px;
	height: 242px;
	z-index: 10004;
	font-family: "HelveticaNeueLTPro Lt";
	font-size: 21px;
	color: #FFF;
}
</style>

<!-- ******************* cod analytics ************************** -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38751192-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- ******************* FIM codigo analytics ************************** -->
<script name="Add and Remove Scroll Bars" type="text/javascript">
function noScrollIE() {
document.body.scroll = "no";
document.body.style.overflow = 'hidden';
scroll(0, 275);
}
function scrollIE() {
document.body.scroll = "yes";
document.body.style.overflow = 'scroll';
}
function noScrollNS() {
document.width = window.innerWidth;
document.height = window.innerHeight;
}
function scrollNS() {
document.width = 1000;
document.height = 1000;
}
</script>
<script name="Do the work" type="text/javascript">
function LockPage() {
if (browser = "Internet Explorer") {
noScrollIE();
}
else if (browser = "Netscape Navigator") {
noScrollNS();
}
}
function UnLockPage() {
if (browser = "Internet Explorer") {
scrollIE();
}
else if (browser = "Netscape Navigator") {
scrollNS();
}
}
</script>

<!-- import -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="specimen_files/easytabs.js" type="text/javascript" charset="utf-8"></script>
	
    <!-- slider -->
    
<script src="js/jquery-1.9.1.js"></script>

<link rel="stylesheet" href="/resources/demos/style.css" />
<style type="text/css">
#apDiv14 {
	position: absolute;
	left: 23px;
	top: 964px;
	width: 388px;
	height: 196px;
	z-index: 10005;
	font-size: 18pt;
	font-weight: normal;
}
#apDiv15 {
	position: absolute;
	left: 669px;
	top: 1095px;
	width: 117px;
	height: 53px;
	z-index: 10006;
}
#apDiv16 {
	position: absolute;
	left: 26px;
	top: 83px;
	width: 559px;
	height: 213px;
	z-index: 10007;
}
#apDiv17 {
	position: absolute;
	left: 300px;
	top: 372px;
	width: 345px;
	height: 157px;
	z-index: 10008;
}
#apDiv18 {
	position: absolute;
	left: 83px;
	top: 2836px;
	width: 615px;
	height: 137px;
	z-index: 10009;
}
#apDiv19 {
	position: absolute;
	left: 45px;
	top: 3898px;
	width: 747px;
	height: 164px;
	z-index: 10010;
}
#apDiv20 {
	position: absolute;
	left: 59px;
	top: 1805px;
	width: 811px;
	height: 147px;
	z-index: 10011;
}
</style>
<script>
$(function() {
$( "#slider-range" ).slider({
range: true,
min: 0,
max: 50000,
values: [ 2000, 20000 ],
slide: function( event, ui ) {
$( "#amount" ).val( ui.values[ 0 ] + " €"  + " - " + ui.values[ 1 ] + " €" );
}
});
$( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) +
" € - " + $( "#slider-range" ).slider( "values", 1 ) + " €" );
});
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>

    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>
    
 <style type="text/css">
     .demo
	{
	font-family: 'Conv_HelveticaNeueLTPro-Lt',Sans-Serif;
	font-size: 21px;		
	}
		#page div #three .section-wrap table tr td #opacidade {
	font-family: "HelveticaNeueLTPro Lt";
}
 #page div #three2 .section-wrap center table tr td table tr td {
	font-family: "HelveticaNeueLTPro Lt";
	color: #FFF;
}
 body,td,th {
	font-family: "HelveticaNeueLTPro Lt";
}
 #apDiv21 {
	position: absolute;
	left: 46px;
	top: 3856px;
	width: 459px;
	height: 13px;
	z-index: 10012;
}
 #apDiv22 {
	position: absolute;
	left: 83px;
	top: 2808px;
	width: 375px;
	height: 11px;
	z-index: 10013;
}
 #apDiv23 {
	position: absolute;
	left: 58px;
	top: 1753px;
	width: 387px;
	height: 12px;
	z-index: 10014;
}
 #apDiv24 {
	position: absolute;
	left: 68px;
	top: 601px;
	width: 385px;
	height: 12px;
	z-index: 10015;
}
 #apDiv25 {
	position: absolute;
	left: 23px;
	top: 17px;
	width: 430px;
	height: 10px;
	z-index: 10016;
}
 </style>
 
 <!-- script para ativaçao digital -->
  <SCRIPT LANGUAGE="JavaScript">
         function getSelected(opt) {
            var selected = new Array();
            var index = 0;
            for (var intLoop = 0; intLoop < opt.length; intLoop++) {
               if ((opt[intLoop].selected) ||
                   (opt[intLoop].checked)) {
                  index = selected.length;
                  selected[index] = new Object;
                  selected[index].value = opt[intLoop].value;
				  selected[index].id = opt[intLoop].id;
				  selected[index].name = opt[intLoop].name;
                  selected[index].index = intLoop;
               }
			   else {
		document.getElementById("total").innerHTML="";
			   }
            }
            return selected;
         }

         function outputSelected(opt) {
		
            var sel = getSelected(opt);
			
            var strSel = document.getElementById("total").innerHTML;
			
            for (var item in sel) {      
			strSel = strSel + '<div id="' + sel[item].id + '"class='+'"test1"'+'>' + sel[item].value + '<input type="checkbox" id="'+ sel[item].id +'1" class="css-checkbox" checked="checked" onclick="$(this).parent().remove();"/><label for="'+ sel[item].id +'1" name="checkbox9_lbl" class="css-label lite-x-cyan"></label></div>';//strSel + '<div id="' + '1">' + sel[item].value + '<input value="' + sel[item].value + '"' + 'type="checkbox" id="' + sel[item].id + '"' + 'class="css-checkbox" name="' + sel[item].name + '"' + 'onclick="' +  "$(this).parent().remove();" + '"' + ' checked><label for="' + sel[item].id + '"></label></div>';
			

		document.getElementById("total").innerHTML=strSel;
		}	       
	 
         }
		 
		  function getSelectedtwo(opt) {
            var selected = new Array();
            var index = 0;
            for (var intLoop = 0; intLoop < opt.length; intLoop++) {
               if ((opt[intLoop].selected) ||
                   (opt[intLoop].checked)) {
                  index = selected.length;
                  selected[index] = new Object;
                  selected[index].value = opt[intLoop].value;
				  selected[index].id = opt[intLoop].id;
				  selected[index].name = opt[intLoop].name;
                  selected[index].index = intLoop;
               }
			   else {
		//document.getElementById("total").innerHTML="";//tem que alterar
			   }
            }
            return selected;
         }

         function outputSelectedtwo(opt) {
			// var conteudo = document.getElementById("total").innerHTML;
            var sel = getSelectedtwo(opt);
			
            var strSel = document.getElementById("total").innerHTML.toString();
			
			
            for (var item in sel) {      
			strSel = strSel + '<div id="' + sel[item].id + '"class='+'"test1"'+'>' + sel[item].value + '<input type="checkbox" id="'+ sel[item].id +'1" class="css-checkbox" checked="checked" onclick="$(this).parent().remove();"/><label for="'+ sel[item].id +'1" name="checkbox9_lbl" class="css-label lite-x-cyan"></label></div>';//strSel + '<div id="' + '1">' + sel[item].value + '<input value="' + sel[item].value + '"' + 'type="checkbox" id="' + sel[item].id + '"' + 'class="css-checkbox" name="' + sel[item].name + '"' + 'onclick="' +  "$(this).parent().remove();" + '"' + ' checked><label for="' + sel[item].id + '"></label></div>';
			

		document.getElementById("total").innerHTML=strSel;
		}	       
	 
         }
		 
		   function getSelectedthree(opt) {
            var selected = new Array();
            var index = 0;
            for (var intLoop = 0; intLoop < opt.length; intLoop++) {
               if ((opt[intLoop].selected) ||
                   (opt[intLoop].checked)) {
                  index = selected.length;
                  selected[index] = new Object;
                  selected[index].value = opt[intLoop].value;
				  selected[index].id = opt[intLoop].id;
				  selected[index].name = opt[intLoop].name;
                  selected[index].index = intLoop;
               }
			   else {
		//document.getElementById("total").innerHTML="";//tem que alterar
			   }
            }
            return selected;
         }

         function outputSelectedthree(opt) {
			// var conteudo = document.getElementById("total").innerHTML;
            var sel = getSelectedthree(opt);
			
            var strSel = document.getElementById("total").innerHTML.toString();
			
			
            for (var item in sel) {      
			strSel = strSel + '<div id="' + sel[item].id + '"class='+'"test1"'+'>' + sel[item].value + '<input type="checkbox" id="'+ sel[item].id +'1" class="css-checkbox" checked="checked" onclick="$(this).parent().remove();"/><label for="'+ sel[item].id +'1" name="checkbox9_lbl" class="css-label lite-x-cyan"></label></div>';//strSel + '<div id="' + '1">' + sel[item].value + '<input value="' + sel[item].value + '"' + 'type="checkbox" id="' + sel[item].id + '"' + 'class="css-checkbox" name="' + sel[item].name + '"' + 'onclick="' +  "$(this).parent().remove();" + '"' + ' checked><label for="' + sel[item].id + '"></label></div>';
			

		document.getElementById("total").innerHTML=strSel;
		}	       
	 
         }
		 
		
		 
      </SCRIPT>

<script type='text/javascript' src='http://code.jquery.com/jquery-1.4.4.min.js'></script>
    
<script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/legendary.js"></script>
<script src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="js/jquery-ui.css" />
    <style type="text/css">
    #apDiv26 {
	position: absolute;
	left: 432px;
	top: 1014px;
	width: 249px;
	height: 54px;
	z-index: 10017;
}
    </style>
 <script language="javascript">
 
  function CopyDivsToTextArea()
        {
            var divs = document.getElementsByTagName("div");
            var textToTransfer = "";
            var pattern = new RegExp("test1");

           for(var i=0;i<divs.length;i++)
            {
            if(pattern.test(divs[i].className))
                {
                   textToTransfer += (divs[i].innerText || divs[i].textContent)+"|";
                }
             }
         document.getElementById("selecao").value = textToTransfer;
		
		var saldo = document.getElementById("amount").value;
		document.getElementById("dinheiro").value = saldo;
		
		teste.submit();
		}
		
		
		
		
    </script>


<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body onload="MM_preloadImages('images/icon/1_1.jpg','images/icon/2_2.jpg','images/icon/3_2.jpg')">
<div id="apDiv26"><div id="me" class="styleall" style=" cursor:pointer;"><span style="cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:9px; color:#000; margin-top:1px" >Adicionar um ficheiro como anexo</span></div>
      <span id="mestatus" style="cursor:pointer; font-family:Verdana, Geneva, sans-serif; font-size:9px; color:#fff; margin-top:-10px" ></span></div>
<div class="wrapper">
<div id="apDiv5"><img src="images/logo.png" id="primeiro" /></div>
<div id="apDiv6"><img src="images/number1.png" /></div>
<div id="apDiv7" class="demo" style="color:#FFF; font-size:18px; line-height:25px">Esta área de serviços refere-se a uma estratégia integrada que envolve os diversos canais essenciais ao marketing online (como search, online ads, video marketing, mobile marketing ou word of mouth marketing). Todos estes canais complementam-se tornando possível posicionar uma empresa no mundo digital.</div>
<div id="apDiv8">
 <a href="#secondstep"><input type="submit" id="gform_submit_button_4" class="button gform_button" value="&#8743     Próximo" tabindex="5" onclick="outputSelected(step1.ativacaodigital);" /></div> 
<div id="apDiv9"><img src="images/numero2.png" height="469" /></div>
<div id="apDiv10" class="demo" style="color:#FFF; font-size:18px; line-height:25px">Neste serviço assumimos todos os 
custos de investimento nos media online 
de forma a que os nossos clientes só 
paguem os resultados obtidos, como a 
geração de “leads” ou até mesmo de 
vendas. É possível a realização de 
anúncios segmentados fundamentais 
para o sucesso da campanha.<br />
A linha geral do Marketing de 
Performance consiste em investir em 
função de resultados.</div>
<div id="apDiv11"> 
<a href="#thirdstep"><input type="submit" id="gform_submit_button_4" class="button gform_button" value="&#8743     Próximo" tabindex="5" onclick="outputSelectedtwo(step2.marketingperformance);" /></a>
    <a href="#firststep"><input type="submit" id="gform_submit_button_4" class="button gform_button" value="&#8744     Anterior" tabindex="5" onclick="#firststep" /></a>
</div>
<div id="apDiv12"><img src="images/number3.png" /></div>
<div id="apDiv13" class="demo" style="color:#FFF; font-size:18px; line-height:25px " >
  Esta nova vertente do Marketing tem como intuito a retenção e respetiva intensiﬁcação da relação empresa-cliente. Pressupõe um alto contacto com o consumidor e tem como principal preocupação a qualidade de toda a organização numa perspetiva de longo prazo, considerando que um relacionamento se alicerça ao longo do tempo. 
</div>
<div id="apDiv14">
  <table width="100%" border="0">
    <tr>
      <td width="7%">&nbsp;</td>
      <td width="85%"><label for="amount"><font face="impact" color="#FFFFFF" size="22pt" style="font-family:impact; color:#FFF">ORÇAMENTO DISPONÍVEL</font></label></td>
      <td width="8%">&nbsp;</td>
    </tr>
  </table>
  <br />
  </p>
  <table width="327" border="0">
    <tr>
      <td width="16" height="38"></td>
      <td width="301"><div id="slider-range" align="right"></div></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><center>
        <table width="100%" border="0">
          <tr>
            <td width="35%">&nbsp;</td>
            <td width="56%"><input type="text" class="jquery-lightbox-overlay" id="amount" name="amount" style="border: 0; color: #FFF; font-weight: bold; font:impact; size:10pt" /></td>
            <td width="9%">&nbsp;</td>
          </tr>
        </table>
      </center></td>
    </tr>
  </table>
</div>
<div id="apDiv16" style="font-family:impact; font-size:50px; color:#FFF; text-align:left; text-shadow: 1px 0px 10px #000000;filter: dropshadow(color=#000000, offx=1, offy=0);">ESTÁ A UM PASSO DE ELEVAR O SEU NEGÓCIO!</div>
<div id="apDiv17"><div style="font-family:impact; color:#FFF; font-size:30px; text-shadow: 1px 0px 10px #000000;filter: dropshadow(color=#000000, offx=1, offy=0);">Siga-nos em</div>
  
  <a href="https://twitter.com/Legendaryptl" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image13','','images/icon/twitter_2.png',1)" target="_blank"><img src="images/icon/twitter_1.png" name="Image13" id="Image13"></a>
<a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image14','','images/icon/google_2.png',1)" target="_blank"><img id="Image14" src="images/icon/google_1.png"></a> 
<a href="http://www.linkedin.com/company/legendary-people-ideas" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','images/icon/linkedin_2.png',1)" target="_blank"><img src="images/icon/linkedin_1.png" name="Image15" id="Image15"></a> 



</div>
<div id="apDiv18"><img src="images/marketingperformance.png" /></div>
<div id="apDiv19"><img src="images/ativacaodigital.png" /></div>
<div id="apDiv20"><img src="images/marketingdigital.png" /></div>
<div id="apDiv21"><img  id="firststep" src="images/barra.png" /></div>
<div id="apDiv22"><img id="secondstep" src="images/barra.png" /></div>
<div id="apDiv23"><img id="thirdstep" src="images/barra.png" /></div>
<div id="apDiv24"><img id="fourstep" src="images/barra.png" /></div>
<div id="apDiv25"><img id="lastone" src="images/barra.png" /></div>
<div id="page">


<!-- imagem 5 -->

<div id="apDiv2" style="background-color:#29abe1"></div>
<div id="apDiv3" style="background-color:#29abe1"></div>
<div id="apDiv4">
  <div class="gform_footer top_label">
   <a href="#fourstep"> <input type="submit" id="gform_submit_button_4" class="button gform_button" value="&#8743     Próximo" tabindex="5" onclick="outputSelectedthree(step3.marketingrelacional);" /></a>
    <a href="#secondstep"><input type="submit" id="gform_submit_button_4" class="button gform_button" value="&#8744     Anterior" tabindex="5" onclick="#cima" /></a>
  </div>
</div>
<div style="background:#000; width:100%">


<!-- ******************* FIM MENU ************************** -->

<!-- ******************* PRIMEIRA IMAGEM ************************** -->

<div id="three" style="background-image:url(images/5.jpg); background-position:center; background-repeat:no-repeat; background-size:800px 600px;
">



<div class="section-wrap" >
  <p>
    <!-- ********************* esconder e abri div jquery ***************************** -->
    <script type="text/javascript">
    $(function(){
 
        $("#fadeout-block1")
            .click(function(){
                $("#block1")
                    .show()
                    .hide("slow");
            });
 
        $("#fadein-block2")
            .click(function(){
                $("#block2")
                    .hide()
                    .show("slow");
				
				$("#block3")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
            });
			
		 $("#fadein-block3")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
				
				 $("#block3")
                    .hide()
                    .show("slow");
            });
		
		$("#fadein-block4")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block3")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
				
				 $("#block4")
                    .hide()
                    .show("slow");
            });
		
		$("#fadein-block5")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block3")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				
				 $("#block5")
                    .hide()
                    .show("slow");

            });
    });
   </script>
    
    <style type="text/css">
    #block1, #block2, #block3 {
        line-height: 18px;
        padding: 10px 20px 10px 0px;
    }
 
    #block1 {
        background: green;
    }
 
    #block2{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:400px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	
	#block2 ul{
		margin:0;
		padding:0;
	}
	#block2 li{
		border-bottom:1px solid #0bdbe3;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-web-solucoes.jpg) no-repeat;
		margin-top:10px;
	}
	#block2 ul{
		margin:0;
		padding:0;
	}
	#block3{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:660px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block3 ul{
		margin:0;
		padding:0;
		margin-left:240px;
	}
	#block3 li{
		border-bottom:1px solid #aeff00;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-comunicacao.jpg) no-repeat;
		margin-top:10px;
	}
	
	#block4{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:940px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block4 ul{
		margin:0;
		padding:0;
		margin-left:485px;
	}
	#block4 li{
		border-bottom:1px solid #ed1b57;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-produtora.jpg) no-repeat;
		margin-top:10px;
	}
	
	#block5{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:940px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block5 ul{
		margin:0;
		padding:0;
		margin-left:720px;
	}
	#block5 li{
		border-bottom:1px solid #ff5a00;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-planejamento.jpg) no-repeat;
		margin-top:10px;
	}

   </style>
    <br />
    <br />
<br />
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
   <tr>
     <td height="84">&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="5%" height="273">&nbsp;</td>
     <td width="85%">
       <table width="100%" border="0">
         <tr>
           <td height="38"><div id="opacidade" style="color:#FFF; font-family:'HelveticaNeueLTPro Lt'; font-size:23px; padding-top:2px; padding-left:2px; padding-bottom:2px; padding-right:2px;" >


<CENTER style="color:#FFF;">Dentro de momentos receberá um email de confirmação.</CENTER>

</div> </td>
         </tr>
         <tr>
           <td height="2"></td>
         </tr>
       </table>
       

       <table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td width="3%" height="45">&nbsp;</td>
           <td width="82%"><table width="100%" border="0">
             <tr>
               <td>&nbsp;</td>
               <td><div id="opacidade" style="color:#FFF; font-family:'HelveticaNeueLTPro Lt'; font-size:23px; padding-top:2px; padding-left:2px; padding-bottom:2px; padding-right:2px;" >

Um muito obrigado por preferir os nossos serviços.

</div></td>
               <td>&nbsp;</td>
             </tr>
           </table></td>
           <td width="15%">&nbsp;</td>
          </tr>
        </table>
     </td>
     <td width="10%">&nbsp;</td>
   </tr>
   </table>
  <div id="clear"></div>

</div>

<!-- imagem 4 --><!-- fim imagem -->
				
<div class="picture-block"></div>
				
</div>

<!-- ******************* FIM PRIMEIRA IMAGEM ************************** -->


<!-- ******************************* PARTE  ********************************* -->			


  <!-- ******************* texto sobre a agência ************************** -->		
  


<div id="three">

<p>&nbsp;</p>
<form id="teste" action="" name="formxml" method="post">
<table width="1103" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="66">&nbsp;</td>
    <td width="360"> <h3>Serviços Selecionados</h3></td>
    <td width="677" align="right"><input name="nome" type="text" class="form" id="nome" placeholder="Nome" style="padding:10px; width:310px;" tabindex="1" value="" required /></td>
  </tr>
  <tr>
    <td rowspan="2" valign="top">&nbsp;</td>
    <td rowspan="2" valign="top">
    <style>
input[type=checkbox].css-checkbox {
	display:none;
}

input[type=checkbox].css-checkbox + label.css-label {
	padding-left:50px;
	height:15px; 
	display:inline-block;
	line-height:15px;
	background-repeat:no-repeat;
	background-position: 0 0;
	font-size:15px;
	vertical-align:middle;
	cursor:pointer;
}

input[type=checkbox].css-checkbox:checked + label.css-label {
	background-position: 0 -15px;
}


.lite-x-cyan{background-image:url(images/lite-x-cyan.png);}
	</style>
    
    <div id="total"></div>
    </td>
    <td align="right">
    
    <input type="text" pattern="\d+" name="telefone" id="telefone" value="" tabindex="1" style="padding:10px; width:310px;" placeholder="Telefone" class="form" required />      <br />      
    
    <input type="text" name="empresa" id="empresa" value="" tabindex="2" style="padding:10px; width:310px;" placeholder="Empresa" class="form" required /></td>
  </tr>
  <tr>
    <td align="right">
    <input name="email" id="email" type="email" title="email" tabindex="3" style="padding:10px; width:310px;" placeholder="E-mail" class="form" required/><input type="hidden" name="teste2" id= "teste2"><input type="hidden" name="dinheiro" id= "dinheiro"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td height="190" valign="top">&nbsp;</td>
    <td align="right"><textarea name="mensagem" cols="50" rows="10" class="github" id="mensagem" style="padding:10px; width:310px;" placeholder="Mensagem"  tabindex="4"></textarea><p align="right" style="margin-left:243px; margin-top:-15px;" >
    
   <input type="submit" value="Enviar"></p><textarea id="selecao" name="selecao" style="visibility:hidden" ></textarea>
   <textarea id="uploads" name="uploads" style="visibility:hidden" ></textarea>
    </td>
  </tr>
  
</table></form>
<!-- imagem 4 --><!-- fim imagem -->
				
<div class="picture-block"></div>
				
</div>

<!-- ******************* fim texto sobre a agência ************************** -->
<div class="picture-block"></div>
				
						
</div><!-- fim div two -->
	
<!-- ******************************* PARTE SERVIÇOS ********************************* -->
<!-- ******************************* PARTE PORTFOLIO ********************************* -->

<!-- ******************************* PARTE CONTATO ********************************* -->

<!-- outra imagem 4 -->

<div style="background:#000; width:100%">


<!-- ******************* FIM MENU ************************** -->

<!-- ******************* PRIMEIRA IMAGEM ************************** -->

<div id="two">
<a name="topo" id="topo" style="padding-top:30px; color:#000"></a>
<style>
div#two .picture-block {
	height: 456px;
	background-image: url(images/4.jpg);
	background-position:center bottom;
	border-bottom:0px solid #0bdbe3;
}
</style>
	
<div class="picture-block"></div>

</div>

<!-- ******************* FIM PRIMEIRA IMAGEM ************************** -->


<!-- ******************************* PARTE  ********************************* -->			


  <!-- ******************* texto sobre a agência ************************** -->		
  


<div id="three">


<div class="section-wrap">

<CENTER>
<form id="step3" name="step3" method="post" action="">
  <table width="95%" height="498" border="0" align="center">
    <tr>
      <td width="11%" align="right">&nbsp;</td>
      <td width="48%" height="196" align="right">&nbsp;</td>
      <td width="1%">&nbsp;</td>
      <td width="40%">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="296">&nbsp;</td>
      <td>&nbsp;</td>
      <td><font style="font-size:20px">selecione</font>
        <style>
	  label {
	display: inline;
}

.regular-checkbox {
	display: none;
}

.regular-checkbox + label {
	background-color: #fafafa;
	border: 1px solid #cacece;
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
	padding: 9px;
	border-radius: 3px;
	display: inline-block;
	position: relative;
}

.regular-checkbox + label:active, .regular-checkbox:checked + label:active {
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
}

.regular-checkbox:checked + label {
	background-color: #e9ecee;
	border: 1px solid #adb8c0;
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);
	color: #99a1a7;
}

.regular-checkbox:checked + label:after {
	content: '\2714';
	font-size: 14px;
	position: absolute;
	top: 0px;
	left: 3px;
	color: #99a1a7;
}


.big-checkbox + label {
	padding: 18px;
}

.big-checkbox:checked + label:after {
	font-size: 28px;
	left: 6px;
}


	      </style>
        <table width="100%" border="0">
        </table>
        <table width="100%" border="0">
          <?php do { ?>
  <tr>
   <td height="27" valign="middle" style="font-family:'HelveticaNeueLTPro Lt'; color:#FFF; font-size:20px"><?php echo $row_relacional['nome_servico']; ?></td>
    <td><input type="checkbox" id="<?php echo $row_relacional['idservico']; ?>" class="regular-checkbox" name="marketingrelacional" value="<?php echo $row_relacional['nome_servico']; ?>" />
      <label for="<?php echo $row_relacional['idservico']; ?>"></label></td>
  </tr>
  <?php } while ($row_relacional = mysql_fetch_assoc($relacional)); ?>
          </table></td>
    </tr>
  </table>
  </form>
</CENTER>
<div id="clear"></div>
<!-- ********************* esconder e abri div jquery ***************************** -->
<script type="text/javascript">
    $(function(){
 
        $("#fadeout-block1")
            .click(function(){
                $("#block1")
                    .show()
                    .hide("slow");
            });
 
        $("#fadein-block2")
            .click(function(){
                $("#block2")
                    .hide()
                    .show("slow");
				
				$("#block3")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
            });
			
		 $("#fadein-block3")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
				
				 $("#block3")
                    .hide()
                    .show("slow");
            });
		
		$("#fadein-block4")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block3")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
				
				 $("#block4")
                    .hide()
                    .show("slow");
            });
		
		$("#fadein-block5")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block3")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				
				 $("#block5")
                    .hide()
                    .show("slow");

            });
    });
</script>

<style type="text/css">
    #block1, #block2, #block3 {
        line-height: 18px;
        padding: 10px 20px 10px 0px;
    }
 
    #block1 {
        background: green;
    }
 
    #block2{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:400px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	
	#block2 ul{
		margin:0;
		padding:0;
	}
	#block2 li{
		border-bottom:1px solid #0bdbe3;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-web-solucoes.jpg) no-repeat;
		margin-top:10px;
	}
	#block2 ul{
		margin:0;
		padding:0;
	}
	#block3{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:660px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block3 ul{
		margin:0;
		padding:0;
		margin-left:240px;
	}
	#block3 li{
		border-bottom:1px solid #aeff00;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-comunicacao.jpg) no-repeat;
		margin-top:10px;
	}
	
	#block4{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:940px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block4 ul{
		margin:0;
		padding:0;
		margin-left:485px;
	}
	#block4 li{
		border-bottom:1px solid #ed1b57;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-produtora.jpg) no-repeat;
		margin-top:10px;
	}
	
	#block5{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;

		width:940px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block5 ul{
		margin:0;
		padding:0;
		margin-left:720px;
	}
	#block5 li{
		border-bottom:1px solid #ff5a00;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-planejamento.jpg) no-repeat;
		margin-top:10px;
	}

</style>

<!-- ********************* fim esconder e abri div jquery ***************************** -->



<!-- ******************************* FIM CÓDIGO FLIP ********************************* -->	
    
<div id="clear"></div>

</div>

<!-- imagem 4 --><!-- fim imagem -->
				
<div class="picture-block"></div>
				
</div>

<!-- ******************* fim texto sobre a agência ************************** -->
<div class="picture-block"></div>
				
						
</div><!-- fim div two -->
	
<!-- ******************************* PARTE SERVIÇOS ********************************* -->
<!-- ******************************* PARTE PORTFOLIO ********************************* -->

<!-- ******************************* PARTE CONTATO ********************************* -->

<!------------------------------------------->

<!-- outra imagem 4 -->

<div style="background:#000; width:100%">


<!-- ******************* FIM MENU ************************** -->

<!-- ******************* PRIMEIRA IMAGEM ************************** -->

<div id="four">
<a name="topo" id="topo" style="padding-top:30px; color:#000"></a>
<style>
div#four .picture-block {
	height: 456px;
	background-image: url(images/3.jpg);
	background-position:center bottom;
	border-bottom:0px solid #0bdbe3;
}
</style>
	
<div class="picture-block"></div>

</div>

<!-- ******************* FIM PRIMEIRA IMAGEM ************************** -->


<!-- ******************************* PARTE  ********************************* -->			


  <!-- ******************* texto sobre a agência ************************** -->		
  


  <div id="three2"> <a name="servicos" id="servicos2" style="padding-top:30px; color:#000">.</a>
    <div class="section-wrap">
      <center>
        <form id="step2" name="step2" method="post" action="">
        <table width="93%" border="0">
          <tr>
            <td width="49%" height="138" align="right">&nbsp;</td>
            <td width="28%">&nbsp;</td>
          </tr>
          <tr>
            <td height="292">&nbsp;</td>
            <td><font style="font-size:20px">selecione</font>
             
              <style>
	  label {
	display: inline;
}

.regular-checkbox {
	display: none;
}

.regular-checkbox + label {
	background-color: #fafafa;
	border: 1px solid #cacece;
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
	padding: 9px;
	border-radius: 3px;
	display: inline-block;
	position: relative;
}

.regular-checkbox + label:active, .regular-checkbox:checked + label:active {
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
}

.regular-checkbox:checked + label {
	background-color: #e9ecee;
	border: 1px solid #adb8c0;
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);
	color: #99a1a7;
}

.regular-checkbox:checked + label:after {
	content: '\2714';
	font-size: 14px;
	position: absolute;
	top: 0px;
	left: 3px;
	color: #99a1a7;
}


.big-checkbox + label {
	padding: 18px;
}

.big-checkbox:checked + label:after {
	font-size: 28px;
	left: 6px;
}


	      </style>
              <table width="100%" border="0">
                </table>
              <table width="100%" border="0">
                <?php do { ?>
                  <tr>
                    <td height="27" valign="middle" style="font-family:'HelveticaNeueLTPro Lt'; color:#FFF; font-size:20px"><?php echo $row_marketingperformance['nome_servico']; ?></td>
                    <td>
         <input type="checkbox" id="<?php echo $row_marketingperformance['idservico']; ?>" class="regular-checkbox" name="marketingperformance" value="<?php echo $row_marketingperformance['nome_servico']; ?>" /><label for="<?php echo $row_marketingperformance['idservico']; ?>"></label></td>
                    </tr>
                  <?php } while ($row_marketingperformance = mysql_fetch_assoc($marketingperformance)); ?>
              </table></td>
          </tr>
        </table>
        <br />
        </form>
      </center>
      <div id="clear2"></div>
      <!-- ********************* esconder e abri div jquery ***************************** -->
      <script type="text/javascript">
    $(function(){
 
        $("#fadeout-block1")
            .click(function(){
                $("#block1")
                    .show()
                    .hide("slow");
            });
 
        $("#fadein-block2")
            .click(function(){
                $("#block2")
                    .hide()
                    .show("slow");
				
				$("#block3")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
            });
			
		 $("#fadein-block3")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
				
				 $("#block3")
                    .hide()
                    .show("slow");
            });
		
		$("#fadein-block4")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block3")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
				
				 $("#block4")
                    .hide()
                    .show("slow");
            });
		
		$("#fadein-block5")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block3")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				
				 $("#block5")
                    .hide()
                    .show("slow");

            });
    });
      </script>
      <style type="text/css">
    #block1, #block2, #block3 {
        line-height: 18px;
        padding: 10px 20px 10px 0px;
    }
 
    #block1 {
        background: green;
    }
 
    #block2{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:400px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	
	#block2 ul{
		margin:0;
		padding:0;
	}
	#block2 li{
		border-bottom:1px solid #0bdbe3;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-web-solucoes.jpg) no-repeat;
		margin-top:10px;
	}
	#block2 ul{
		margin:0;
		padding:0;
	}
	#block3{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:660px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block3 ul{
		margin:0;
		padding:0;
		margin-left:240px;
	}
	#block3 li{
		border-bottom:1px solid #aeff00;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-comunicacao.jpg) no-repeat;
		margin-top:10px;
	}
	
	#block4{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:940px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block4 ul{
		margin:0;
		padding:0;
		margin-left:485px;
	}
	#block4 li{
		border-bottom:1px solid #ed1b57;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-produtora.jpg) no-repeat;
		margin-top:10px;
	}
	
	#block5{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:940px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block5 ul{
		margin:0;
		padding:0;
		margin-left:720px;
	}
	#block5 li{
		border-bottom:1px solid #ff5a00;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-planejamento.jpg) no-repeat;
		margin-top:10px;
	}

      </style>
      <!-- ********************* fim esconder e abri div jquery ***************************** -->
      <!-- ******************************* FIM CÓDIGO FLIP ********************************* -->
      <div id="clear2"></div>
    </div>
    <!-- imagem 4 -->
    <!-- fim imagem -->
    <div class="picture-block"></div>
  </div>
  <div id="five">
    <style>
div#five .picture-block {
	height: 456px;
	background-image: url(images/2.jpg);
	background-position:center bottom;
	border-bottom:0px solid #0bdbe3;
}
    </style>
    <div class="picture-block" style="background-color:#666"></div>
  </div>
  <div id="three">

<div class="section-wrap">
  <CENTER>
    <form id="step1" name="step1" method="post" action="">
    
    <table width="95%" height="409" border="0" align="left">
  <tr>
    <td width="50%" height="160" align="right">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="42%">&nbsp;</td>
    </tr>
  <tr>
    <td height="176">&nbsp;</td>
    <td>&nbsp;</td>
    <td><font style="font-size:20px">selecione</font><br />
      
       <style>
	  label {
	display: inline;
}

.regular-checkbox {
	display: none;
}

.regular-checkbox + label {
	background-color: #29abe1;
	border: 1px solid #cacece;
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
	padding: 9px;
	border-radius: 3px;
	display: inline-block;
	position: relative;
}

.regular-checkbox + label:active, .regular-checkbox:checked + label:active {
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
}

.regular-checkbox:checked + label {
	background-color: #29abe1;
	border: 1px solid #adb8c0;
	box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1);
	color: #99a1a7;
}

.regular-checkbox:checked + label:after {
	content: '\2714';
	font-size: 14px;
	position: absolute;
	top: 0px;
	left: 3px;
	color: #ffffff;
}


.big-checkbox + label {
	padding: 18px;
}

.big-checkbox:checked + label:after {
	font-size: 28px;
	left: 6px;
}


	  </style>
       <table width="100%" border="0">
      <?php do { ?>   <tr>
          <td height="27" valign="middle" style="font-family:'HelveticaNeueLTPro Lt'; color:#FFF; font-size:20px">
             
            <?php echo 
			$row_ativacaodigital['nome_servico']; ?></td>
          <td>
          <input value="<?php echo $row_ativacaodigital['nome_servico']; ?>" type="checkbox" id="<?php echo $row_ativacaodigital['idservico']; ?>" class="regular-checkbox" name="ativacaodigital" /><label for="<?php echo $row_ativacaodigital['idservico']; ?>"></label></td>
        </tr><?php } while ($row_ativacaodigital = mysql_fetch_assoc($ativacaodigital)); ?>
          </table>
      
     
       
      </td>
  </tr>
  </table>
    <br />
    <br />
    <br />
    <br />
      <br />
    <br />
    <br />
    <br />
<br />
   
    
    </form></CENTER>

<!-- ******************************* CÓDIGO FLIP ********************************* --

<!-- ********************* esconder e abri div jquery ***************************** -->
<script type="text/javascript">
    $(function(){
 
        $("#fadeout-block1")
            .click(function(){
                $("#block1")
                    .show()
                    .hide("slow");
            });
 
        $("#fadein-block2")
            .click(function(){
                $("#block2")
                    .hide()
                    .show("slow");
				
				$("#block3")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
            });
			
		 $("#fadein-block3")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
				
				 $("#block3")
                    .hide()
                    .show("slow");
            });
		
		$("#fadein-block4")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block3")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
				
				 $("#block4")
                    .hide()
                    .show("slow");
            });
		
		$("#fadein-block5")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block3")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				
				 $("#block5")
                    .hide()
                    .show("slow");

            });
    });
</script>

<style type="text/css">
    #block1, #block2, #block3 {
        line-height: 18px;
        padding: 10px 20px 10px 0px;
    }
 
    #block1 {
        background: green;
    }
 
    #block2{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:400px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	
	#block2 ul{
		margin:0;
		padding:0;
	}
	#block2 li{
		border-bottom:1px solid #0bdbe3;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-web-solucoes.jpg) no-repeat;
		margin-top:10px;
	}
	#block2 ul{
		margin:0;
		padding:0;
	}
	#block3{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:660px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block3 ul{
		margin:0;
		padding:0;
		margin-left:240px;
	}
	#block3 li{
		border-bottom:1px solid #aeff00;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-comunicacao.jpg) no-repeat;
		margin-top:10px;
	}
	
	#block4{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:940px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block4 ul{
		margin:0;
		padding:0;
		margin-left:485px;
	}
	#block4 li{
		border-bottom:1px solid #ed1b57;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-produtora.jpg) no-repeat;
		margin-top:10px;
	}
	
	#block5{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:940px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block5 ul{
		margin:0;
		padding:0;
		margin-left:720px;
	}
	#block5 li{
		border-bottom:1px solid #ff5a00;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-planejamento.jpg) no-repeat;
		margin-top:10px;
	}

</style>

<br />
<br />

<!-- ********************* fim esconder e abri div jquery ***************************** -->



<!-- ******************************* FIM CÓDIGO FLIP ********************************* -->	
    
<div id="clear">
  <p><br />
    <br />
  </p>
</div>

</div>

<!-- imagem 4 --><!-- fim imagem -->
				
<div class="picture-block"></div>
				
</div>

<!-- ******************* fim texto sobre a agência ************************** -->
<div class="picture-block"></div>
				
						
</div><!-- fim div two -->
	
<!-- ******************************* PARTE SERVIÇOS ********************************* -->
<!-- ******************************* PARTE PORTFOLIO ********************************* -->

<!-- ******************************* PARTE CONTATO ********************************* -->


<!------------------------------------------->

<!-- outra imagem 3 -->

<div style="background:#000; width:100%">


<!-- ******************* FIM MENU ************************** -->

<!-- ******************* PRIMEIRA IMAGEM ************************** --><!-- ******************* FIM PRIMEIRA IMAGEM ************************** -->


<!-- ******************************* PARTE  ********************************* -->			


  <!-- ******************* texto sobre a agência ************************** -->		
  


<div id="three" style="background-image:url(images/11.jpg); background-position:center; background-repeat:no-repeat; background-size:800px 600px;
">



<div class="section-wrap" >
  <p>
    <!-- ********************* esconder e abri div jquery ***************************** -->
    <script type="text/javascript">
    $(function(){
 
        $("#fadeout-block1")
            .click(function(){
                $("#block1")
                    .show()
                    .hide("slow");
            });
 
        $("#fadein-block2")
            .click(function(){
                $("#block2")
                    .hide()
                    .show("slow");
				
				$("#block3")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
            });
			
		 $("#fadein-block3")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
				
				 $("#block3")
                    .hide()
                    .show("slow");
            });
		
		$("#fadein-block4")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block3")
                    .hide("slow");
				$("#block5")
                    .hide("slow");
				
				 $("#block4")
                    .hide()
                    .show("slow");
            });
		
		$("#fadein-block5")
            .click(function(){
                $("#block2")
                    .hide("slow");
				$("#block3")
                    .hide("slow");
				$("#block4")
                    .hide("slow");
				
				 $("#block5")
                    .hide()
                    .show("slow");

            });
    });
   </script>
    
    <style type="text/css">
    #block1, #block2, #block3 {
        line-height: 18px;
        padding: 10px 20px 10px 0px;
    }
 
    #block1 {
        background: green;
    }
 
    #block2{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:400px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	
	#block2 ul{
		margin:0;
		padding:0;
	}
	#block2 li{
		border-bottom:1px solid #0bdbe3;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-web-solucoes.jpg) no-repeat;
		margin-top:10px;
	}
	#block2 ul{
		margin:0;
		padding:0;
	}
	#block3{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:660px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block3 ul{
		margin:0;
		padding:0;
		margin-left:240px;
	}
	#block3 li{
		border-bottom:1px solid #aeff00;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-comunicacao.jpg) no-repeat;
		margin-top:10px;
	}
	
	#block4{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:940px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block4 ul{
		margin:0;
		padding:0;
		margin-left:485px;
	}
	#block4 li{
		border-bottom:1px solid #ed1b57;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-produtora.jpg) no-repeat;
		margin-top:10px;
	}
	
	#block5{
        background: #000;
        display: none;
		border-radius: 10px 2px 10px 2px;
		width:940px;
		color:#ccc;
		font-size:20px;
		font-family: New_Cicle_Fina, Arial, Verdana, Helvetica, Sans-Serif;
	
    }
 	#block5 ul{
		margin:0;
		padding:0;
		margin-left:720px;
	}
	#block5 li{
		border-bottom:1px solid #ff5a00;
		padding:0px 0px 10px 33px;
		background:url(http://www.agenciacriativaimagem.com.br/img/icone-planejamento.jpg) no-repeat;
		margin-top:10px;
	}

   </style>
    <br />
    <br />
<br />
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
   <tr>
     <td height="41">&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td width="13%" height="301">&nbsp;</td>
     <td width="78%"><div id="opacidade" class="demo" style="padding-left:26px; padding-top:26px; padding-right:26px; color:#FFF; font-weight:25; font-size:21px" >
       
Com experiência e conhecimento de mercado, propomo-nos a ajudá-lo a ultrapassar os problemas da sua empresa, definindo e aplicando de forma personalizada a melhor estratégia e solução que potenciem a criação de novas oportunidades de negócio.<br />Nesta aplicação poderá selecionar os serviços que a sua empresa necessita, criando, em três passos, o seu próprio projeto que mais tarde será consultado pela nossa equipa e devidamente atendido.
       <table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td width="7%" height="45">&nbsp;</td>
           <td width="71%">&nbsp;</td>
           <td width="22%"><a href="#firststep"><input type="submit" id="gform_submit_button_2" class="button gform_button" value="Começar" tabindex="5" onclick="#firststep" /></a></td>
          </tr>
        </table></div>
      </div></td>
     <td width="9%">&nbsp;</td>
   </tr>
   </table>
  <div id="clear"></div>

</div>

<!-- imagem 4 --><!-- fim imagem -->
				
<div class="picture-block"></div>
				
</div>

<!-- ******************* fim texto sobre a agência ************************** -->
<div class="picture-block"></div>
				
						
</div><!-- fim div two -->

	
<!-- ******************************* PARTE SERVIÇOS ********************************* -->
<!-- ******************************* PARTE PORTFOLIO ********************************* -->

<!-- ******************************* PARTE CONTATO ********************************* -->
</div>


<script type="text/javascript" src="js/enhance.js"></script> 


</div>
</body>
</html>
<?php 
function verificastep1() {

if (isset($_POST['step1'])) {
	
	$optionArray = $_POST['step1'];
	
for ($i=0; $i<count($optionArray); $i++) {
        echo $optionArray[$i]."<br />";
    }


}

}

?>
<?php
mysql_free_result($ativacaodigital);

mysql_free_result($marketingperformance);

mysql_free_result($relacional);
?>
