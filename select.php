<html>
<!--Written by Andrew Bergerson 2020 -->
<body>
<?php

$dbhoss = fopen("../../pg_connection_info.txt", "r") or die("Unable to open \"../pg_connection_info.txt\" file!");
        $connection = fgets($dbhoss);
        $dbhost = pg_connect($connection);
        pg_close($dbhoss);

        // If the $dbhost variable is not defined, there was an error
        if(!$dbhost)
        {
                die("Error: ".pg_last_error());
        }

        // Define the SQL query to run (replace these values as well)
        $cpuQuery = "SELECT * FROM cpu";
        $gpuQuery = "select * from gpu";
        $ramQuery = "select * from ram";
        $motherboardQuery = "select * from motherboard";
        $psuQuery = "select * from psu";

        // Run the SQL query
        $cpu1 = pg_query($dbhost, $cpuQuery);
        $cpu2 = pg_query($dbhost, $cpuQuery);
        $gpu1 = pg_query($dbhost, $gpuQuery);
        $gpu2 = pg_query($dbhost, $gpuQuery);
        $ram1 = pg_query($dbhost, $ramQuery);
        $ram2 = pg_query($dbhost, $ramQuery);
        $motherboard1 = pg_query($dbhost, $motherboardQuery);
        $motherboard2 = pg_query($dbhost, $motherboardQuery);
        $psu1 = pg_query($dbhost, $psuQuery);
        $psu2 = pg_query($dbhost, $psuQuery);


        echo "<form action = './checkout.php' method = 'post' >";


        // If the $result variable is not defined, there was an error in the query
        if (!$cpu1 || !$cpu2)
        {
                die("Error in query: ".pg_last_error());
        }

        echo "<h2>CPU's</h2><table><tr><th>Name and Company -</th><th>- General Clock Speed (GHz) -</th><th>- Price ($)</th></tr>";
        // Iterate through each row of the result
        while ($row = pg_fetch_array($cpu1))
        {
                echo "<tr><th>$row[0]</th><th>$row[2]</th><th>$row[3]</th></tr>";
        }
        echo "</table><br />";
        echo "select a CPU";
        echo "<select name = 'cpu'>";
        echo "<option selected = 'selected'>select</option>";
        while ($row = pg_fetch_array($cpu2))
        {
                echo "<option value = $row[1]>$row[0]</option>";
        }

        echo "</select>";

        echo "<h2>GPU's</h2><table><tr><th>Name and Company -</th><th>- General Video RAM (GB) -</th><th>- Price ($)</th></tr>";
        // Iterate through each row of the result
        while ($row = pg_fetch_array($gpu1))
        {
                echo "<tr><th>$row[0]</th><th>$row[2]</th><th>$row[3]</th></tr>";
        }
        echo "</table><br />";
        echo "select a GPU";
        echo "<select name = 'gpu'>";
        echo "<option selected = 'selected'>select</option>";
        while ($row = pg_fetch_array($gpu2))
        {
                echo "<option value = $row[1]>$row[0]</option>";
        }

        echo "</select>";

echo "<h2>RAM's</h2><table><tr><th>Name and Company -</th><th>- General RAM Count -</th><th>- Price ($)</th></tr>";
        // Iterate through each row of the result
        while ($row = pg_fetch_array($ram1))
        {
                echo "<tr><th>$row[0]</th><th>$row[2]</th><th>$row[3]</th></tr>";
        }
        echo "</table><br />";
        echo "select a RAM";
        echo "<select name = 'ram'>";
        echo "<option selected = 'selected'>select</option>";
        while ($row = pg_fetch_array($ram2))
        {
                echo "<option value = $row[1]>$row[0]</option>";
        }

        echo "</select>";

echo "<h2>Motherboards's</h2><table><tr><th>Name and Company -</th><th>- Socket Type -</th><th>- Price ($)</th></tr>";
        // Iterate through each row of the result
        while ($row = pg_fetch_array($motherboard1))
        {
                echo "<tr><th>$row[0]</th><th>$row[2]</th><th>$row[3]</th></tr>";
        }
        echo "</table><br />";
        echo "select a Motherboard";
        echo "<select name = 'mb'>";
        echo "<option selected = 'selected'>select</option>";
        while ($row = pg_fetch_array($motherboard2))
        {
                echo "<option value = $row[1]>$row[0]</option>";
        }

        echo "</select>";

echo "<h2>PSU's</h2><table><tr><th>Name and Company -</th><th>- Watt Capacity -</th><th>- Price ($)</th></tr>";
        // Iterate through each row of the result
        while ($row = pg_fetch_array($psu1))
        {
                // Write HTML to the page, replace this with whatever you wish to do with the data 

                echo "<tr><th>$row[0]</th><th>$row[2]</th><th>$row[3]</th></tr>";
        }
        echo "</table><br />";
        echo "select a PSU";
        echo "<select name = 'psu'>";
        echo "<option selected = 'selected'>select</option>";
        while ($row = pg_fetch_array($psu2))
        {
                echo "<option value = $row[1]>$row[0]</option>";
        }
            
        echo "</select> <br /><br />";

        echo "<input type = 'submit' value = 'submit' >";
        echo "</form>";


        pg_free_result($cpu1);
        pg_free_result($cpu2);
        pg_free_result($gpu1);
        pg_free_result($gpu2);
        pg_free_result($ram1);
        pg_free_result($ram2);
        pg_free_result($motherboard1);
        pg_free_result($motherboard2);
        pg_free_result($psu1);
        pg_free_result($psu2);

        
        pg_close($dbhost);
?>
</body>
</html>