<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions;

use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\InshoreBookwhenException;
/**
 * InshoreBookwhenConfigurationException Class
 *
 * @package inshore\Bookwhen
 */
class ValidationException extends InshoreBookwhenException
{
    private $key;
    private $value;
    /**
     *
     * @param string $key
     * @param array|boolean|object|int|string $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
    /**
     *
     * @return string
     */
    public function errorMessage()
    {
        return 'Validation Error!<br/>The value "' . $this->value . '" is invalid for ' . $this->key . '.<br/>Please refer to the package documentation <a href=https://github.com/inshore/bookwhen>https://github.com/inshore/bookwhen</a> or <a href=https://api.bookwhen.com/v2>https://api.bookwhen.com/v2</a>';
    }
}
//EOF!
