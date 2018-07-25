<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /acme/');
 exit;
}
?><!doctype html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Category</title>
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
 
<h1>Add Category</h1>
<?php
    if (isset($_POST{'submit'})) {
     echo "<div class='message'>$message</div>";
}
?>

<h2>Add a new category of products below</h2>


<form action="/acme/products/index.php" method="post" id="addCategory">
        
               
                  
   <label><span>New Category Name </span><br><input name="categoryName" id="categoryName" type="text" value="" pattern="[a-zA-Z0-9]{3,99}" required=""></label><br><br>
                    
                    
       <input type="submit" name="submit" id="addcatbtn" value="Add Category">
        <input type="hidden" name="action" value="newCat">  
        
        
        
    </form>    
	  
  
    
  <footer>
     <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     Last Updated: <?php echo date('j F, Y', getlastmod()) ?>
             
        </footer>
     </main>
    </body>

    
</html>

