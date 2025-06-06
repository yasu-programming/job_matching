<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * The middleware registered on the controller.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Register middleware on the controller.
     *
     * @param  array|string|\Closure  $middleware
     * @param  array  $options
     * @return \Illuminate\Routing\ControllerMiddlewareOptions
     */
    public function middleware($middleware, array $options = [])
    {
        foreach ((array) $middleware as $m) {
            $this->middleware[] = [
                'middleware' => $m,
                'options' => &$options,
            ];
        }

        return new class($options) {
            protected $options;

            public function __construct(&$options)
            {
                $this->options = &$options;
            }

            public function only($methods)
            {
                $this->options['only'] = is_array($methods) ? $methods : func_get_args();
                return $this;
            }

            public function except($methods)
            {
                $this->options['except'] = is_array($methods) ? $methods : func_get_args();
                return $this;
            }
        };
    }

    /**
     * Get the middleware assigned to the controller.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }
}
