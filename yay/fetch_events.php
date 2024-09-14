<?php
require 'db.php';

// Fetch upcoming events only
$sql = "SELECT title, event_date FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC";
$result = $conn->query($sql);

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

// Return the events as JSON
echo json_encode($events);
?>
