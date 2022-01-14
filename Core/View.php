<?php
/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core;

class View
{
    public string $title = '';

    public function renderView($view, $params = [])
    {
        if(file_exists(Application::$ROOT_DIR."/Views/$view.php")){
            $ViewContent = $this->renderOnlyView($view, $params);
            $layoutContent = $this->layoutContent();
            return str_replace(trim('{{content}}'), $ViewContent, $layoutContent);
        }
    }

    public function renderContent($ViewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace(trim('{{content}}'), $ViewContent, $layoutContent);

    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        if(Application::$app->controller){
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/Layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value){
            $$key  = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/Views/$view.php";
        return ob_get_clean();
    }
}