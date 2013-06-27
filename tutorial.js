$(function() {
  $(".last").click(function() {
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
      type: "POST",
      url: "bin/process.php",
      data: dataString,
      success: function() {
  scrollTo('#firstone');
     
      }
     });
    return false;
	});
});
runOnLoad(function(){
  $("input#name").select().focus();
});
