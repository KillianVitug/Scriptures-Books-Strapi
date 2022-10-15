<?php
function getBooks() {
    $token = '559a4487a54be112f4ca7a48b6cdf47a9f4507b64fb60d86fa57a08f5f05cb4cb7e6d6d4386f62cc662e57bedad6ffac08bf56a5f278a169211997f2e543843707501addfbeccd8d70be9ca7ad91d376ac915e022fa67dcae8e9bf617099064de4769b45f6f8a55c4c10f4ba8b2895b2ed092937674e4eb9a179c11d1f51e81b
    ';
    $curl = curl_init(); //Initializes curl
    curl_setopt($curl, CURLOPT_URL, 'http://localhost:1337/api/books');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token
    ]); // Sets header information for authenticated requests

    $res = curl_exec($curl);
    curl_close($curl);
    return json_decode($res);
}

$books = getBooks();
foreach ($books->data as $bookData) {
        echo $bookData->id;
        $book = $bookData->attributes;
        print_r($book);
}