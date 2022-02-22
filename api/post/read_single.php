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

// Get the ID from the url

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// GET THE POST
$post->read_single();
// Create Array

$post_arr = array(
    'id' => $post->id,
    'body' => $post->body,
    'title' => $post->title,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name,
);

//Make JSON
print_r(json_encode($post_arr));
