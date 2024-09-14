<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Calendar Dashboard</title>
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
            margin-top: 60px; /* Push content down to avoid overlap with navbar */
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        /* Main content container for comfortable alignment */
        .container {
            max-width: 1200px;  /* Constrain content width */
            margin: 0 auto;     /* Center the main content */
            padding: 20px;
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

        /* Calendar grid layout */
        #calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            margin-top: 20px;
        }

        #calendar div {
            padding: 20px;
            background-color: #eef;
            border: 1px solid #ccc;
            text-align: center;
        }

        /* Event List */
        .event-list {
            margin-top: 30px;
        }

        .event-list h2 {
            margin-top: 0;
        }

        .event-list div {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
            <h1 class="navbar-title">School Calendar Dashboard</h1>
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
    <div class="main-content container">
        <!-- Calendar Section -->
        <div id="calendar"></div>

        <!-- Upcoming Events Section -->
        <div id="upcomingEvents" class="event-list">
            <h2>Upcoming Events</h2>
            <div id="eventsList"></div>
        </div>
    </div>

    <script>
        // Toggle the side navigation menu
        function toggleMenu() {
            document.body.classList.toggle('menu-open');
        }

        // Fetch and display events as per your logic
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch events
            function fetchEvents() {
                fetch("php/fetch_events.php")
                    .then(response => response.json())
                    .then(events => {
                        const eventsList = document.getElementById("eventsList");
                        eventsList.innerHTML = "";
                        events.forEach(event => {
                            const eventDiv = document.createElement("div");
                            eventDiv.innerHTML = `<strong>${event.title}</strong><br>Date: ${event.event_date}<br>Location: ${event.location}`;
                            eventsList.appendChild(eventDiv);
                        });
                    });
            }

            fetchEvents(); // Fetch events when the page loads
        });
    </script>
</body>
</html>
