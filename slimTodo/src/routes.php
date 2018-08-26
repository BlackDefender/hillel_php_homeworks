<?php

use Slim\Http\Request;
use Slim\Http\Response;
use MongoDB\Client as Mongo;

// Routes

/*
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});*/

/*$container = new \Slim\Container;


*/

$container = $app->getContainer();
$container['db'] = function ($container) {
    return (new Mongo())->todo->user;
};


$app->get('/', function (Request $request, Response $response, array $args) {
    $todos = $this->db->find()->toArray();
    return $this->renderer->render($response, 'index.phtml', ['todos' => $todos]);
});

$app->post('/create', function (Request $request, Response $response, array $args) {
    $todo = [
        'done' => false,
        'task' => $request->getParsedBody()['task']
    ];
    $this->db->insertOne($todo);
    return $response->withRedirect('/', 303);
});

$app->post('/update', function (Request $request, Response $response, array $args) {
    $idStr = $request->getParsedBody()['id'];
    $id = new MongoDB\BSON\ObjectId($idStr);
    $this->db->updateOne(
        ['_id' => $id],
        ['$set' => ['done' => true]]
    );
    return $response->withRedirect('/', 303);

});

$app->post('/delete', function (Request $request, Response $response, array $args) {
    $idStr = $request->getParsedBody()['id'];
    $id = new MongoDB\BSON\ObjectId($idStr);
    $this->db->deleteOne(
        ['_id' => $id]
    );
    return $response->withRedirect('/', 303);

});