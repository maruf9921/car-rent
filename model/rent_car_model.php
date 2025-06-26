<?php

function fetchAllAvailableCars($conn) {
    $sql = "SELECT id, car_name, car_model, price_per_day, description, image FROM cars ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    $cars = [];

    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }

    return $cars;
}
