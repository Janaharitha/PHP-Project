<?php
include 'db.php';

$sql = "SELECT * FROM states";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li><a href='city.php?state_id={$row['ID']}'>{$row['STATE_NAME']}</a>: {$row['STATE_DESC']}</li>";
    }
    echo "</ul>";
} else {
    echo "No states found.";
}

mysqli_close($conn);
?>
