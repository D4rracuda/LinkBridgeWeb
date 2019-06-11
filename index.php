<?php
	require 'include/parameters.php';
	require 'include/convertions.php';
	require 'include/database.php';
    $sessionId = generateSessionId();
?>
<html>
  <head>
    <title>LinkBridge</title>
	<meta charset="utf-8">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        
        .switch input { 
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        
        input:checked + .slider {
            background-color: #2196F3;
        }
        
        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }
        
        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
        
        .slider.round {
            border-radius: 34px;
        }
        
        .slider.round:before {
            border-radius: 50%;
        }
      </style>
    <script type="text/javascript">
        var scriptEnabled = true;
        var popWindowAllow;
        /*     
        document.addEventListener('DOMContentLoaded', function () {
             var checkbox = document.querySelector('input[type="checkbox"]');
             checkbox.addEventListener('change', function () {
                 if (checkbox.checked) {
                     scriptEnabled = true;
                 } else {
                     scriptEnabled = false;
                 }
              });
        });
        */
        
        c=window.open("http://htmlweb.ru/java/ann.jpg","ad78gptfn2u5cqgpah34151","width=20,height=20,top=0,left=-50,toolbar=0,location=0,menubar=0,status=1,directories=0,resizable=1")
        if(c){
            c.close(); // закрываю окно
            popWindowAllow = true;
            document.writeln("В вашем браузере разрешены всплывающие окна. Работает редирект в новой вкладке");
        }else{
            popWindowAllow = false;
            document.writeln("В вашем браузере запрещены всплывающие окна. Работает редирект внутри вкладки");
        }
        //document.writeln("Всплывающие окна = " + popWindowAllow);
   
		function navigate() {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if(this.responseText.substring(0,4)=="OK: "){
						var redirectionUrl = this.responseText.substring(4);
                         if(popWindowAllow){
                            //document.writeln("Начало редиректа...");
                            openInNewTab(redirectionUrl);
                            //document.writeln("Редирект...");
                        } else {
                            //document.writeln("Начало редиректа...");
                            document.location.href = redirectionUrl;
                            //document.writeln("Редирект...");
                        }
					} 	
				}
			};
			xhttp.open("GET", "navigate.php?sessionId=<?php echo $sessionId?>", true);
			<?php
				mysqli_query($dbConnection, $deletionQuery);
			?>
			xhttp.send();
		}
        
		function openInNewTab(redirectionUrl) {
            var win = window.open(redirectionUrl, '_blank');
            win.focus();
        }
        
		function polling(){
            if(scriptEnabled){
                navigate();
            }
            setTimeout(polling,3000);
		}
		
        function onCheckBoxChange(checkbox){
            if (checkbox.checked) {
                scriptEnabled = true;
            } else {
                scriptEnabled = false;
            }
        }
	</script>
  </head>
  <body>
    <DIV align="center">
            <h3>Приветствуем!</h3> <br />
            <h3>Сканируйте QR код снизу приложением LinkBridge</h3><br >
            <?php
            $width = $height = 300;
            $url   = urlencode("http://create.stephan-brumme.com");
            echo "<img src=\"http://chart.googleapis.com/chart?chs={$width}x{$height}&cht=qr&chl=$sessionId\" />";
            ?>
            <br />
            Ждать ссылку:   
            <br />
            <!-- Rounded switch -->
            <label class="switch">
                <input type="checkbox" checked onclick="onCheckBoxChange(this);">
                <span class="slider round"></span>
            </label>
            <br />
            <br />
            
            Session Identifier: 
            <?php echo $sessionId;?> 
            <br />
            <br />
            LinkBridge доступен для Android и iOS<br />
     </DIV>
	 <script>
		polling();
	 </script>
  </body>
</html>