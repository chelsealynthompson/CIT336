<?php
if (!$_SESSION['loggedin']) {
    	header("Location: http://localhost/acme/" );
     }
     else{
$infoClient=($_SESSION['clientData']);
$clientInformation='<h1>'.$infoClient['clientFirstname'].' '.$infoClient['clientLastname'].'</h1>';

if (isset($message)) {
     	$clientInformation.= $message;
							}
		$clientInformation.='<h2>You are logged in!</h2>';
		$clientInformation.='<ul>';
 		$clientInformation.= '<li> First Name: '.$infoClient['clientFirstname'].'</li>';
 		$clientInformation.= '<li> Last Name: '.$infoClient['clientLastname'].'</li>';
 		$clientInformation.= '<li> Email: '.$infoClient['clientEmail'].'</li>';
        //$clientInformation.= '<li> User Level: '.$infoClient['clientLevel'].'</li>';
		$clientInformation.= '</ul>';
        $clientInformation.="<a href=\"/acme/accounts/index.php?action=changeAccount\">Update account information</a>";
if ((int)$infoClient['clientLevel']>=2) {
         $clientInformation.='<h1>Administrative Functions</h1>';
         $clientInformation.='<p>Use the link below to manage products</p>';
 		 $clientInformation.="<a href=\"/acme/products/index.php\">Product</a>";
 							}
     }
?>
<!doctype html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <meta name="author" content="Chelsea Thompson">
    <meta name="description" content="Acme Page">   
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">   
    <link href="/acme/css/main.css" rel="stylesheet">    
    <link href="/acme/css/medium.css" rel="stylesheet">  
    <link href="/acme/css/large.css" rel="stylesheet">
    </head>
<body>
    <main class="admin">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
        </header>
    <nav>
       <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/navigation.php'; ?>    
            </nav>
       
 <?php
    if (isset($message)) {
     echo "<div class='message'>$message</div>";
}
?>
         <?php
    if (isset($messagePassword)) {
     echo "<div class='message'>$messagePassword</div>";
}
?>
            <div>
               <?php 
            echo $clientInformation;
            ?>  
            </div>
       

       
  <footer>
     <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     Last Updated: <?php echo date('j F, Y', getlastmod()) ?>
             
        </footer>
     </main> 
    </body>

    
</html>

