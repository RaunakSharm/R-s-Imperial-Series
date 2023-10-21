<?php
// get the search term from the user input
$term = $_POST["term"];

// connect to the database
$con = mysqli_connect("localhost", "root", "", "db_test");
if (!$con) {
  die("Could not connect: " . mysqli_error($con));
}

// escape the term to prevent SQL injection
$term = mysqli_real_escape_string($con, $term);

// query the database for matching records
$sql = "SELECT * FROM Liam WHERE Description LIKE '%$term%'";
$result = mysqli_query($con, $sql);

// check if any records are found
if (mysqli_num_rows($result) > 0) {
  // loop through the records and display them
  while ($row = mysqli_fetch_assoc($result)) {
    echo "Code: " . $row["Code"] . "<br>";
    echo "Description: " . $row["Description"] . "<br>";
    echo "Category: " . $row["Category"] . "<br>";
    echo "Cut Size: " . $row["CutSize"] . "<br>";
    echo "<hr>";
  }
} else {
  // no records are found, display a message
  echo "No results found for '$term'";
}

// close the database connection
mysqli_close($con);
?>
