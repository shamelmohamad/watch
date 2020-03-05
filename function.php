<?php

//get all products
function getAllWatch($db)
{
$sql = 'Select name, description, price from jam ';
$stmt = $db->prepare ($sql);
$stmt ->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get product by type 
function getdescription($db, $description)
{
$sql = 'Select * from jam Where name like :name';
$stmt = $db->prepare ($sql);
$id = $description;
$stmt->bindParam(':name', $description, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//delete product by name
function deleteid($db,$id) {
    $sql = ' Delete from jam where name = :name';
    $stmt = $db->prepare($sql);
    $id = $id;
    $stmt->bindParam(':name', $id, PDO::PARAM_STR);
    $stmt->execute();
    } 
    
    //update product by id
    function updatewatch($db,$form_data,$watchid) {
        $sql = 'UPDATE jam SET name = :name , description = :description , price = :price ';
        $sql .=' WHERE id = :id';
    
        $stmt = $db->prepare ($sql);
        $id = (int)$watchid;
    
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $form_data['name']);
        $stmt->bindParam(':description', $form_data['description']);
        $stmt->bindParam(':price', floatval($form_data['price']));
        $stmt->execute();

      
      
        

      
    }
    
//add
    function createProduct($db, $form_data) {
        $sql = 'Insert into jam (`name`, `description`, `price`) VALUES (:name, :description, :price)';
       
        $stmt = $db->prepare ($sql);
        $stmt->bindParam(':name', $form_data['name']);
        $stmt->bindParam(':description', $form_data['description']);
        $stmt->bindParam(':price', floatval($form_data['price']));
        $stmt->execute();
        return $db->lastInsertID();//insert last number.. continue
        }