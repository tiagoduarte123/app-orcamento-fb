<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script src="js/jquery.min.js"></script>
<title>Sandbox</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<style type="text/css" media="screen">
body { background-color: #000; font: 16px Helvetica, Arial; color: #fff; }
</style>
</head>
<body>
  
  <div id="c_b">
   <input name="chkboxName" type="checkbox" value="one_name" checked>
   <input name="chkboxName" type="checkbox" value="one_name1" checked>
   <input name="chkboxName" type="checkbox" value="one_name2">
  </div>  
 <textarea readonly="readonly" id="t"></textarea>
 <div name="container" id="container" style="color:#FFF">

 </div>
 <input type="button" onclick="showSelectedValues();" value="" />

<!--<script>

    function showSelectedValues()
{
  alert($("input[name=chkboxName]:checked").map(
     function () {return this.value;}).get().join("/n"));
}

</script>-->



<script>

     function updateTextArea() {
         
		 var allVals = [];
		 
		 
         $('#c_b :checked').each(function() {
			 			 
          allVals.push($(this).val());
	
         });

         
		 $('#t').val(allVals);
		 
      }
	  
	  
	
	  
     $(function() {
       $('#c_b input').click(updateTextArea);
       updateTextArea();
     });

</script>

</body>
</html>

