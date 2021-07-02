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

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface MiddlewareInterface
 * @package Raylin666\Middleware
 */
interface MiddlewareInterface
{
    /**
     * @param ServerRequestInterface $serverRequest
     * @param DelegateInterface      $next
     * @return mixed
     */
    public function handler(ServerRequestInterface $serverRequest, DelegateInterface $next);
}