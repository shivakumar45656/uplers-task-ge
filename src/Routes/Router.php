<?php
namespace src\Routes;

// use src/Controllers

class Router {

    public static $uri;
    public static $queryParams;
    public static $requestMethod; //can help in developing different actions for same route with different requestMethod
    public static $isApi; //helps in implements some additional logic w.r.t apis in future
    public static $controller;
    public static $action;

            // $webRoutes = [
        //     ['controller' => 'tenant', 'action'=>'index','middlewares' => [] ],
        //     ['controller' => '', 'action'=>'','middlewares' => [] ],
        // ];
        // $apiRoutes = [
        //     ['controller' => 'tenant', 'action'=>'add','middlewares' => [] ],
        //     ['controller' => '', 'action'=>'','middlewares' => [] ],
        //     ['controller' => '', 'action'=>'','middlewares' => [] ],
        // ];

        //Though above format give better readability below format using controller names, 
        // action names can help with ease of access especially when large no of routes are present


     private static $webRoutes = [
            'tenant' => [
                'index' => ['middleware' => []]
            ]
        ];

     private static  $apiRoutes = [
            'tenant' => [
                'add' => ['middleware' => ['Auth']],
            ],
            'user' => [
                'register' => ['middleware' => []],
                'xpboost' => ['middleware' => []],
            ]
        ];

    function __construct($uri,$queryString,$requestMethod) {   //to parse and keep values available in some kind of framework manner
      
        $urlSegments = explode('?',$uri);
        self::$uri = $urlSegments[0];

        $queryParams = [];
        parse_str($queryString, self::$queryParams);

        self::$requestMethod = $requestMethod;

        
        $routeSegments = explode('/',self::$uri);

        if(array_search('api',$routeSegments)) {
            self::$isApi = true;
            self::$controller = $routeSegments[2];
            self::$action = $routeSegments[3];
        } else {
            self::$isApi = false;
            self::$controller = isset($routeSegments[1]) ? $routeSegments[1] :  'Home';
            self::$action = isset($routeSegments[2]) ? $routeSegments[2] : 'index' ;
        }
      }

    public function route() {
        // echo self::$uri."<br>";
        // var_dump(self::$queryParams);
        // echo self::$requestMethod."<br>";
        // echo self::$isApi ? 1 : 0 ; echo "<br>";
        // echo self::$controller."<br>";
        // echo self::$action."<br>";

        $specs = ['controller' => 'Error','action'=>'notFound','middleware' => [] ]; //if no route is found route it to 404 not found page 
      
        if(self::$isApi) {
            if(isset(self::$apiRoutes[self::$controller]) && isset(self::$apiRoutes[self::$controller][self::$action])) {
                $specs['controller'] = self::$controller;
                $specs['action'] = self::$action;
                $specs = array_merge($specs,self::$apiRoutes[self::$controller][self::$action]);
            }
        } else {
            if(isset(self::$webRoutes[self::$controller]) && isset(self::$webRoutes[self::$controller][self::$action])) {
                $specs['controller'] = self::$controller;
                $specs['action'] = self::$action;
                $specs = array_merge($specs,$this->webRoutes[self::$controller][self::$action]);
        }
    }
    return $specs;
    // var_dump($specs);
  }
}