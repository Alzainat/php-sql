<!DOCTYPE html>
<html>
<head>
    <title>Update Student Information</title>
</head>
<body>
    <h2>Update Student Information</h2>
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
        $stmt = $pdo->prepare('SELECT * FROM students1 WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $student = $stmt->fetch();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];

            $sql = "UPDATE students1 SET first_name = :first_name, last_name = :last_name, email = :email WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email, ':id' => $id]);

            echo "Student information updated successfully!";
            header("Location: display.php");
            exit();
        }
    } else {
        echo "Invalid Student ID.";
        exit();
    }
    ?>

    <form method="post">
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" value="<?php echo $student['first_name']; ?>" required><br><br>
        
        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" value="<?php echo $student['last_name']; ?>" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" required><br><br>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>
