
<?php
require "vendor/autoload.php";
use GuzzleHttp\Client;
function getBooks() {
    $token = 'd2988b16f18f2a5d8126a7076b92d7bccee3c87f93ce3dfb14cbf63da6d78c6595c59249611de6960b9cd18ea001f2a8ab5b1023b02ae7adae168a79da172bd7a5163fbb7e28a6cb1ed98cbaba7fd6caf7c370fd53f85165b634a0f13f60e29565fc15a321d04ce1f685b5f02aae990013b6ca91f17b1efae506c83da005903c';

    try {
        $client = new Client([
            'base_uri' => 'http://localhost:1337/api/'
        ]);
    
        $headers = [
          'Authorization' => 'Bearer ' . $token,        
          'Accept'        => 'application/json',
      ];
  
      $response = $client->request('GET', 'books?pagination[pageSize]=66', [
          'headers' => $headers
      ]);
    
        $body = $response->getBody();
        $decoded_response = json_decode($body);
        return $decoded_response;
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo '<pre>';
        var_dump($e);
    }
    return null; 
}

$books = getBooks();
?>

<html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Bible Scriptures</title>
    </head>
    <body style="background-color:white">
    <div class="container-fluid">
        <div class = "container">
            <h1 class="col-lg-4">Bible Scriptures</h1>
            <div class = "row">
                <div class="card mb-4 py-3 border-left-secondary">
                    <div class="card-body">         
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr class="p-3 bg-gray-400">
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                        </tr>
                        <?php
                            foreach($books->data as $bookData) {
                            $book = $bookData->attributes;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $bookData->id; ?></td>
                            <td><?php echo $book->name; ?></td>
                            <td><?php echo $book->author; ?></td>
                            <td><?php echo $book->category; ?></td>
                        </tr>
                        
                        <?php
                        }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>