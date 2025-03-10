<?php
    require('db.php');
    // Fetch users from the 'users' table
    $query = "SELECT id, username, email, create_datetime FROM users";
    $result = mysqli_query($con, $query);

    // Check if there are any rows to display
    if (mysqli_num_rows($result) > 0) {
        // Start the table
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Created At</th></tr>";

        // Loop through the result set and display each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['create_datetime'] . "</td>";
            echo "</tr>";
        }

        // Close the table
        echo "</table>";
    } else {
        echo "No users found.";
    }

    // Close the database connection
    mysqli_close($con);
?>
