<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
if (isset($_SESSION['featuredMessage'])) {
 $featuredMessage = $_SESSION['featuredMessage'];
}
?><!doctype html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Management</title>
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
 
<h1>Product Management</h1>
<h2>Welcome to the product management page. Please choose an option below:</h2>
<ul>
   <li><a href="/acme/products/index.php?action=newCat">Add a New Category</a></li>
   <li><a href="/acme/products/index.php?action=newProd">Add a New Product</a></li>
</ul>
<?php
if (isset($message)) {
echo "<div class='message'>$message</div>";
}if (isset($featuredMessage)) {
echo "<div class='message'>$featuredMessage</div>";
} if (isset($prodList)) {
 echo $prodList;
}
?>	  
   
    
  <footer>
     <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     Last Updated: <?php echo date('j F, Y', getlastmod()) ?>
             
        </footer>
     </main> 
    </body>

    
</html>
<?php unset($_SESSION['message']); ?>