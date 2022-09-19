<?php
include 'DBconnection.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = 'SELECT id  FROM customer WHERE email = ? AND password = ?';
    $res = $conn->prepare($sql);
    $res->bind_param('ss', $email, $password);
    $res->execute();
    $res->bind_result($id);
    $res->store_result();
    // -------
    $sql2 = 'SELECT id  FROM admin WHERE email = ? AND password = ?';
    $res2 = $conn->prepare($sql2);
    $res2->bind_param("ss", $email, $password);
    $res2->execute();
    $res2->bind_result($id);
    $res2->store_result();
    if ($res2->num_rows > 0) {
        while ($res2->fetch()) {
            header("Location:admin.php?id=" . $id);
            exit();
        }
    } else {
        if ($res->error) {
            $myJSON = 'error';
            echo $myJSON;
            return 0;
            // fetch(); لنصل الداتا بالاري
            // num_rows لفحص اذا كان يوجد داتا بالاري
        } else {

            if ($res->num_rows > 0) {
                while ($res->fetch()) {
                    header("Location:../index.php?id=" .  $id);
                    exit();
                }
            } else {
                echo "<div> Account Nzot Found </div>";
                return;
            }
        }
    }
}
