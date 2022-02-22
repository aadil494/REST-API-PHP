<?php 
// this file will interact with the model 
// since this is gonna be a rest api that we will access by http so we  need to add some headers

header('Access-Control-Allow-Origin: *'); // since this is gonna be a public api we are putting astricks  and not doing any authorizations and stuff

header('Content-Type: application/json');

// application/ json is a Multipurpose Internet Mail Extensions or MIME type and it indicates the nature and format of a document, file, or assortment of bytes. A simplest MIME type consists of a type and a subtype. A MIME type comprises these strings concatenated with a slash (/). No whitespace is allowed in a MIME type:

include_once('../../config/Database.php');
include_once('../../models/Post.php');

// Instantiate Database and connect 
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Blog Post query
$result = $post->read();

// Get the row count
$num = $result->rowCount();

// Check if any posts
if($num >0){
    // Post Array
    $post_arr = array();
    $posts_arr['data'] = array();

    // Loop through all the posts
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row); // extracts all the keys as variables
        $post_item =  array(
            'id'=>$id,
            'title'=> html_entity_decode($body),
            'author'=>$author,
            'category_id' =>$category_id,
            'category_name' => $category_name
        );
        // Push to the data
        array_push($posts_arr['data'],$post_item);
    }
    // Turn to JSON and output

    echo json_encode($posts_arr);

}else{
    echo  json_encode(array('message'=>'No posts found'));
}
