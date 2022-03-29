<?php
    session_start();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài</title>
</head>
<center><body style="display: flex; align-item: center; justify-content: center; height: 100vh;">
    <h3>Đăng ký tài khoản</h3></h3>
    <form action="register.php" method="POST">
        <table>
            <tr>
                <td>Tên đăng nhập: </td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Mật khẩu: </td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Nhập lại mật khẩu: </td>
                <td><input type="password" name="repassword"></td>
            </tr>
            <tr  style="text-align: right;" >
                <td><button type="submit" name="login">Đăng nhập</button></td>
                <td><button type="submit" name="register">Đăng ký</button></td>
            </tr>
        </table>
    </form>
    <?php
        $conn = mysqli_connect("localhost","root","","formt2");
        if( isset($_POST['register']) && $_POST['username'] != '' && $_POST['password'] != '' && $_POST['repassword'] != '')
        {
            $username = $_POST['username'];
            $password = $_POST["password"];
            $repassword = $_POST["repassword"];
            if($password != $repassword)
            {
                echo 'Mật khẩu không giống nhau, vui lòng nhập lại.';
            }
            $sql = "SELECT * FROM `formt2` WHERE username ='$username' ";
            $old = mysqli_query($conn, $sql);
            if(mysqli_num_rows($old) != 0)
            {
                echo 'Tên tài khoản đã tồn tại, vui lòng đặt tên khác.';
            }  
            else
            {
                $password = md5($password);
                $sql = "INSERT INTO formt2 (username, password) 
                        VALUES ('$username','$password') ";
                $query = mysqli_query($conn,$sql);
                if($query != 0)
                {
                    echo 'Đăng ký thành công!';
                }
                else
                {
                    echo 'Đăng ký thất bại!';
                }
            }
            
        }
        else
        {
            echo 'Vui lòng điền đầy đủ thông tin!';
        }
        if(isset($_POST['login']))
        {
            header('location: login.php');
        }

    ?>
</body></center>
</html>