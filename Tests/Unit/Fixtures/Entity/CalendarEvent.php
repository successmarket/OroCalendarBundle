<?php

namespace Oro\Bundle\CalendarBundle\Tests\Unit\Fixtures\Entity;

use Oro\Bundle\CalendarBundle\Entity\CalendarEvent as BaseCalendarEvent;

class CalendarEvent extends BaseCalendarEvent
{
    /**
     * @param integer|null $id
     */
    public function __construct($id = null)
    {
        parent::__construct();
        $this->id = $id;
    }
}
