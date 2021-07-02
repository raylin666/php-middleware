<?php
// +----------------------------------------------------------------------
// | Created by linshan. 版权所有 @
// +----------------------------------------------------------------------
// | Copyright (c) 2021 All rights reserved.
// +----------------------------------------------------------------------
// | Technology changes the world . Accumulation makes people grow .
// +----------------------------------------------------------------------
// | Author: kaka梦很美 <1099013371@qq.com>
// +----------------------------------------------------------------------

namespace Raylin666\Middleware;

use SplStack;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Dispatcher
 * @package Raylin666\Middleware
 */
class Dispatcher
{
    /**
     * @var SplStack
     */
    protected $stack;

    /**
     * Dispatcher constructor.
     * @param $stack
     */
    public function __construct(array $stack = [])
    {
        $this->stack = $this->newSplStack();
        foreach ($stack as $value) {
            $this->before($value);
        }
    }

    /**
     * @param MiddlewareInterface $middleware
     * @return Dispatcher
     */
    public function after(MiddlewareInterface $middleware)
    {
        $this->stack->unshift($middleware);
        return $this;
    }

    /**
     * @param MiddlewareInterface $middleware
     * @return Dispatcher
     */
    public function before(MiddlewareInterface $middleware)
    {
        $this->stack->push($middleware);
        return $this;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function dispatch(ServerRequestInterface $request)
    {
        $response = $this->resolve()->process($request);
        $this->stack = $this->newSplStack();
        return $response;
    }

    /**
     * @return DelegateInterface
     */
    private function resolve()
    {
        return $this->stack->isEmpty() ?
            new Delegate(
                function () {
                    // throw new LogicException('unresolved request: middleware stack exhausted with no result');
                    return false;
                }
            ) :
            new Delegate(
                function (ServerRequestInterface $request) {
                    /** @var MiddlewareInterface $middleware */
                    $middleware = $this->stack->shift();
                    return $middleware->handler($request, $this->resolve());
                }
            );
    }

    /**
     * @return SplStack
     */
    private function newSplStack(): SplStack
    {
        return new SplStack();
    }
}