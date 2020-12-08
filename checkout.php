<html>
<!-- Written by Andrew Bergerson 2020 -->
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
        $cpuQuery = "SELECT * FROM cpu where cpu_id = " . $_POST['cpu'];
        $gpuQuery = "SELECT * FROM gpu where gpu_id = " . $_POST['gpu'];
        $ramQuery = "SELECT * FROM ram where ram_id = " . $_POST['ram'];
        $mbQuery = "SELECT * FROM motherboard where mb_id = " . $_POST['mb'];
        $psuQuery = "SELECT * FROM psu where psu_id = " . $_POST['psu'];



        // Run the SQL query
        $cpu1 = pg_query($dbhost, $cpuQuery);
        $gpu1 = pg_query($dbhost, $gpuQuery);
        $ram1 = pg_query($dbhost, $ramQuery);
        $mb1 = pg_query($dbhost, $mbQuery);
        $psu1 = pg_query($dbhost, $psuQuery);
        $cpu2 = pg_query($dbhost, $cpuQuery);
        $gpu2 = pg_query($dbhost, $gpuQuery);
        $ram2 = pg_query($dbhost, $ramQuery);
        $mb2 = pg_query($dbhost, $mbQuery);
        $psu2 = pg_query($dbhost, $psuQuery);


        if (!$gpu1)
        {
                die("Error in query: ".pg_last_error());
        }

        echo "<h2>Your Order:</h2><table><tr><th>Part Selected -</th><th>- Price ($)</th></tr>";
        while ($row = pg_fetch_array($cpu1))
        {
                // Write HTML to the page, replace this with whatever you wish to do with the data 

                echo "<tr><th>$row[0]</th><th>$row[3]</th></tr>";
        }

        while ($row = pg_fetch_array($gpu1))
        {
                // Write HTML to the page, replace this with whatever you wish to do with the data 

                echo "<tr><th>$row[0]</th><th>$row[3]</th></tr>";
        }


        while ($row = pg_fetch_array($ram1))
        {
                // Write HTML to the page, replace this with whatever you wish to do with the data 

                echo "<tr><th>$row[0]</th><th>$row[3]</th></tr>";
        }


        while ($row = pg_fetch_array($mb1))
        {
                // Write HTML to the page, replace this with whatever you wish to do with the data 

                echo "<tr><th>$row[0]</th><th>$row[3]</th></tr>";
        }


        while ($row = pg_fetch_array($psu1))
        {
                // Write HTML to the page, replace this with whatever you wish to do with the data 

                echo "<tr><th>$row[0]</th><th>$row[3]</th></tr>";
        }
echo "</table>";
echo "<br />";

$row1 = pg_fetch_array($cpu2);
$row2 = pg_fetch_array($gpu2);
$row3 = pg_fetch_array($ram2);
$row4 = pg_fetch_array($mb2);
$row5 = pg_fetch_array($psu2);

$final_price = $row1[3] + $row2[3] + $row3[3] + $row4[3] + $row5[3];

echo "<h3>Total Price: </h3>" . "$" . $final_price;

$final_query = "insert into computer(cpu_id,psu_id,gpu_id,mb_id,ram_id)  values (" . $row1[1] . "," .  $row5[1] . "," . $row2[1] . "," . $row4[1] . "," . $row3[1] .")";
$res = pg_query($dbhost, $final_query);

?>
</body>
</html>