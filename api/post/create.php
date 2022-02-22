<?php 
// this file will interact with the model 
// since this is gonna be a rest api that we will access by http so we  need to add some headers

header('Access-Control-Allow-Origin: *'); // since this is gonna be a public api we are putting astricks  and not doing any authorizations and stuff

header('Content-Type: application/json');

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Access-Control-Allow-Origin,Authorization,X-Requested-With');




// application/ json is a Multipurpose Internet Mail Extensions or MIME type and it indicates the nature and format of a document, file, or assortment of bytes. A simplest MIME type consists of a type and a subtype. A MIME type comprises these strings concatenated with a slash (/). No whitespace is allowed in a MIME type:

include_once('../../config/Database.php');
include_once('../../models/Post.php');


// Instantiate Database and connect 
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

//Get the raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

// Create post
if($post->create()){
    echo json_encode(
        array('message'=>'Post Created')
    );
}else{
    echo json_encode(
        array('message'=>'Post Not Created')
    );
}