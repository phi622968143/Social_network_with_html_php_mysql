<?php
ob_start();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 連接資料庫
    $servername = "db";
    $username = "root";
    $password = "";
    $db = "test1";

    $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");

    // 處理上傳大頭貼
    $targetDirectory = "avatar/";
    $name = $_SESSION['acc'];
    $targetFile = $targetDirectory . basename($name.'.jpg');

    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
        echo "檔案已成功上傳。";
    } else {
        echo "上傳失敗。";
    }

    // 更新自介
    $intro = $_POST['intro'];
    $acc = $_SESSION['acc'];
    
    $check = "SELECT * FROM user_profile WHERE account_name = '$acc'";
    $result=$conn->query($check);
    // var_dump($result);
    if ($result->num_rows && $intro!="") {
        $updateIntroSQL = "UPDATE user_profile SET intro='$intro' WHERE account_name='$acc'";
        $conn->query($updateIntroSQL);
        echo "自介已成功更新。";
    }else if($intro!=""){
        $updateIntroSQL = "INSERT INTO user_profile (account_name,intro) VALUES ('$acc', '$intro')";
        $conn->query($updateIntroSQL);
        echo "自介已上傳。";
    }else{
        echo "noting";
    }

    $conn->close();
    
    //redict
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile</title>
    <link rel="stylesheet" href="./style/profile_upload.css" />
</head>
<body>
    <div class="title"><h2>Upload Profile</h2></div>
    <div class="container">
        <form action="profile_upload.php" method="post" enctype="multipart/form-data">
            <label class="avatar">
            <h2>Select Avatar:</h2>
            <input class="avatar" type="file" name="avatar" accept="image/*"/>
            <div class="avatar-file"><p>Choose a file</p></div>
            </label>
            <label class="intro"><h3>Introduction:</h3> </label>
            <textarea name="intro" rows="4" cols="50"></textarea>
            <input class="submit" type="submit" value="Upload" name="submit">
        </form>
    </div>
    <a class="go-back" href="profile.php"><h3>back to series!</h3></a>
    
</body>
</html>
