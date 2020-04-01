<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Serif|Montserrat" rel="stylesheet">
	<link rel="stylesheet" href="results.css">
	</head>

	
	<body class="body" id ="searchresults">
 <?php
$connect = mysqli_connect("localhost:3306", "root", "password") or die ("Error , check your server connection.");
mysqli_select_db($connect,"recipe");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

	$search=$_POST['search'];
	$search = htmlspecialchars($search); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $search = mysqli_real_escape_string($connect,$search);
        // makes sure nobody uses SQL injection
         
        $result = mysqli_query($connect,"SELECT * FROM recipes
            WHERE (`ingredients` LIKE '%".$search."%') ") or die(mysqli_error($connect));
?>

				<form class = "search-form"action="searchresults.php" method="POST">
		      <input class = "search" type="text" placeholder="Search other ingredients...." name="search">
		      <button class = "search-btn" type="submit">Search</button>
				</form> 
		

	<!--main body-->
	<div class="main" id = "search-main">
	<h1>Showing results for '<?php echo $search?>'...</h1>
			
			
<?php
				 while($row = mysqli_fetch_array($result))
				{
				echo "<form action='recipeinfo.php' method='POST'>";
				echo "<div class='tile'>";
				 echo "<button type = 'submit' style ='border: none; background:none'>";
				echo "<input type = 'hidden' name= 'id' value='".$row['recipeID']."'>";
				echo "<img src='".$row['images']."' alt='Recipes' >";
				echo "<h1>" . $row['title'] . "</h1>";
				 echo "<p>" . $row['description'] . "</p>";
				echo "</button>";
				echo "</div>";
				echo "</form>";
				}
?>
		</form>
		</div>

	</div>
		
</body>
</html>