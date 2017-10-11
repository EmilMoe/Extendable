<?php

namespace EmilMoe\Extendable;

trait CanBeExtended
{
    /**
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        if (Extendable::hasExtension(get_called_class(), $property)) {
            return Extendable::getExtension(get_called_class(), $property, [$this]);
        }

        return parent::__get($name);
    }
    
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
