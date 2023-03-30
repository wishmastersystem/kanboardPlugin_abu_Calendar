<?= $this->form->hidden('calendar_view',array('calendar_view' => $view)) ?>
<?= $this->form->hidden('calendar_firstday',array('calendar_firstday' => $firstDay)) ?>
<?= $this->projectHeader->render($project, 'CalendarController', 'project', false, 'Calendar') ?>

<?= $this->calendar->render(
    $this->url->href('CalendarController', 'projectEvents', array('project_id' => $project['id'], 'plugin' => 'Calendar')),
    $this->url->href('CalendarController', 'save', array('project_id' => $project['id'], 'plugin' => 'Calendar'))
) ?>
