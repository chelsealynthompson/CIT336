
<!doctype html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>registration</title>
    <meta name="author" content="Chelsea Thompson">
    <meta name="description" content="Acme Page">   
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">   
    <link href="/acme/css/main.css" rel="stylesheet">    
    <link href="/acme/css/medium.css" rel="stylesheet">  
    <link href="/acme/css/large.css" rel="stylesheet">
    </head>
<body>
    <main class="login">
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/header.php'; ?>
        </header>
    <nav>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/navigation.php'; ?>
            </nav>

 
 <div class="register">
        <h2>Acme Registration</h2>
    
        
        
        
       <?php
if (isset($message)) {
 echo "<div class='message'>$message</div>";
}
?>
<form method="post" action="/acme/accounts/index.php"> 
       
        
        
            
            <label><span>First Name: </span><br><input name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> type="text" placeholder="First Name" pattern="[a-zA-Z -._]{2,99}" required></label><br>
            <label><span>Last Name: </span><br><input name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> type="text" placeholder="Last Name" pattern="[a-zA-Z -._]{2,99}" required></label><br>
            <label><span>Email: </span><br><input name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> type="email" placeholder="email@example.com" required></label><br>
            <label><span>Password: </span><br>must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character<br><input name="clientPassword" id="clientPassword" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required></label><br>
        
        <input type="submit" name="submit" value="Register" class="registerbtn">
        <!-- Add the action name - value pair -->
         <input type="hidden" name="action" value="register">
        
        
        
    
    
    
    </form>    
  </div>
  
   <br>
  <footer>
     <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     Last Updated: <?php echo date('j F, Y', getlastmod()) ?>
             
        </footer>
     </main> 
    </body>

    
</html>
