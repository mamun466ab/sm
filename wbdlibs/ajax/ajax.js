function ajaxGET(div,url){
	var xmlhttp;
	if (window.XMLHttpRequest){		
	  xmlhttp=new XMLHttpRequest();// code for IE7+, Firefox, Chrome, Opera, Safari
	}else{
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// code for IE6, IE5
	}	
	xmlhttp.onreadystatechange=function(){
	  if(xmlhttp.readyState==4 && xmlhttp.status==200){
		document.getElementById(div).innerHTML=xmlhttp.responseText;
	  }else{
		  document.getElementById(div).innerHTML="<span style='color:blue;'>Wait...</span>"; 
		  //document.getElementById(div).innerHTML="<img src='./images/loader/3.gif' />"; 
	  }
	}
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}

//-----------------------------------------------//
function ajaxPOST(div,url,data){
	var xmlhttp;
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function(){
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById(div).innerHTML=xmlhttp.responseText;
		}else{
		  document.getElementById(div).innerHTML="Loading..."; 
	  }
	}
	
	
	
	   xmlhttp.open("POST",url,true);
	   xmlhttp.send(data);
	   
	

}



