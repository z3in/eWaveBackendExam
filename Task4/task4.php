<?php

$mysqli = new mysqli("localhost", "root", "", "news");


$query = "SELECT books.book_name as book_name,books.publish_date as publish_date , authors.first_name as author_firstname,authors.last_name as author_lastname
             FROM books LEFT JOIN authors ON authors.id = books.author_id 
             WHERE MONTH(books.publish_date) = 1 AND YEAR(books.publish_date) = 2021";
$result = $mysqli->query($query);

if($result && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo 'Book Name : ' .  $row['book_name'] . ' <br/>';
        echo 'Author : ' . $row['author_firstname'] . ' ' . $row['author_lastname'] . '<br/>';
        echo 'Published Date : ' . $row['publish_date'] . '<br/><hr/>';
    }   
}