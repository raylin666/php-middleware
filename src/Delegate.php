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

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Delegate
 * @package Raylin666\Middleware
 */
class Delegate implements DelegateInterface
{
    /**
     * @var callable
     */
    protected $callback;

    /**
     * Delegate constructor.
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * Dispatch the next available middleware and return the response.
     *
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function process(RequestInterface $request)
    {
        // TODO: Implement process() method.

        return call_user_func($this->callback, $request);
    }
}