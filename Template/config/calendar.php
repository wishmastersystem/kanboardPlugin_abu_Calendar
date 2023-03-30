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

    <div class="form-actions">
        <button type="submit" class="btn btn-blue"><?= t('Save') ?></button>
    </div>
</form>
