<?php
class Route
{
    private $uri = '', $path;
    function handleRoute($url)
    {
        global $routes;
        unset($routes['default_controller']);
        // echo '<pre>';
        // print_r($routes);
        // echo '</pre>';

        $url = trim($url, '/');
        if (empty($url)) {
            $url = '/';
        }

        $handleUrl = $url;
        if (!empty($routes)) {
            foreach ($routes as $key => $value) {
                if (preg_match('~' . $key . '~is', $url)) {
                    $handleUrl = preg_replace('~' . $key . '~is', $value, $url);
                    $this->uri = $key;
                }
            }
        }
        return $handleUrl;
    }

    public function getUri(){
        return $this->uri;
    }

    static public function getFullUrl(){
        $path = App::$app->getUrl();
        $url = _WEB_ROOT.$path;
        return $url;
    }
}
