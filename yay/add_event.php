<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        /* Navbar styling */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background-color: #333;
            color: white;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        /* Container for the navbar content */
        .navbar-content {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 1200px;  /* Constrain the width */
            margin: 0 auto;     /* Center the navbar content */
            padding: 0 20px;
        }

        /* Title inside the navbar */
        .navbar-title {
            font-size: 24px;
            text-align: center;
            flex-grow: 1;
            margin: 0;
            color: white;
        }

        /* Menu Icon (Hamburger) */
        .menu-icon {
            font-size: 30px;
            cursor: pointer;
            color: white;
            margin-right: 20px;
        }

        /* Side Navigation Menu (Initially Hidden) */
        .sidenav {
            position: fixed;
            top: 60px; /* Below the navbar */
            left: 0;
            width: 200px;
            height: 100%;
            background-color: #333;
            color: white;
            padding-top: 20px;
            overflow-x: hidden;
            transition: transform 0.3s ease;
            transform: translateX(-100%);
        }

        .sidenav a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            font-size: 18px;
        }

        .sidenav a:hover {
            background-color: #575757;
        }

        /* Main content styling */
        .main-content {
            margin: 60px auto 20px; /* Center and push content down */
            padding: 20px;
            width: 90%;
            max-width: 1200px;  /* Constrain content width */
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Push content to the right when the menu is open */
        .menu-open .main-content {
            margin-left: 200px;
        }

        /* Open side navigation */
        .menu-open .sidenav {
            transform: translateX(0);
        }

        /* Event Form */
        .event-form {
            margin-top: 30px;
        }

        /* Ensure labels and inputs are aligned properly */
        .event-form label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }

        .event-form input {
            width: calc(100% - 50px); /* Adjust width for icon space */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Adjust the placeholder styling */
        .event-form input::placeholder {
            color: transparent; /* Hide the placeholder */
        }

        /* Button styling */
        .event-form input[type="submit"] {
            background-color: #333;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
        }

        .event-form input[type="submit"]:hover {
            background-color: #555;
        }

        /* Google Maps Modal Styling */
        #mapModal {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        #mapContainer {
            background: white;
            width: 80%;
            height: 80%;
            border-radius: 10px;
            position: relative;
        }

        #mapClose {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        #map {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
            <h1 class="navbar-title">Add Event</h1>
        </div>
    </nav>

    <!-- Side Navigation Menu (Initially Hidden) -->
    <div id="sideNav" class="sidenav">
        <a href="dashboard.php">Home</a>
        <a href="add_event.php">Add Event</a>
        <a href="ongoingEvents.php">Ongoing Events</a>
        <a href="reglog.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Event Form Section -->
        <div id="addEvent" class="event-form">
            <h2>Add New Event</h2>
            <form id="eventForm" method="post" action="php/add_event.php">
                <label for="eventTitle">Event Title:</label>
                <input type="text" id="eventTitle" name="eventTitle" required>

                <label for="eventDate">Event Date:</label>
                <input type="date" id="eventDate" name="eventDate" required>

                <label for="eventLocation">Event Location:</label>
                <input type="text" id="eventLocation" name="eventLocation" readonly onclick="showMap()" required>
                <img src="https://maps.google.com/mapfiles/ms/icons/blue-dot.png" alt="Map Icon" style="width: 20px; height: 20px; cursor: pointer; vertical-align: middle;">

                <input type="submit" value="Add Event">
            </form>
        </div>
    </div>

    <!-- Google Maps Modal -->
    <div id="mapModal">
        <div id="mapContainer">
            <span id="mapClose">&times;</span>
            <div id="map"></div>
        </div>
    </div>

    <script>
        // Toggle the side navigation menu
        function toggleMenu() {
            document.body.classList.toggle('menu-open');
        }

        // Show Google Maps modal
        function showMap() {
            document.getElementById('mapModal').style.display = 'flex';
            initMap(); // Initialize the map
        }

        // Close the Google Maps modal
        document.getElementById('mapClose').onclick = function() {
            document.getElementById('mapModal').style.display = 'none';
        };

        // Initialize Google Maps
        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -34.397, lng: 150.644 }, // Default location
                zoom: 8
            });

            const marker = new google.maps.Marker({
                position: { lat: -34.397, lng: 150.644 },
                map: map
            });

            google.maps.event.addListener(map, 'click', function(event) {
                marker.setPosition(event.latLng);
                document.getElementById('eventLocation').value = `${event.latLng.lat()}, ${event.latLng.lng()}`;
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
</body>
</html>
<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = isset($_POST['eventTitle']) ? $_POST['eventTitle'] : '';
    $event_date = isset($_POST['eventDate']) ? $_POST['eventDate'] : '';
    $location = isset($_POST['eventLocation']) ? $_POST['eventLocation'] : '';
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';

    // Check if fields are properly filled
    if (empty($title) || empty($event_date) || empty($location) || empty($latitude) || empty($longitude)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        exit();
    }

    // Prepare SQL statement to insert the event into the database
    $sql = "INSERT INTO events (title, event_date, location, latitude, longitude, status) VALUES (?, ?, ?, ?, ?, 'upcoming')";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement: ' . $conn->error]);
        exit();
    }

    $stmt->bind_param('sssss', $title, $event_date, $location, $latitude, $longitude);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Event added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add event: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
