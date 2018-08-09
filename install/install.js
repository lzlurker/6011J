	var http_request=false;
	function createXMLHttpRequest(){
		http_request=false;
		//初始化XMLHttpRequest对象
		if(window.XMLHttpRequest){//Mozilla浏览器
			http_request=new XMLHttpRequest();
			if(http_request.overrideMimeType){//设置Mime类别
				http_request.overrideMimeType("text/xml");
			}
		}
		else if (window.ActiveXObject)
		{//IE browser
			try
			{
				http_request=new ActiveXObject("MSXML2.XMLHTTP");
			}
			catch (e)
			{
				try
				{
					http_request=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e)
				{
					try
					{
						http_request=new ActiveXObject("MSXML3.XMLHTTP");
					}
					catch (e)
					{
						return http_request;
					}
				}
			}
		}
		if (!http_request)
		{//异常，创建对象失败
			window.alert("不能创建XMLHttpRequest对象实例");
			return false;
		}
	}

	function doSend(url){
			createXMLHttpRequest();
			http_request.onreadystatechange=requestContent;
			http_request.open("POST",url,true);
			http_request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			http_request.send("t="+x+"&dabasename="+escape(databaseName)+"&dataaddress="+databaseIP+"&datauser="+escape(databaseUser)+"&datapwd="+escape(databasePWD)+"&prefix="+escape(tablePrefix));
		}
		//处理返回的信息
	function requestContent(){
			if (http_request.readyState==4)
			{
				if (http_request.status==200){	
					txt=http_request.responseText;
					if (txt=="S"){
						document.getElementById("table"+x).innerHTML="<font color='green'>成功</font>";
						if (x>=t)
							document.getElementById("success").innerHTML="<p><input class='input1' type='image' src='images/next.gif' onclick='javascript:location.href=\"install_admin.php?dataaddress="+databaseIP+"&datauser="+escape(databaseUser)+"&dabasename="+escape(databaseName)+"&datapwd="+escape(databasePWD)+"&prefix="+escape(tablePrefix)+"\"' value='下一步'/></p>";
						if (x<t)
						{
							x++;
							setTimeout("act()",1000);
						}	
					}else
						document.getElementById("table"+x).innerHTML="<font color='red'>"+txt+"</font>";
				
				}else{
					document.getElementById("table"+x).innerHTML="<font color='red'>意外错误。</font>";
				}
				
			}else{
				document.getElementById("table"+x).innerHTML="<font color='red'>正在执行...</font>";
			}
		}
	function act(){	
			var u='install_ajax.php';
			doSend(u);
		}