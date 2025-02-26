<!DOCTYPE html>
<html>
<head>
    <title>Delete Student Information</title>
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop_db";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM students1 WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        echo "Student information deleted successfully!";
        header("Location: display.php");
        exit();
    } else {
        echo "Invalid Student ID.";
    }
    ?>
</body>
</html>
