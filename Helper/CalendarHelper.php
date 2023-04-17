<?php

namespace Kanboard\Plugin\Calendar\Helper;

use Kanboard\Core\Base;

/**
 * Calendar Helper
 *
 * @package Kanboard\Plugin\Calendar\Helper
 * @author  Frederic Guillot
 */
class CalendarHelper extends Base
{
    /**
     * Render calendar component
     *
     * @param  string $checkUrl
     * @param  string $saveUrl
     * @return string
     */
    public function render($checkUrl, $saveUrl): string
    {
        $params = array(
            'checkUrl' => $checkUrl,
            'saveUrl' => $saveUrl,
        );

        return '<div class="js-calendar" data-params=\''.json_encode($params, JSON_HEX_APOS).'\'></div>';
    }

    /**
     * Collect params for the calendar
     *
     * @return array
     */
    public function getParams(): array
    {
      return array(
        'allDaySlot'    => $this->configModel->get('calendar_alldayslot', CALENDAR_ALLDAYSLOT),
        'firstDay'      => $this->configModel->get('calendar_firstday', CALENDAR_FIRSTDAY),
        'navLinks'      => $this->configModel->get('calendar_navlinks', CALENDAR_NAVLINKS),
        'nowIndicator'  => $this->configModel->get('calendar_nowindic', CALENDAR_NOWINDIC),
        'timeFormat'    => $this->dateParser->getUserTimeFormat(),
        'view'          => $this->configModel->get('calendar_view', CALENDAR_VIEW),
        'weekNumbers'   => $this->configModel->get('calendar_weeknums', CALENDAR_WEEKNUMS),
      );
    }
}
