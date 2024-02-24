<?php
namespace src\Middlewares;

//A function to executes all middlewares associated with a route per route basis 
//provides flexibility and ensure security if all are implemented as standard guidelines
function middlewareExecutor($metaData,$middlewares) {   
    $result = [
        'status' => true,
        'message' => 'all middlewares passed'
    ];
    try {
        for($i=0; $i < count($middlewares); $i++) {
            switch ($middlewares[$i]) {
                case 'Auth':
                  if(isset($metaData['headers']['authToken'])) {
                    Auth::verify($metaData['headers']['authToken']);
                  } else {
                    throw new \Exception("Missing Auth Token");
                  }
                  break;
                case Authorization:
                  //Authorization MiddleWare can be built based on user-id, contorller and action name
                    // as authorization is per resource or endpoint not implementing as of now
                  break;
                case Cors:
                  //Cors middleware can be build using headers to identify requesting host / domain name
                  //not implementing as of now
                  break;
                default:
                  //code block
              }
        }
    } catch (\Exception $error) {
      $result['status'] = false;
      $result['message'] = $error->getMessage();
    }
    return $result;
}
?>