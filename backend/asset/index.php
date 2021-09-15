<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    //If required
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");         
 
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
    exit(0);
}
// Connect to database
$conn = mysqli_connect('us-cdbr-east-04.cleardb.com','b5dfb3a50766db','5a73cc25','heroku_2a059f07ece83f1');
include_once('asset.php');
$request_method = $_SERVER["REQUEST_METHOD"];
$data = json_decode(file_get_contents("php://input"));
$asset = new Asset;
switch($request_method)
{
   case 'GET':
    // Retrive Assets
    if(isset($_GET["asset_id"]))
    {
      $user_id=intval($_GET["asset_id"]);
       $asset->getAssetById($user_id);
    //  echo "coming here".$user_id;
    }
    else
    {
      $asset->getAllAssets();
    }
    break;
  case 'POST':
    // Insert User
    $asset->saveAsset($data);
    break;
  case 'PUT':
    $asset->updateAsset($data);
    break;	
  case 'DELETE':
    // Delete User
    $asset->deleteAsset($data);
    break;
  default:
    // Invalid Request Method
    header("HTTP/1.0 405 Method Not Allowed");
    break;
}