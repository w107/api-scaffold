<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exceptions
    |--------------------------------------------------------------------------
    |
    | 当抛出这些异常时，可以使用我们定义的错误信息与HTTP状态码
    | 可以把常见异常放在这里
    |
    */
    'exceptions' => [
        \Illuminate\Auth\AuthenticationException::class => ['未授权', 401],
        \Illuminate\Database\Eloquent\ModelNotFoundException::class => ['该模型未找到', 404],
        \Illuminate\Auth\Access\AuthorizationException::class => ['没有此权限', 403],
        \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException::class => ['未登录或登录状态失效', 436],
        \Tymon\JWTAuth\Exceptions\TokenInvalidException::class => ['token不正确', 400],
        \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class => ['没有找到该页面', 404],
        \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException::class => ['访问方式不正确', 405],
        \Illuminate\Database\QueryException::class => ['参数错误', 401],
    ]

];
