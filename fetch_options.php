<label for="status">Serviceability:</label>
        <select name="options" id="options">
        <option value="-Select-" selected disabled>-Select-</option>

            <?php
                // Connect to your database
                include 'database.php';

                // Query to fetch options from the database
                $sql = "SELECT sid, status FROM serviceability";
                $result = $conn->query($sql);

                // Populate options
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['sid'] . "'>" . $row['status'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No options available</option>";
                }

                // Close database connection
                $conn->close();
            ?>
        </select>