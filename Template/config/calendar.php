<div class="page-header">
    <h2><?= t('Calendar settings') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('ConfigController', 'save', array('plugin' => 'Calendar')) ?>" autocomplete="off">

    <?= $this->form->csrf() ?>

    <?= $this->form->label('Project calendar based on', 'calendar_project_tasks') ?>
    <?= $this->form->select('calendar_project_tasks', array(
        'date_started'  => t('Start date'),
        'date_creation' => t('Creation date'),
    ), $values) ?>

    <?= $this->form->label('User calendar based on', 'calendar_user_tasks') ?>
    <?= $this->form->select('calendar_user_tasks', array(
        'date_started'  => t('Start date'),
        'date_creation' => t('Creation date'),
    ), $values) ?>

    <fieldset>
        <legend><?= t('Display options') ?></legend>

        <?= $this->form->label(t('Preferred calendar view'), 'calendar_view') ?>
        <?= $this->form->select('calendar_view', array(
            'month'       => t('Month'),
            'agendaWeek'  => t('Week'),
            'agendaDay'   => t('Day'),
        ), $values) ?>

        <?= $this->form->label(t('First day of week'), 'calendar_firstday') ?>
        <?= $this->form->select('calendar_firstday', array(
            '0' => t('Sunday'),
            '1' => t('Monday'),
        ), $values) ?>

        <?php $checkbox = 'Calendar:config/checkbox' ?>

        <?= $this->render($checkbox, array(
            'label'   => t('Display the “all-day” slot'),
            'name'    => 'calendar_alldayslot',
            'default' => CALENDAR_ALLDAYSLOT,
            'values'  => $values,
        )) ?>

        <?= $this->render($checkbox, array(
            'label'   => t('Display long events as "all-day"'),
            'name'    => 'calendar_allday',
            'default' => CALENDAR_ALLDAY,
            'values'  => $values,
        )) ?>

        <?= $this->render($checkbox, array(
            'label'   => t('Display Week Numbers'),
            'name'    => 'calendar_weeknums',
            'default' => CALENDAR_WEEKNUMS,
            'values'  => $values,
        )) ?>

        <?= $this->render($checkbox, array(
            'label'   => t('Display Now Indicator'),
            'name'    => 'calendar_nowindic',
            'default' => CALENDAR_NOWINDIC,
            'values'  => $values,
        )) ?>

        <?= $this->render($checkbox, array(
            'label'   => t('Moving and resizing of events/tasks'),
            'name'    => 'calendar_dragging',
            'default' => CALENDAR_DRAGGING,
            'values'  => $values,
        )) ?>

        <?= $this->render($checkbox, array(
            'label'   => t('Add Date Nav Links'),
            'name'    => 'calendar_navlinks',
            'default' => CALENDAR_NAVLINKS,
            'values'  => $values,
        )) ?>
        <p class="form-help"><?= t('To navigate, day- and week names/numbers are clickable.') ?></p>

        <?= $this->form->label(t('Time-Axis Settings'), 'calendar_mintime') ?>
        <?= $this->form->text('calendar_mintime', $values, array(), array(), 'cal-tp') ?>
        <span>to</span>
        <?= $this->form->text('calendar_maxtime', $values, array(), array(), 'cal-tp') ?>

        <?= $this->form->label(t('Business Hour Settings'), 'calendar_view') ?>
        <?= $this->form->text('calendar_mintimebusi', $values, array(), array(), 'cal-tp') ?>
        <span>to</span>
        <?= $this->form->text('calendar_maxtimebusi', $values, array(), array(), 'cal-tp') ?>

    </fieldset>
    <div class="form-actions">
        <button type="submit" class="btn btn-blue"><?= t('Save') ?></button>
    </div>
</form>
