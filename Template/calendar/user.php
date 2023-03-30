<?= $this->form->hidden('calendar_view',array('calendar_view' => $view)) ?>
<?= $this->form->hidden('calendar_firstday',array('calendar_firstday' => $firstDay)) ?>
<?= $this->calendar->render(
    $this->url->href('CalendarController', 'userEvents', array('user_id' => $user['id'], 'plugin' => 'Calendar')),
    $this->url->href('CalendarController', 'save', array('plugin' => 'Calendar'))
) ?>
