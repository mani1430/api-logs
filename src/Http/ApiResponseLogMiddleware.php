<?php

namespace Ocw\ApiResponseLog\Http;

use Closure;
use Ocw\ApiResponseLog\Models\ApiResponseLog;
use Illuminate\Support\Str;

class ApiResponseLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected static $api_type;

    public function handle( $request, Closure $next,$api_type)
    {
        self::$api_type = $api_type;
        return $next($request);
    }
    public function terminate( $request, $response)
    {
        $data = collect($request->all());
        if(isset($data['password']))
        {
           $data =  $data->except(['password']);
        }
        $uuid = (string) Str::uuid();
        $response->headers->set('UUID', $uuid);

         $log                      = new ApiResponseLog();
         $log->uu_id               = $uuid;
         $log->user_id             = auth()->id();  //user id
         $log->ip_address          = getRequestIp();
         $log->browser             = $request->header('user-agent');
         $log->api_type            = self::$api_type; //like apiv4
         $log->api_endpoint        = $request->path();
         $log->http_method         = $request->method();
         $log->full_url            = $request->fullUrl();
         $log->response_status     = $response->status();
         $log->request_body        = json_encode($data);
         $log->response_body       = $response->getContent();
         $log->request_header      = $request->headers;
         $log->response_header     = $response->headers;
         $log->save();
      
    }
}
