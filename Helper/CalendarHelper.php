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
    public function render($checkUrl, $saveUrl)
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
        'allDaySlot'    => $this->configModel->get('calendar_allday', '1'),
        'firstDay'      => $this->configModel->get('calendar_firstday', '0'),
        'navLinks'      => $this->configModel->get('calendar_navlinks', '1'),
        'nowIndicator'  => $this->configModel->get('calendar_nowindic', '1'),
        'timeFormat'    => $this->dateParser->getUserTimeFormat(),
        'view'          => $this->configModel->get('calendar_view', 'month'),
        'weekNumbers'   => $this->configModel->get('calendar_weeknums', '1'),
      );
    }
}
