<?php


class View
{
    public static function make($view, $params = [])
    {
        
        $baseContent = self::getBaseContent(); //get content
        $viewContent = self::getViewContent($view ,false,$params); // inject in main

        echo (str_replace('{{content}}', $viewContent, $baseContent));
    }

    public static function makeOnly($view, $params = [])
    {
        
        $viewContent = self::getViewContent($view,false,$params); // inject in main

        echo $viewContent;
    }

    protected static function getBaseContent()
    {
        
        ob_start();

        include __DIR__ . '/../../Views/layouts/main.php';

        return ob_get_clean(); //output just buffer
    }

    public static function makeError($error)
    {
        self::getViewContent($error, true);
    }

    protected static function getViewContent($view, $isError = false, $params = [])
    {
        $path = $isError ? __DIR__ . '/../../Views/errors/' : __DIR__ . '/../../Views/';

        //return view(errors.404) or users.index
        if (strpos($view, '.')) {
            $views = explode('.', $view);

            foreach ($views as $view) {
                var_dump($view);
                if (is_dir($path . $view)) {
                    $path = $path . $view . '/';
                }
            }
            $view = $path . end($views) . '.php';
        } else {
            $view = $path . $view . '.php';
        }
        
        
        foreach ($params as $param => $value) {
            $$param=$value;
        }

        if ($isError) {
            include $view;
        } else {
            ob_start();

            include $view;

            return ob_get_clean();
        }
    }
}
