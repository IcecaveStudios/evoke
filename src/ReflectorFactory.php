<?php
namespace Icecave\Evoke;

use Closure;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;

class ReflectorFactory
{
    /**
     * Get the appropriate reflector for a callable.
     *
     * @param callable $callable
     *
     * @return ReflectionFunctionAbstract
     */
    public function create($callable)
    {
        list($class, $name) = $this->normalize($callable);

        if (null === $class) {
            return new ReflectionFunction($name);
        }

        return new ReflectionMethod($class, $name);
    }

    /**
     * Normalize a callable into 2-tuple form.
     *
     * @param callable $callable
     *
     * @return tuple<string|null, string|Closure>
     */
    public function normalize($callable)
    {
        if ($callable instanceof Closure) {
            $class = null;
            $func = $callable;
        } elseif (is_object($callable)) {
            $class = get_class($callable);
            $func = '__invoke';
        } elseif (is_array($callable)) {
            list($class, $func) = $callable;
            if (is_object($class)) {
                $class = get_class($class);
            }
        } elseif (strpos($callable, '::') !== false) {
            list($class, $func) = explode('::', $callable, 2);
        } else {
            $class = null;
            $func = $callable;
        }

        return array($class, $func);
    }
}
