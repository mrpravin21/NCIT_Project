<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NCITArena</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f5f5f5;
            color: #333;
            box-sizing: border-box;
        }

        input[type="date"],
        input[type="file"] {
            width: calc(100% - 22px);
            margin-top: 5px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #2ecc71;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #27ae60;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-group label {
            font-size: 14px;
        }

        .form-group input[type="text"],
        .form-group textarea,
        .form-group select {
            background-color: #fff;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #2ecc71;
        }
    </style>
</head>

<body>
    <form method="post" action="#" enctype="multipart/form-data" >

        <div class="form-group">
            <label for="eid">Eid:</label>
            <input type="text" id="eid" name="eid" required>
        </div>

        <div class="form-group">
            <label for="event_title">Event Title:</label>
            <input type="text" id="event_title" name="event_title" required>
        </div>

        <div class="form-group">
            <label for="location">Event Coordinator:</label>
            <input type="text" id="location" name="location" required>
        </div>

        <div class="form-group">
            <label for="organizer">Organizer:</label>
            <select id="organizer" name="organizer">
                <option value="HULT">HULT</option>
                <option value="NOSK">NOSK</option>
                <option value="NTC">NTC</option>
                <option value="POLITICAL">Student Union</option>
                <option value="others">Others</option>
            </select>
        </div>

        <div class="form-group">
            <label for="message">Event Details:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="date">Event Date:</label>
            <input type="date" id="date" name="date" required>
        </div>

        <div class="form-group">
            <label for="image">Event Photo:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div> 

        <div class="form-group">
            <input type="submit" value="Submit" name="submit" >
        </div>
    </form>
</body>
</html>
<?php
include("config.php");

if (isset($_POST['submit'])) {
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = $_SERVER['DOCUMENT_ROOT'] . "/NCIT_Project/images/" . $filename;
    echo "Full Path: " . $folder;

    if (move_uploaded_file($tempname, $folder)) {
        echo "File uploaded successfully.";

        $a = $_POST['eid'];
        $b = $_POST['event_title'];
        $c = $_POST['location'];
        $d = $_POST['organizer'];
        $e = $_POST['message'];
        $f = $_POST['date'];

        // Use prepared statement to prevent SQL injection
        $sql = "INSERT INTO events(eid, event_title, location, organizer, event_date, other_details, photo_path)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "issssss", $a, $b, $c, $d, $f, $e, $filename);

        if (mysqli_stmt_execute($stmt)) {
            echo "Data entered successfully";
            
            // Redirect only if the statement execution is successful
           
        } else {
            echo "Unsuccessful entry";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error moving the uploaded file to $folder. Check folder permissions and file paths.";
    }
    #header("Location: home.php"); 
    #exit();
   # <script><script>
   echo '<script>alert("Insertion Successful"); window.location.href = "home.php#event-resource-sec";</script>';
   

}
?>
