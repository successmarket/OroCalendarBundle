<?php

namespace Oro\Bundle\CalendarBundle\Tests\Behat\Element;

use Oro\Bundle\TestFrameworkBundle\Behat\Element\Element;

class Calendar extends Element
{
    use EventColors {
        getAvailableColors as private getColors;
    }

    /**
     * Find event link on calendar grid
     *
     * @param string $title
     * @return CalendarEvent
     */
    public function getCalendarEvent($title)
    {
        $this->pressButton('today');

        $calendarEvent = $this->findElementContains('Calendar Event', $title);
        self::assertNotNull($calendarEvent, "Event $title not found in calendar grid");

        return $calendarEvent;
    }

    public function getAvailableColors()
    {
        $this->find('css', '.connection-item')->mouseOver();
        $this->find('css', ".context-menu-button")->click();

        return $this->getColors();
    }
}
