<?php
      include('config/constants.php');

      $commentNewCount = $_POST['commentNewCount'];

      $sql = "SELECT * FROM tbl_admin LIMIT $commentNewCount ";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0){

        echo "<table border='1' class='login'>";
        echo "<tr class='text-center'>";
        echo "<td>"."Full_Name"."</td>";
        echo "<td>"."Username "."</td>";;
        echo "</tr>";

            while($row = mysqli_fetch_assoc($result)){
                echo "<tr class='text-center'>";
                echo "<td>".$row['full_name']."</td>";
                echo "<br>";
                echo "<td>".$row['username']."</td>";
                echo "</tr>";
             }
             
        echo "</table>";

      }else{
        echo 'there are no comments';
      }

  ?>