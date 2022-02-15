<?php
    /*
    $query = «SELECT anons,text FROM news WHERE id='».$_GET['x']."'";
    $res = mysql_query($query);
    if($res && mysql_num_rows($res)>0){
    while($row = mysql_fetch_assoc($res)){
    echo $row['anons'];
    echo $row['text'];}}

    I would replace it with something like this.
    */

    $mysqli = new mysqli("localhost", "root", "", "news");

    if(!isset($_GET['x'])){
        echo 'URL Parameter `x` missing';
    }

    $data = $_GET['x'];
    $query = sprintf("SELECT `short_description`,`article` FROM `news` WHERE `id`='%s'",
                    $mysqli->real_escape_string($data));
    $result = $mysqli->query($query);
    /** /Task3/task3.php?x=3 which is not on the database will result of data non display  **/
    if(!$result->num_rows) return header('HTTP/1.0 404 Not Found', true, 404);

    if($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo $row['short_description'];
            echo $row['article'];
        }   
    }

    /* enable me to simulate injection */
    $inject = false;
    
    /** the injection will work on the code below using this url <PATH> /Task3/task3.php?x=123%27%20or%20%271%27=%271 (x=1' OR '1'='1) **/
    /** it will display all the data on the table **/
    if($inject){
        $conn = mysqli_connect("localhost", "root", "", "news");
        $injection = mysqli_query($conn,"SELECT `short_description`,`article` FROM `news` WHERE `id`='" . $_GET['x'] ."'");
        if($injection && mysqli_num_rows($injection) >0){
            while($rows = mysqli_fetch_assoc($injection)){
                echo $rows['short_description'];
                echo $rows['article'];
            }
        }
    }