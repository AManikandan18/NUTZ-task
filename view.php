<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiva="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    

    <!-- Font Awesome -->
     </head>
 <body>
    <table>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">username</th>
      <th scope="col">password</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
    include "database.php";

      $sql = "SELECT id,username,post FROM `login`";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        ?>
         <tr>
      <td><?php echo $row['id'] ?></th>
      <td><?php echo $row['username'] ?></td>
      <td><?php echo $row['post'] ?></td>
      
     
     
    </tr>

        <?php
      }
      ?>
   
    
  </tbody>
</table>
                    
               
                
 </body>
 </html>