<?php

namespace _PhpScoper6af4d594edb1;

/**
 * @since 8.1
 */
final class ReflectionFiber
{
    public function __construct(\Fiber $fiber)
    {
    }
    public function getFiber() : \Fiber
    {
    }
    public function getExecutingFile() : string
    {
    }
    public function getExecutingLine() : int
    {
    }
    public function getCallable() : callable
    {
    }
    public function getTrace(int $options = \DEBUG_BACKTRACE_PROVIDE_OBJECT) : array
    {
    }
}
/**
 * @since 8.1
 */
\class_alias('_PhpScoper6af4d594edb1\\ReflectionFiber', 'ReflectionFiber', \false);
