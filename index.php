<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <style>
    header {
      height: 80px;
      width: 100%;
      background-color: grey;
    }
  </style>
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

  <div class="container py-5">
    <main>
      <a href="index.php?merge=true"><button class="btn btn-success">MERGE</button></a>
      <a href="example.php">DRIVE</a>
    </main>
    <?php
    if (isset($_GET['merge'])) {
      startMerge();
    }

    $output = [];
    function startMerge()
    {
      session_start();
      echo 'inizio...  <br>';
      /* Opening files */

      echo 'apertura files <br>';
      $fh1 = fopen('https://intonsin.sirv.com/authors.csv', 'r');
      $fh2 = fopen('https://intonsin.sirv.com/books.csv', 'r');

      $authors = array();
      $books = array();

      /* Loading files into arrays */
      while (($row = fgetcsv($fh1, 0, ",")) !== FALSE) {
        $authors[] = $row;
      }

      while (($row = fgetcsv($fh2, 0, ",")) !== FALSE) {
        $books[] = $row;
      }
      /* var_dump($authors); // authors
      echo '------------------------';
      var_dump($books); // books */

      $output[0] = [
        0 => 'id',
        1 => 'name',
        2 => 'author',
        3 => 'author bio',
        4 => 'author photo',
        5 => 'photo cover',
        6 => 'synopsis',
      ];

      /* OSS: gli ID non sono in corrispondenza ( errore nel file ? ) */

      echo 'creazione output  <br>';
      for ($i = 1; $i < count($books); $i++) {
        $output[$i] = [
          0 => $books[$i][0], // id
          1 => $books[$i][1], // book name
          2 => findAuthor($books[$i][1], $authors, 'name'), // author name
          3 => findAuthor($books[$i][1], $authors, 'bio'), // author bio
          4 => extractUrl(findAuthor($books[$i][1], $authors, 'photo')), // author photo
          5 => extractUrl($books[$i][3]), // book photo
          6 => $books[$i][4], // book synopsis
        ];
      };


      /* var_dump($output); */

      echo 'creazione file csv output  <br>';
      /* Writing on new file */
      $fp = fopen('output.csv', 'w');
      foreach ($output as $field) {
        fputcsv($fp, $field);
      }
      fclose($fp);

      echo 'fine  <br>';

      echo '<a href="output.php"><button class="my-5 btn btn-primary">OUTPUT</button></a>';

      $_SESSION['array'] = $output;
    }

    function findAuthor($book_name, $authors, $param)
    {
  
      $value = null;
      for ($i=0; $i < count($authors) ; $i++) { 
        if(strpos($authors[$i][4],$book_name)!== false){
          $value = $i;
        }
      }

      /* Key doesnt work since there are can be multiple values in the same column books in authors => use $value for correct results */
      $key = array_search($book_name, array_column($authors, '4'));
      if ($param == 'name') return $authors[$value][1];
      if ($param == 'bio') return $authors[$value][3];
      if ($param == 'photo') return $authors[$value][2];
    }

    function extractUrl($string)
    {
      preg_match_all("/\\((.*?)\\)/", $string, $out);
      return $out[1][0];
    }
    ?>
  </div>



</body>

</html>