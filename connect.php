<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))//determine post and submit method
{
    // Create connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db="test1";

  $conn = new mysqli($servername, $username, $password,$db);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $a=$_POST['account'];
  $p=$_POST['pwd'];
  $sql="INSERT INTO my_table (account, pwd) VALUES ('$a', '$p');";
  $q=mysqli_query($conn,$sql);//exe c&i
  if ($q) {
      echo "Entry!";
  }else{echo "f";}

}
?>     
 <button class="registrationlink" onclick="redirectToRegistration()">Go to login</button>
  <!-- <a href="up.html">註冊頁面</a> -->
  <script>
    function redirectToRegistration() {
        window.location.href = "in.html"; // Replace with your actual registration page URL
    }
  </script>