<label for="status">Location:</label>
        <select name="location" id="location">
        <option value="-Select-" selected disabled>-Select-</option>

            <?php
                // Connect to your database
                include 'database.php';

                // Query to fetch location from the database
                $sql = "SELECT loid, location FROM locations";
                $result = $conn->query($sql);

                // Populate options
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['loid'] . "'>" . $row['location'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No location available</option>";
                }

                // Close database connection
                $conn->close();
            ?>
        </select>