<?php
header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=utf-8");

error_reporting(-1);
require_once('application/Application.php');

function router($params){
    $method = $params['method'];
    if($method){
        $app = new Application();
        switch($method){
            case 'loadPosts': return $app->loadPosts($params);
            case 'loadComments': return $app->loadComments($params);
            case 'deleteAll': return $app->deleteAll();
            case 'findComment': return $app->findComment($params);
        }
        return false;
    }
}

function answer($data){
    if($data){
        return array(
            'result' => 'ok',
            'data' => $data
        );
    } else {
        return array('result' => 'error');
    }
}

echo json_encode(answer(router(array_merge($_GET,$_POST))));

