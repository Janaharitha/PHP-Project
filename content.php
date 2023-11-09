<?php
include 'db.php';

if (isset($_GET['city_id'])) {
    $city_id = $_GET['city_id'];
    $sql = "SELECT c.*, s.STATE_NAME FROM cities c
        JOIN states s ON c.ID_STATE = s.ID
        WHERE c.ID = $city_id";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $author_id = $row['Author_ID'];

        // Get author details
        $author_sql = "SELECT * FROM author WHERE Author_ID = $author_id";
        $author_result = mysqli_query($conn, $author_sql);
        $author_row = mysqli_fetch_assoc($author_result);

        // Generate the h1 tag
        $h1_tag = "Rent Assistance in {$row['CITY']}, {$row['STATE_NAME']}";

        echo "<h1>$h1_tag</h1>";
        echo "<p>{$row['CITY_DESC']}</p>";

        // Display questions and answers
        echo "<h2>FAQs</h2>";
        echo "<ul>";
        for ($i = 1; $i <= 5; $i++) {
            $question = $row["Question_$i"];
            $answer = $row["Answer_$i"];
            if (!empty($question) && !empty($answer)) {
                echo "<li><strong>Q{$i}:</strong> $question<br><strong>A{$i}:</strong> $answer</li>";
            }
        }
        echo "</ul>";

        echo "<p>Author: {$author_row['Author_Name']}</p>";
        echo "<p>Author Bio: {$author_row['Author_Bio']}</p>";
    } else {
        echo "City not found.";
    }
} else {
    echo "City ID not provided.";
}

mysqli_close($conn);
?>
