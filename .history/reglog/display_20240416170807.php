<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            animation: changeBackgroundColor 20s infinite linear; /* Change background color every 20 seconds */
        }

        @keyframes changeBackgroundColor {
            0% {
                background-color: rgb(170, 170, 230);
            }
            50% {
                background: linear-gradient(to right, rgb(170, 170, 230), rgb(243, 201, 249)); /* Gradient transition */
            }
            100% {
                background-color: rgb(243, 201, 249);
            }
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
            animation: changeHeadingColor 8s infinite alternate; /* Change heading color every 8 seconds */
        }

        @keyframes changeHeadingColor {
            0% {
                color: #333;
            }
            50% {
                color: #ff5733; /* Change to a different color */
            }
            100% {
                color: #333;
            }
        }

        table {
            width: 85%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50; /* Bright green for better visibility */
            color: white; /* White text color for contrast */
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
<?php
include("config.php");
error_reporting(0);

$query = "SELECT * FROM tb_user";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);

if ($total != 0) {
    echo "<h2 align='center'><mark>Displaying All Records</mark></h2>";
    echo "<center><table>";
    echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Confirm Password</th>
            <th>Operations</th>
          </tr>";

    while ($result = mysqli_fetch_assoc($data)) {
        echo "<tr>
                <td>{$result['id']}</td>
                <td>" . htmlspecialchars($result['name']) . "</td>
                <td>" . htmlspecialchars($result['username']) . "</td>
                <td>" . htmlspecialchars($result['email']) . "</td>
                <td>" . htmlspecialchars($result['password']) . "</td>
                <td>" . htmlspecialchars($result['confirmpassword']) . "</td>
                <td><a href='update.php?id={$result['id']}'>Edit</a></td>
              </tr>";
    }
    echo "</table></center>";
} else {
    echo "<center>No records found</center>";
}
?>
</body>
</html>