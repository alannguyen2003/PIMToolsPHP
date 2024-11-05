<?php

namespace App\Constant;

class ApiResponseConstant {

    //HTTP STATUS CODE 1xx
    //100 - Request still fine, client could continue process
    const HTTP_CONTINUE = 100;  
    //101 - Protocol on stage switching
    const HTTP_SWITCHING_PROTOCOLS = 101; 
    //102 - Server received request and on processing, but did not send anything
    const HTTP_PROCESSING = 102;
    //103 - Respond some information before the last HTTP message
    const HTTP_EARLY_HINTS = 103;

    //HTTP STATUS CODE 2xx
    //200 - OK
    const HTTP_OK = 200;
    //201 - Request successfully and new resource has been created
    const HTTP_CREATED = 201;
    //202 - Received request but still not process
    const HTTP_ACCEPTED = 202;
    //204 - This request have nothing inside
    const HTTP_NO_CONTENT = 204;


    //HTTP STATUS CODE 3xx
    //300 - There are more than 1 available requests
    const HTTP_MULTIPLE_CHOICE = 300;


    //HTTP STATUS CODE 4xx
    //400 - Wrong request and server cannot detect what request is
    const HTTP_BAD_REQUEST = 400;
    //401 - User do not have permission for this resource
    const HTTP_UNAUTHORIZED = 401;
    //403 - Your authentication is accepted but you do not have permission on this resource
    const HTTP_FORBIDDEN = 403;
    //404 - Resource not found
    const HTTP_NOT_FOUND = 404;
    //405 - Method not allowed for the request
    const HTTP_METHOD_NOT_ALLOWED = 405;
    

    //HTTP STATUS CODE 5xx
    //500 - Internal Server Error
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    //502 - Bad Gateway
    const HTTP_BAD_GATEWAY = 502;
    //504 - Gateway Time Out
    const HTTP_GATEWAY_TIMEOUT = 504;
}