<?php
require("db.php");

function parseToXML($htmlStr)
{
    $xmlStr = htmlspecialchars($htmlStr);
    return $xmlStr;
}

// Select all the rows in the markers table
$query = "SELECT * FROM markers";
$result = mysqli_query($conn, $query);
if (!$result) {
    die('Invalid query: ' . mysqli_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind = 0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)) {
    // Add to XML document node
    echo '<marker ' . "\n\n\n";
    echo 'id="' . $row['id'] . '" ' . "\n\n\n";
    echo 'name="' . parseToXML($row['name']) . '" ' . "\n\n\n";
    echo 'address="' . parseToXML($row['address']) . '" ' . "\n\n\n";
    echo 'lat="' . $row['lat'] . '" ' . "\n\n\n";
    echo 'lng="' . $row['lng'] . '" ' . "\n\n\n";
    echo 'type="' . parseToXML($row['type']) . '" ' . "\n\n\n";
    echo 'operating_hours="' . parseToXML($row['operating_hours']) . '" ' . "\n\n\n";
    echo 'image_url="' . parseToXML($row['image_url']) . '" ' . "\n\n\n";
    echo '/>' . "\n\n\n";
    $ind = $ind + 1;
}

// End XML file
echo '</markers>';
?>
