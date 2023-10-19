<?php

function partial($path, array $data = []) {

    foreach($data as $key => $value){
        $$key = $value;
    }

    $path = '../src/partials' . '/' . str_replace('.', '/', $path) . '.php';        
    require ($path);
}

function view($path, array $data = []) {
    
    foreach($data as $key => $value){
        $$key = $value;
    }
    $path = '../src/views' . '/' . str_replace('.', '/', $path) . '.php';        
    require ($path);
}
