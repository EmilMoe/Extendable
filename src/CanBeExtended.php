<?php

namespace EmilMoe\Extendable;

trait CanBeExtended
{
    /**
     * @param $method
     * @param array $parameters
     * @return mixed
     */
    public function __call($method, $parameters = [])
    {
        if (Extendable::hasExtension(get_called_class(), $method))
            return Extendable::getExtension(get_called_class(), $method, array_merge([$this], $parameters));

        return parent::__call($method, $parameters);
    }

    /**
     * @param $method
     * @param array $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters = [])
    {
        if (Extendable::hasExtension(get_called_class(), $method))
            return Extendable::getExtension(get_called_class(), $method, $parameters);

        return parent::__callStatic($method, $parameters);
    }
}