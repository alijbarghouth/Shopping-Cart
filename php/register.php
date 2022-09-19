<?php
include 'DBconnection.php';



if (!empty($_POST['userName']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_FILES["file"]["name"])) {
    $username = $_POST['userName'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $targetDir = "../img/";
    $fileName = basename($_FILES["file"]["name"]);
    $var1 = rand(1111,9999);
    $var2 = rand(1111,9999);
    $var3 = $var1.$var2;
    $var3 = md5($var3);
    $fileName = $var3. $fileName;
    $targetFilePath = $targetDir . $fileName;
    // استخراج الامتداد
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    $allowTypes = array('jpg','png','jpeg','gif');
    
    // -----------------------------------
    $sql2 = 'SELECT id FROM admin WHERE email = ? ';
    $sql = 'SELECT id FROM customer WHERE email = ?';
    $res = $conn->prepare($sql);
    $res->bind_param('s', $email);
    $res->execute();
    $res->bind_result($id);
    $res->store_result();
    // ------------
    $res1 = $conn->prepare($sql2);
    $res1->bind_param('s', $email);
    $res1->execute();
    $res1->bind_result($id);
    $res1->store_result();
    if ($res1->num_rows > 0) {
        echo "<div>Email is exist</div>";
        return;
    }
    if ($res->error) {
        $myJSON = 'error';
        echo $myJSON;
        return 0;
        // fetch(); لنصل الداتا بالاري
        // num_rows لفحص اذا كان يوجد داتا بالاري
    } else {
        if ($res->num_rows > 0) {
            echo "<div> Email is exist </div>";
            return;
        } else {
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    $sql = 'INSERT INTO customer (username, email, password,image) VALUES (?,?,?,?)';
                    // check sql syntax
                    $res = $conn->prepare($sql);
                    $res->bind_param('ssss', $username, $email, $password, $fileName);
                    $res->execute();
                    if ($res->error) {
                        $myJSON = 'error';
                        echo $myJSON;
                        return 0;
                    } else {
                        header("Location:../login.html");
                        exit();
                    }
                }else{
                    $statusMsg = "Sorry, there was an error uploading your file.";
                     echo $statusMsg;
                     return;
                }
            }else{
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                echo $statusMsg;
                return;
            }
            
            if ($res->error) {
                $myJSON = 'error';
                echo $myJSON;
                return 0;
            } else {
                header("Location:../login.html");
                exit();
            }
        }
    }
} else {
    echo "Enter All Information";
}
