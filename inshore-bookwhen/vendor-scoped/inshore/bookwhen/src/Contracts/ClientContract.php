<?php

namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\Contracts;

use _PhpScoper6af4d594edb1\InShore\Bookwhen\Contracts\Resources\AttachmentsContract;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Contracts\Resources\ClassPassesContract;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Contracts\Resources\EventsContract;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Contracts\Resources\LocationsContract;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Contracts\Resources\TicketsContract;
interface ClientContract
{
    /**
     * @todo ref the api documents
     */
    public function attachments() : AttachmentsContract;
    /**
     * @todo ref the api documents
     */
    public function classPasses() : ClassPassesContract;
    /**
     * @todo ref the api documents
     */
    public function events() : EventsContract;
    /**
     * @todo ref the api documents
     */
    public function locations() : LocationsContract;
    /**
     * @todo ref the api documents
     */
    public function tickets() : TicketsContract;
}
