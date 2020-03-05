<?php

use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

include __DIR__ . "/function.php";
//read all from  table  products
$app->get('/watch', function (Request $request, Response $response, array $arg){
    $data = getAllWatch($this->db);
  return $this->response->withJson(array('data' => $data), 200);
});


//request table products by condition
$app->get('/show/[{name}]', function ($request, $response, $args){
    
    $description = $args['name'];
  $data = getdescription($this->db,$description);
  if (empty($data)) {
    return $this->response->withJson(array('error' => 'no data'), 404);
 }
   return $this->response->withJson(array('data' => $data), 200);
});

//delete row
$app->delete('/watch/delete/[{name}]', function ($request, $response, $args){
    
    $id = $args['name'];
  $data = deleteid($this->db,$id);
  if (empty($data)) {
   return $this->response->withJson(array($id=> 'is successfully deleted'), 202);};
  }); 
  
  
  //put table products
  $app->put('/watch/put/[{id}]', function ($request,  $response,  $args){
    $watchid = $args['id'];

    if (!is_numeric($watchid)){
      return $this ->response->withJson(array('error' => 'numeric parameter required'), 422);
    }
    $form_data=$request->getParsedBody();

   $data=updatewatch($this->db,$form_data,$watchid);
    if ($data <=0) 
  return $this->response->withJson(array('data' => 'successfully updated'), 200);
  });
  
//add
  $app->post('/watch/add', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    $data = createProduct($this->db, $form_data);
    if ($data <= 0) {
      return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data' => 'success'), 201);
    }
  );