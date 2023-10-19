<?php

namespace Controller\Frontend;

class BaseController {

    const VIEW_FOLDER_NAME = '../src/views';

    protected function view($path, array $data = [])
    {
        foreach($data as $key => $value){
            $$key = $value;
        }
        
        $path = self::VIEW_FOLDER_NAME . '/' . str_replace('.', '/', $path) . '.php';        
        require ($path);
    }

}