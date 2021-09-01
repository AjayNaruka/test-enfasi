<?php
session_start();
$output = $_SESSION['array'];
session_destroy();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <title>Document</title>
</head>
<style>
  div.fixed {
    height: 100px;
    overflow: hidden;
  }
</style>

<body>
  <header>HEADER</header>
  <main>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Author</th>
          <th scope="col">Author Bio</th>
          <th scope="col">Author Photo</th>
          <th scope="col">Photo Cover</th>
          <th scope="col">Synopsis</th>

        </tr>
      </thead>
      <tbody>
        <<?php
          foreach ($output as $key => $book) {
            if ($key == '0') continue;
          ?> <tr>
          <th scope="row"> <?php echo $book[0] ?> </th>
          <td>
            <div class="fixed"> <?php echo $book[1] ?> </div>
          </td>
          <td>
            <div class="fixed"> <?php echo $book[2] ?> </div>
          </td>
          <td>
            <div class="fixed"> <?php echo $book[3] ?> </div>
          </td>
          <td>
            <div class="fixed"> <?php echo $book[4] ?> </div>
          </td>
          <td>
            <div class="fixed"> <?php echo $book[5] ?> </div>
          </td>
          <td>
            <div class="fixed"> <?php echo $book[6] ?> </div>
          </td>

          </tr>
        <?php }
        ?>


      </tbody>
    </table>
  </main>

</body>

</html>