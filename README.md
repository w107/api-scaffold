


# 安装

```
composer require "inn20/api-scaffold"
```

#### 创建配置文件&生成JWT key
```
php artisan api-scaffold:install
```

#### 上面命令等同于以下3条命令,按需使用

> 创建脚手架配置文件

```
php artisan vendor:publish --provider="Inn20\ApiScaffold\ApiServiceProvider"
```
> 创建JWT配置文件

```
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
```
> 生成JWT token

```
php artisan jwt:secret
```

# 配置

1. 修改异常处理器

> `App\Exceptions\Handler ` 继承 `Inn20\ApiScaffold\Exceptions\ApiHandler`

```
use Inn20\ApiScaffold\Exceptions\ApiHandler as ExceptionHandler;

class Handler extends ExceptionHandler
...
```

2. 配置 Auth guard
> `config/auth.php ` 文件中，修改为下面代码

```
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
       'driver' => 'jwt',
       'provider' => 'users',
    ],
],
```

3. 继承User模型

```
...
use Inn20\ApiScaffold\Models\User as JwtUser;

class User extends JwtUser
...
```

# 使用

#### 用户认证
> 登录 获取token

```
$token = Auth::guard('api')->attempt(['name'=>$request->name, 'password'=>$request->password]);
```
> 用户退出

```
Auth::guard('api')->logout();
```
> 返回当前登录用户信息

```
$user = Auth::guard('api')->user();
```

#### 中间件
###### api.guard
> 自动区分 guard

###### api.refresh
> 用户认证,token过期会自动刷新

#### 统一 Response 响应
###### 控制器引入trait `Inn20\ApiScaffold\Helpers\ApiResponse`


#### 异常接管
`config/apiscaffold.php` 文件
