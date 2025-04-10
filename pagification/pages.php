<?php
include "connection.php";

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
if ($page < 0) $page = 0;

$offset = $page * $limit;

// total pages
$totalRecords = mysqli_query($conn, "SELECT COUNT(*) FROM pages");
$totalRecords = mysqli_fetch_array($totalRecords)[0];
$totalPages = ceil($totalRecords / $limit);

$sql = "SELECT * FROM pages LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f7f7f7;
        }

        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }      

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        

    </style>
</head>

<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Number</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result))  { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><?php echo $row['number']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <div class="pagination">
        <!-- Previous Button -->
        <?php if ($page > 0) {   ?>
            <a href="?page=<?php echo $page - 1; ?>"><button type="button">Previous</button></a>
        <?php } else { ?>
            <button type="button" disabled>Previous</button>
        <?php } ?>

        <!-- Page Numbers -->
        <?php for ($i = 0; $i < $totalPages; $i++) {?>
            <?php if ($i == $page) { ?>
                <button type="button" class="active"><?php echo $i + 1; ?></button>
            <?php } else {?>
                <a href="?page=<?php echo $i; ?>"><button type="button"><?php echo $i + 1; ?></button></a>
            <?php  }?>
        <?php } ?>

        <!-- Next Button -->
        <?php if ($page < $totalPages - 1) { ?>
            <a href="?page=<?php echo $page + 1; ?>"><button type="button">Next</button></a>
        <?php } else { ?>
            <button type="button" disabled>Next</button>
        <?php } ?>
    </div>
</body>

</html>
