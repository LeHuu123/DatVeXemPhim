<?php

class Router
{
    function __construct()
    {
    }


    function handleUrl()
    {

        $url = trim($_GET['url'], '/');
        global $routes;
        
  
        $handleUrl = $url;
        if (!empty($routes)) {
            foreach ($routes as $key => $valuie) {
                if (preg_match('/' . $key . '/is', $url)) {
                    $handleUrl = preg_replace('~' . $key . '~is', $valuie, $url);
                }
            }
        }
        // echo "sssssssssssssssssssssssssssssssssssssssssssssssssssssssss" . $handleUrl;
        return $handleUrl;
    }
}
