<?php

namespace Kanboard\Plugin\Calendar\Helper;

use Kanboard\Core\Base;
use Kanboard\Core\DateParser;

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
        'view'        => $this->configModel->get('calendar_view', 'month'),
        'firstDay'    => $this->configModel->get('calendar_firstday', '0'),
        'timeFormat'  => $this->configModel->get('application_time_format', DateParser::TIME_FORMAT) == DateParser::TIME_FORMAT ? 'HH:mm' : '',
      );
    }
}
