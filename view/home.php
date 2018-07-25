<!doctype html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
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

 
<h1>Welcome To Acme!</h1>
<section id="welcome">
  <?php 
  
 if (isset($featuredDisplay)) {
 echo $featuredDisplay;
}
  
?>
</section>
<div class="featured">
   <div id="reviews">
      
      <!--<h2>Acme Rocket Reviews</h2>
         <ul>
            <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
            <li>"That thing was fast!" (4/5)</li>
            <li>"Talk about fast delivery." (5/5)</li>
            <li>"I didn't even have to pull the meat apart." (4.5/5)</li>
            <li>"I'm on my thirtieth one. I love these things!" (5/5)</li>
     </ul>-->
      </div>
</div>
   <section class="food">
      <div id="recipes">
         <h2>Featured Recipes</h2>
      <table>
         <tbody>
         
            <tr>
               
               <td><img src="/acme/images/recipes/bbqsand.jpg" alt="picture of BBQ sandwich"></td>
               <td><img src="/acme/images/recipes/potpie.jpg" alt="picture of Pot Pie"></td> 
            </tr>
            <tr>
               <td><a href="#">Pulled Roadrunner BBQ</a></td>
               <td><a href="#">Roadrunner Pot Pie</a></td>
            </tr>
            <tr>
               <td><img src="/acme/images/recipes/soup.jpg" alt="picture of Soup"></td>
               <td><img src="/acme/images/recipes/taco.jpg" alt="picture of Tacos"></td> 
            </tr>
            <tr>
               <td><a href="#">Roadrunner Soup</a></td>
               <td><a href="#">Roadrunner Tacos</a></td>
            </tr>
         </tbody>
      </table>
      </div>
   </section>
   
   <br>
  <footer>
     <?php include $_SERVER['DOCUMENT_ROOT'] . '/acme/common/footer.php'; ?>
     Last Updated: <?php echo date('j F, Y', getlastmod()) ?>
             
        </footer>
     </main>
    </body>

    
</html>

