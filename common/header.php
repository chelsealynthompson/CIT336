
 <img src="/acme/images/site/logo.gif" alt="The site name" width="200" height="125">


 <div class="accountinfo">
		<?php 	
			$logout=0;
			$welcome="";
			if(isset($_SESSION['loggedin'])){
               $clientFirstname = $_SESSION['clientData']['clientFirstname'];
				if ($_SESSION['loggedin']) {
					$logout=1;
					
                    
				}
			}
            
			if(isset($_SESSION['loggedin'])){
				if($logout){
  					$welcome="<a href=\"/acme/accounts/index.php/?action=welcomenamelink\"><span class='welcome'>Welcome $clientFirstname</span></a>";
					echo "$welcome";
                    $logout="<a href=\"/acme/accounts/index.php/?action=Logout\"><span class=\"logout\">Logout</span></a>";
			  		echo "$logout";
			    	
				}
				
			 }
             else
			 	{
					echo "
						<a href=\"/acme/accounts/?action=login\">
						<img class=\"myaccount\" src=\"/acme/images/site/account.gif\" alt=\"folder\"> 
						<h3>My Account</h3></a>";
			}
		?> 

	</div>