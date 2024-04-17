<?php
include 'functions/utility-functions.php';
$fileName = 'names-short-list.txt';

$lineNumber = 0;

// Load up the array
$FH = fopen("$fileName", "r");
$nextName = fgets($FH);

while(!feof($FH)) {
    if($lineNumber % 2 == 0) {
        $fullNames[] = trim(substr($nextName, 0, strpos($nextName, " --")));
    }

$lineNumber++;
$nextName = fgets($FH);
}

// $findMe = ',';
// echo $fullNames[0] . '<br>';
// echo strpos($fullNames[0], $findMe) . '<br>';
// echo substr($fullNames[0], 0, strpos($fullNames[0], $findMe));
// exit();

// Get all first names
foreach($fullNames as $fullName) {
    $startHere = strpos($fullName, ",") + 1;
    $firstNames[] = trim(substr($fullName, $startHere));
}

// Get all last names
 foreach ($fullNames as $fullName) {
     $stopHere = strpos($fullName, ",");
     $lastNames[] = substr($fullName, 0, $stopHere);
 }

// Get valid names
for($i = 0; $i < sizeof($fullNames); $i++) {
    // jam the first and last name together without a comma, then test for alpha-only characters
    if(ctype_alpha($lastNames[$i].$firstNames[$i])) {
        $validFirstNames[$i] = $firstNames[$i];
        $validLastNames[$i] = $lastNames[$i];
        $validFullNames[$i] = $validLastNames[$i] . ", " . $validFirstNames[$i];
    }
}

$commonLastNames = array_count_values($validLastNames);
$commonFirstNames = array_count_values($validFirstNames);


// ~~~~~~~~~~~~ Display results ~~~~~~~~~~~~ //

echo '<h1>Names - Results</h1>';

echo '<h2>All Names</h2>';
echo "<p>There are " . sizeof($fullNames) . " total names</p>";
echo '<ul style="list-style-type:none">';    
    foreach($fullNames as $fullName) {
        echo "<li>$fullName</li>";
    }
echo "</ul>";

echo '<h2>All Valid Names</h2>';
echo "<p>There are " . sizeof($validFullNames) . " valid names</p>";
echo '<ul style="list-style-type:none">';    
    foreach($validFullNames as $validFullName) {
        echo "<li>$validFullName</li>";
    }
echo "</ul>";

echo '<h2>Unique Names</h2>';
$uniqueValidNames = (array_unique($validFullNames));
echo ("<p>There are " . sizeof($uniqueValidNames) . " Unique names</p>");
echo '<ul style="list-style-type:none">';    
    foreach($uniqueValidNames as $uniqueValidName) {
        echo "<li>$uniqueValidName</li>";
    }
echo "</ul>";

echo '<h2>Unique Last Names</h2>';
$uniqueLastNames = (array_unique($validLastNames));
echo ("<p>There are " . sizeof($uniqueLastNames) . " Unique last names</p>");
echo '<ul style="list-style-type:none">';    
    foreach($uniqueLastNames as $uniqueLastName) {
        echo "<li>$uniqueLastName</li>";
    }
echo "</ul>";

echo '<h2>Unique First Names</h2>';
$uniqueFirstNames = (array_unique($validFirstNames));
echo ("<p>There are " . sizeof($uniqueFirstNames) . " Unique first names</p>");
echo '<ul style="list-style-type:none">';    
    foreach($uniqueFirstNames as $uniqueFirstName) {
        echo "<li>$uniqueFirstName</li>";
    }
echo "</ul>";

echo '<h2>Most Common Last Names</h2>';
echo '<ul style="list-style-type:none">';
    foreach($commonLastNames as $commonLastName => $count) {
      if($count > 1) {
        echo "<li>$commonLastName</li>";
        echo "<li>Occurrences: $count";
        echo "<br></br>";
      }
    }
echo "</ul>";

echo '<h2>Most Common First Names</h2>';
echo '<ul style="list-style-type:none">'; 
    foreach($commonFirstNames as $commonFirstName => $count) {
      if($count > 1) {
        echo "<li>$commonFirstName</li>";
        echo "<li>Occurrences: $count";
        echo "<br></br>";
      }
    }
echo "</ul>";

?>
