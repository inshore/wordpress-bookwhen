<?php

declare (strict_types=1);
namespace _PhpScoper6af4d594edb1\InShore\Bookwhen;

use _PhpScoper6af4d594edb1\GuzzleHttp;
use _PhpScoper6af4d594edb1\GuzzleHttp\Client as GuzzleClient;
use _PhpScoper6af4d594edb1\GuzzleHttp\Psr7\Request;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\ConfigurationException;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\RestException;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Exceptions\ValidationException;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Interfaces\ClientInterface;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Validator;
use _PhpScoper6af4d594edb1\Monolog\Level;
use _PhpScoper6af4d594edb1\Monolog\Logger;
use _PhpScoper6af4d594edb1\Monolog\Handler\StreamHandler;
use _PhpScoper6af4d594edb1\Psr\Http\Message\ResponseInterface;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Resources\Attachments;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Resources\ClassPasses;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Resources\Events;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Resources\Locations;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Resources\Tickets;
/**
 * Class Client
 *
 * The main class for API consumption
 *
 * @package inshore\bookwhen
 * @todo comments
 * @todo externalise config
 * @todo fix token
 */
class Client implements ClientInterface
{
    /**
     * {@inheritDoc}
     * @see \InShore\Bookwhen\Interfaces\ClientInterface::__construct()
     * @todo sanity check the log level passed in an exception if wrong.
     * @todo handle guzzle error
     */
    public function __construct(private $transporter)
    {
    }
    /**
     *
     */
    public function attachments() : Attachments
    {
        return new Attachments($this->transporter);
    }
    /**
     */
    public function classPasses() : ClassPasses
    {
        return new ClassPasses($this->transporter);
    }
    /*
     *
     */
    public function events() : Events
    {
        return new Events($this->transporter);
    }
    /**
     */
    public function locations() : Locations
    {
        return new Locations($this->transporter);
    }
    /**
     */
    public function tickets() : Tickets
    {
        return new Tickets($this->transporter);
    }
}
// EOF!
