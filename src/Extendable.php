<?php

namespace EmilMoe\Extendable;

class Extendable
{
    /**
     * @var Package
     */
    private static $instance;

    private $extends;

    /**
     * @return Package
     */
    public static function getInstance()
    {
        if (! self::$instance)
            self::$instance = new Extendable();

        return self::$instance;
    }

    /**
     * @param $class
     * @param $name
     * @param $closure
     * @internal param $method
     * @internal param array $parameters
     */
    public static function extend($class, $name, $closure)
    {
        self::getInstance()->addExtension($class, $name, $closure);
    }

    /**
     * @param $class
     * @param $name
     * @param array $parameters
     * @return mixed
     */
    public static function getExtension($class, $name, array $parameters = [])
    {
        return self::getInstance()->loadExtension($class, $name, $parameters);
    }

    /**
     * @param $class
     * @param $name
     * @return bool
     */
    public static function hasExtension($class, $name)
    {
        return isset(self::getInstance()->extends[$class][$name]);
    }

    /**
     * @param $class
     * @param $name
     * @param $closure
     */
    public function addExtension($class, $name, $closure)
    {
        if (! isset($this->extends[$class]))
            $this->extends[$class] = null;

        $this->extends[$class][$name] = $closure;
    }

    /**
     * @param $class
     * @param $name
     * @param array $parameters
     * @return mixed
     */
    public function loadExtension($class, $name, array $parameters = [])
    {
        if (! isset($this->extends[$class]))
            abort(500, 'Class '. $class .' is not extended');

        if (! isset($this->extends[$class][$name]))
            abort(500,'Class '. $class .' has no extension called '. $name);

        if (isset($this->extends[$class][$name]))
            return call_user_func_array($this->extends[$class][$name], $parameters);
    }
}