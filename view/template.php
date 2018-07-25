
<!doctype html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acme</title>
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

<h1>Content Title Here</h1>
	  
  
    
  <footer>
     <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     Last Updated: <?php echo date('j F, Y', getlastmod()) ?>
             
        </footer>
     </main> 
    </body>

    
</html>

