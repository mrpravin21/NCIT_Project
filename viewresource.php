<?php
include("config.php");

$queryResource = "SELECT rid, resource_title, year, _path FROM resource";
$resultResource = mysqli_query($conn, $queryResource);

if (!$resultResource) {
    die("Resource query failed: " . mysqli_error($conn));
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
  
    <title>Resource Table</title>
    <style>
        

        .container {
            margin-top: 1rem;
        }


        .table {
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
.table-container{
  overflow: auto;
}
        th, td {
            text-align: center;
        }

        a {
            color: #007bff;
        }

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
    <div class="container">
        <div style="max-height: 400px; overflow-y: auto;">
            <h1 style="color: grey;">Resource  Table</h1>

            <table class="table table-striped table-bordered" id="resourceTable">
                <thead>
                    <tr>
                        <th>Year</th>
                        <th>Subject</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($resultResource)) {
                        echo "<tr>";
                        echo "<td>{$row['year']}</td>";
                        echo "<td>{$row['resource_title']}</td>";
                        echo '<td><a href="' . $row['_path'] . '" class="btn btn-primary" download="' . $row['resource_title'] . '">Download</a></td>';
                        echo "</tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            <a href="upload.php" class="logout-link upload-button">
                                <input type="submit" value="Upload Resource" class="btn btn-primary">
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
// Close the connection for resource section
mysqli_close($conn);
?>
