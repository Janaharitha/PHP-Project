<?php
include("db.php");

if (isset($_GET['state_id'])) {
    $state_id = $_GET['state_id'];
    $query = "SELECT * FROM cities WHERE ID_STATE = $state_id";
    $result = $conn->query($query);
    $state_query = "SELECT STATE_NAME FROM states WHERE ID = $state_id";
    $state_result = $conn->query($state_query);
    $state_row = $state_result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cities in <?php echo $state_row['STATE_NAME']; ?></title>
</head>
<body>
    <h1>Cities in <?php echo $state_row['STATE_NAME']; ?></h1>
    <ul>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo '<li><a href="content.php?city_id=' . $row['ID'] . '">' . $row['CITY'] . '</a> - ' . $row['CITY_DESC'] . '</li>';
        }
        ?>
    </ul>
</body>
</html>
