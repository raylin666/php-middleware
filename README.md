# Web Middleware 

[![GitHub release](https://img.shields.io/github/release/raylin666/middleware.svg)](https://github.com/raylin666/middleware/releases)
[![PHP version](https://img.shields.io/badge/php-%3E%207-orange.svg)](https://github.com/php/php-src)

### 环境要求

* php >= 7.2

### 安装

```
composer require "raylin666/middlware"
```

### 使用方式

```php
<?php

use Raylin666\Middleware\Middleware;
use Psr\Http\Message\ServerRequestInterface;
use Raylin666\Middleware\DelegateInterface;
use Raylin666\Middleware\Dispatcher;
use Raylin666\Http\Request;

class ChlidMiddleware extends Middleware
{
    public function handler(ServerRequestInterface $request, DelegateInterface $next)
    {
        // TODO: Implement handle() method.
        dump($request);
        // 将控制权委托给下一个中间件
        return $next->process($request);
        /*
         * Dispatcher分发器将会按顺序执行中间件。但需要注意,不是分发器注册的中间件都必须会执行,只有当中间件执行通过后
         * 调用return $next->process($request) 才能继续执行下个中间件, 否则将结束中间件的继续分发。
         */
    }
}

class Chlid1Middleware extends Middleware
{
    public function handler(ServerRequestInterface $request, DelegateInterface $next)
    {
        // TODO: Implement handle() method.
        echo 2;
        return $next->process($request);
    }
}

class Chlid2Middleware extends Middleware
{
    public function handler(ServerRequestInterface $request, DelegateInterface $next)
    {
        // TODO: Implement handle() method.
        echo 3;
    }
}

$dispatcher = new Dispatcher([
    new ChlidMiddleware(),
    new Chlid1Middleware(),
    new Chlid2Middleware(),
]);

$dispatcher->dispatch(new Request('GET', '/'));
```

## 更新日志

请查看 [CHANGELOG.md](CHANGELOG.md)

### 贡献

非常欢迎感兴趣，并且愿意参与其中，共同打造更好PHP生态。

* 在你的系统中使用，将遇到的问题 [反馈](https://github.com/raylin666/middleware/issues)

### 联系

如果你在使用中遇到问题，请联系: [1099013371@qq.com](mailto:1099013371@qq.com). 博客: [kaka 梦很美](http://www.ls331.com)

