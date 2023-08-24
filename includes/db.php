<?php

$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234567891011121';
$encryption_key = "child_help_foundation";

class db{ 
    private $manager;
    protected function connect(){
        return $this->manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    }    
}

class query extends db{

    function __construct($db_name){
         $this->db_name = $db_name;
    }
    
    public function getData($collection_name,$get){
        if($get == 'all'){
            $filter = [];
        }else{
            $filter = $get;
        }
        $query = new MongoDB\Driver\Query($filter);
        $cursor = $this->connect()->executeQuery($this->db_name.".".$collection_name, $query);
        foreach ($cursor as $document) {
            $responseData[] = $document;
        }
        // if(isset($responseData)){
            //     $fetchData = json_encode($responseData);
            // }else{
                //     $fetchData = json_encode(['status' => 0, 'message' => 'Record not found']);
                // }
        if(!isset($responseData)){
            $responseData = ['status' => 0, 'message' => 'Record not found'];
        }

        return json_encode($responseData);
    }

    public function insertData($collection_name,$doc){
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert($doc);
        $result = $this->connect()->executeBulkWrite($this->db_name.".".$collection_name, $bulk);
        if ($result->getInsertedCount() > 0) {
            $response = ['status' => 1, 'message' => 'Record Successfully Inserted'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed to create record'];
        }
        return json_encode($response);
    }

    public function updateDataByObjectID($collection_name,$objectID,$updatedData){
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['_id' => new MongoDB\BSON\ObjectId($objectID)],
            ['$set' => $updatedData],
            ['multi' => true, 'upsert' => false]
        );
        $result = $this->connect()->executeBulkWrite($this->db_name.".".$collection_name, $bulk);
        if ($result->getInsertedCount() > 0) {
            $response = ['status' => 0, 'message' => 'Failed to Updated Record'];
        } else {
            $response = ['status' => 1, 'message' => 'Record Successfully Updated'];
        }
        echo json_encode($response);
    }

    public function updateDataBykeyValue($collection_name,$key_name,$updatedData){
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            [$key_name],
            ['$set' => $updatedData],
            ['multi' => true, 'upsert' => false]
        );
        $result = $this->connect()->executeBulkWrite($this->db_name.".".$collection_name, $bulk);
        if ($result->getInsertedCount() > 0) {
            $response = ['status' => 0, 'message' => 'Failed to Updated Record'];
        } else {
            $response = ['status' => 1, 'message' => 'Record Successfully Updated'];
        }
        return json_encode($response);
    }

    public function deleteData($collection_name,$deleteID){
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->delete(['_id' => new MongoDB\BSON\ObjectId($deleteID)]);
        $result = $this->connect()->executeBulkWrite($this->db_name.".".$collection_name, $bulk);
        if ($result->getInsertedCount() > 0) {
            $response = ['status' => 0, 'message' => 'Failed to Delete Record'];
        } else {
            $response = ['status' => 1, 'message' => 'Record Successfully Deleted'];
        }
        echo json_encode($response);
    }
}

// add in other page 

// include 'db.php';

$database = new query('child_help_foundation');

// echo $database;

// Get All Collection 
// $data = json_decode($database->getData('user','all'));
// print_r($data);

// Get Specific Collection
// $array = ['name'=>'Ashiq'];
// $data = json_decode($database->getData('user',$array));
// print_r($data);

// Insert Collection
// $array = ['name'=>'Ashiq','mobile'=>'45678'];
// echo $database->insertData('user',$array);

// Update Collection
// $updateObjectID = '64d619ad007389ff98573d9c';
// $updatedData = ['name'=>'Ashiq'];
// echo $database->updateDataByObjectID('user',$updateObjectID,$updatedData);

// Update by Key Value Collection
// $updateKeyValue = ['key'=>'value'];
// $updatedData = ['name'=>'Ashiq'];
// echo $database->updateDataBykeyValue('user',$updateKeyValue,$updatedData);

// Delete Record 
// $deleteID = '64d619ad007389ff98573d9c';
// echo $database->deleteData('user', $deleteID);

?>