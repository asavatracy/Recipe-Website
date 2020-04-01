

<!DOCTYPE html>
<html>
<head>
	<title>Recipe Information</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Serif|Montserrat" rel="stylesheet">
	<link rel="stylesheet" href="recipeinfodisplay.css">
</head>
<body class="body" id ="searchBody">
<button class="btn" onclick="myFunction()">Back To Home</button>
 <?php
$connect = mysqli_connect("localhost", "root", "password") or die ("Error , check your server connection.");
mysqli_select_db($connect,"recipe");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

	$id=$_POST['id'];
	$id = htmlspecialchars($id); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $id = mysqli_real_escape_string($connect,$id);
        // makes sure nobody uses SQL injection
         
        $result = mysqli_query($connect,"select * from recipes
            WHERE (`recipeID` ='$id')") or die(mysqli_error($connect));

		while($row = mysqli_fetch_array($result))
		{
		
		$title= $row['title'];
		$images = $row['images'];
		$description = $row['description'];
		$preparationtime = $row['preparationtime'];
		$difficulty = $row['difficulty'];
		$ingredients = $row['ingredients'];
		$steps = $row['steps'];
		}
			
?>
<?php
			$result2 = mysqli_query($connect,"select * from recipes
            WHERE (`ingredients` LIKE '%".$ingredients."%')") or die(mysqli_error($connect));

				while($row = mysqli_fetch_array($result2))
				{
				echo "<div class='row'>";
				echo "<div class='column'>";
				echo "<button type = 'submit' style ='border: none; background:none'>";
				echo "<h1>" . $row['title'] . "</h1>";
				echo "<img src='".$row['images']."' alt='Pasta' >";
				echo "</div>";
				
				echo "<div class='column'>";
				echo "<h2>" . "Description" . "</h2>";
				echo "<p>" . $row['description'] . "</p>";
				echo "<h2>" . "Preparation Time" . "</h2>";
				echo "<p>" . $row['preparationtime'] . "</p>";
				echo "<h2>" . "Difficulty" . "</h2>";
				echo "<p>" . $row['difficulty'] . "</p>";
				echo "<h2>" . "Ingredients" . "</h2>";
				echo "<p>" . $row['ingredients'] . "<p>";
				echo "<h2>" . "Steps" . "</h2>";
				echo "<p>" . $row['steps'] . "</p>";
				echo "</div>";
				echo "</div>";
				}
			?>
		</form>
	</div>
	</div>
</body>
<script>
function myFunction() {
  location.replace("newhomepage.html")
}
</script>
</html>
