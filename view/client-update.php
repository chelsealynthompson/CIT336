<!doctype html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Update</title>
    <meta name="author" content="Chelsea Thompson">
    <meta name="description" content="Acme Page">   
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">   
    <link href="/acme/css/main.css" rel="stylesheet">    
    <link href="/acme/css/medium.css" rel="stylesheet">  
    <link href="/acme/css/large.css" rel="stylesheet">
    </head>
<body>
    <main>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
        </header>
    <nav>
       <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/navigation.php'; ?>    
            </nav>

	<h1>Update Account</h1>
  <?php
    if (isset($message)) {
     echo "<div class='message'>$message</div>";
}
?>
<div>  
  <form  method="post" action="/acme/accounts/index.php">
            <fieldset>
              <legend>Use this form to update your name or email information</legend>
              <label>
                First Name: <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}elseif(isset($infoClient['clientFirstname'])) {echo "value='$infoClient[clientFirstname]'"; } ?>  required><br>
             </label>
              <label>
                Last Name: <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}elseif(isset($infoClient['clientLastname'])) {echo "value='$infoClient[clientLastname]'"; } ?>  required><br>
             </label>      
              <label>
                Email: <input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}elseif(isset($infoClient['clientEmail'])) {echo "value='$infoClient[clientEmail]'"; } ?>  required><br>
              </label>
            </fieldset>
            <div>
                <input type="submit" name="submit" value="Update Account">
                <input type="hidden" name="action" value="changeAccount">
                <input type="hidden" name="clientId" value="<?php if(isset($infoClient['clientId'])){ echo $infoClient['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">        

            </div>
  </form>

<br>

  <?php
    if (isset($messagePassword)) {
     echo "<div class='message'>$messagePassword</div>";
}
?>

  <form  method="post" action="/acme/accounts/index.php">
               <fieldset>
                 <legend>Use this form to change your password</legend>

           <label for="clientPassword">Password:
           <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></label><br>
           <span id="message">Passwords must be at least 8 characters, contain at least 1 number, 1 capital letter and 1 special character</span>
           </fieldset>  

               <div>
                   <input type="submit" name="submit" value="Change Password">
                   <input type="hidden" name="action" value="changePassword">
                   <input type="hidden" name="clientId" value="<?php if(isset($infoClient['clientId'])){ echo $infoClient['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">        

               </div>
     
  </form>
	</div>  

    
  <footer>
     <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     Last Updated: <?php echo date('j F, Y', getlastmod()) ?>
             
        </footer>
    </main>
    </body>

    
</html>

