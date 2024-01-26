<?php
include("config.php");

$queryEvent = "SELECT * FROM events";
$dataEvent = mysqli_query($conn, $queryEvent);

if (!$dataEvent) {
    die("Event query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link type="image/png" sizes="32x32" rel="icon" href="./assets/images/dark_fav.png">
  <link rel="stylesheet" href="./3.css">
  
    <title>Event Information</title>
    <style>
      
     

        .table-container {
            width: 100%%;
            height: 500px; /* Set a fixed height for the container */
            overflow: auto; /* Enable vertical scrolling */
            margin-top: 1rem;
         
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #f2f2f2;
            font-size: 18px;
            
        }
        

        tfoot {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }

        @media (max-width: 600px) {
            th, td {
                font-size: 14px;
            }

            th {
                font-size: 16px;
            }

            tfoot {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    
        <div class="table-container">
            <h1 style="color: grey;">Event Information</h1>
            <table>
                <thead>
                    
                   
                </thead>
                <tbody>
                    <?php
                    while ($rowEvent = mysqli_fetch_assoc($dataEvent)) {
                        echo"<tr>";
                        echo"<th>Event</th>";
                        echo"<th>Details:</th>";
                        echo"</tr>";
                   

                        echo "<tr>";
                        echo "<td rowspan='4' style='font-size: 20px;'><img src='./images/{$rowEvent['photo_path']}' width='300' height='300'></td>";
                        echo "<td style='font-weight: bold;'>{$rowEvent['event_title']}</td>";
                        echo "</tr>";
                        echo "<tr><td>Event Date: {$rowEvent['event_date']}</td></tr>";
                        echo "<tr><td>Organizer: {$rowEvent['organizer']}</td></tr>";
                        echo "<tr><td>Event Co-ordinator: {$rowEvent['location']}</td></tr>";
                        echo "<tr><td colspan='2'>{$rowEvent['other_details']}</td></tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <a href="events.php" class="logout-link add-event-button">
                                <input type="submit" value="Add Event" class="btn btn-primary">
                            </a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>
<?php
// Close the connection for event section
mysqli_close($conn);
?>
