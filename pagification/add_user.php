<?php 
include "connection.php";

$nameErr = $ageErr = $numberErr = "";  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valid = true;

    if (empty($_POST['name'])) {
        $nameErr = "Name is required";        
        $valid = false;
    } else {
        $name = $_POST['name'];    
    }

    if (empty($_POST['age'])) {
        $ageErr = "Age is required";        
        $valid = false;
    } else {
        $age = $_POST['age'];    
    }

    if (empty($_POST['number'])) {
        $numberErr = "Number is required";        
        $valid = false;
    } else {
        $number = $_POST['number'];    
    }

    if ($valid) {  
        $sql = "INSERT INTO `pages`(`name`, `age`, `number`) VALUES ('$name','$age','$number')";
        $result = mysqli_query($conn, $sql);
        echo $result ? "<p class='success'>Data Inserted</p>" : "<p class='error'>Data not inserted</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
        }

        form {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            max-width: 400px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        span {
            color: red;
            font-size: 0.85em;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background: #007BFF;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        .success {
            color: green;
            margin-top: 20px;
        }

        .error {
            color: red;
            margin-top: 20px;
        }

        a {
            display: block;
            margin-top: 25px;
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">  
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter your name">
        <span><?php echo $nameErr; ?></span>

        <label for="age">Age:</label>
        <input type="text" id="age" name="age" placeholder="Enter your age">
        <span><?php echo $ageErr; ?></span>

        <label for="number">Number:</label>
        <input type="text" id="number" name="number" placeholder="Enter your number">
        <span><?php echo $numberErr; ?></span>

        <input type="submit" name="submit" value="Submit">
    </form>

    <a href="pages.php">Go to Pages</a>

</body>
</html>
