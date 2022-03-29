<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
    <meta charset="UTF-8">       
</head>
<center><body>
    <h3>Đăng nhập</h3>
    <form action="login.php" method="POST">
        <table>
            <tr>
                <td>Tên đăng nhập: </td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Mật khẩu: </td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr  style="text-align: right;" >
                <td><button type="submit" name="register">Đăng ký</button></td>
                <td><button type="submit" name="login">Đăng nhập</button></td>
            </tr>
        </table>
    </form>
    <?php
        $conn = mysqli_connect("localhost","root","","formt2");
        if(isset($_POST['login']))
        {
            $username=$_POST['username'];
            $password= $_POST['password'];

            if($username==""||$password=="")
            {
                echo 'Vui lòng điền đầy đủ thông tin!';
            }
            else
            {
                $password=md5($password);
                $sql = "SELECT * FROM `formt2` WHERE username ='$username' AND password='$password' ";
                $query = mysqli_query($conn,$sql);
                if( mysqli_num_rows($query) != 0)
                {
                    $rows = mysqli_fetch_assoc($query);                   
                    $_SESSION['id'] = $rows['id'];
                    $_SESSION['username'] = $rows['username'];
                    $_SESSION['password'] = $rows['password'];
                    header('location: index.php');
                }
                else
                {
                    echo 'Tên đăng nhập hoặc mật khẩu chưa chính xác';
                }
            }
        }
        if(isset($_POST['register']))
        {
            header('location:register.php');
        }

    ?>
</body></center>
</html>