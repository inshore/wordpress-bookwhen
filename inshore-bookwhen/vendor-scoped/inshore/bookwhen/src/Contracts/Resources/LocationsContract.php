<?php

namespace _PhpScoper6af4d594edb1\InShore\Bookwhen\Contracts\Resources;

use _PhpScoper6af4d594edb1\InShore\Bookwhen\Responses\Locations\ListResponse;
use _PhpScoper6af4d594edb1\InShore\Bookwhen\Responses\Locations\RetrieveResponse;
interface LocationsContract
{
    /**
     * Returns a list of events that belong to the user's organization.
     *
     * @see https://
     */
    public function list(array $parameters) : ListResponse;
    /**
     * Returns information about a specific event.
     *
     * @see https://
     */
    public function retrieve(string $eventId) : RetrieveResponse;
}
