<?php
class Asset{
  //Get All Assets 
  function getAllAssets()
  {
    global $conn;
    $query="SELECT * FROM tbl_asset ORDER BY id DESC";
    $response=array();
    $result=mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result))
    {
      $response[]=$row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  //Get Asset by id
  function getAssetById($assetid)
  {
    global $conn;
    $query="SELECT * FROM tbl_asset where id=".$assetid;
    $response=array();
    $result=mysqli_query($conn, $query);
    $rows=mysqli_num_rows($result);
    if($rows > 0){
        while($row = mysqli_fetch_assoc($result))
        {
          $response[]=$row;
        }
    }
    else{
      array_push($response,"No Data Found");
    }

    header('Content-Type: application/json');
    echo json_encode($response);
  }

  //Save Asset
  function saveAsset($data){
    global $conn;
    $query="INSERT INTO tbl_asset (asset_type,asset_category,asset_code,asset_description,asset_manufrer,asset_condition,asset_qty,asset_tag) VALUES 
				('".$data->asset_type."', '".$data->asset_category."', '".$data->asset_code."', '".$data->asset_description."', '".$data->asset_manufrer."', '".$data->asset_condition."', '".$data->asset_qty."', '".$data->asset_code."')";
    echo $result=mysqli_query($conn, $query);
    header('Content-Type: application/json');
    //Respond success / error messages
  }
  
  //Update Asset
  function updateAsset($data){
    global $conn;
    $query = "UPDATE tbl_asset SET asset_type='".$data->asset_type."', asset_category='".$data->asset_category."', asset_code='".$data->asset_code."', asset_description='".$data->asset_description."', asset_manufrer='".$data->asset_manufrer."', asset_condition='".$data->asset_condition."', asset_qty='".$data->asset_qty."', asset_tag='".$data->asset_code."'  WHERE id=$data->id.";
    echo $result=mysqli_query($conn, $query);
    header('Content-Type: application/json');
    //Respond success / error messages
  }
  
  //Delete Asset
  function deleteAsset($data){
    global $conn;
    $query = "DELETE FROM tbl_asset WHERE id=".$data->id;
    echo $result=mysqli_query($conn, $query);
    header('Content-Type: application/json');
    //Respond success / error messages
  }
}