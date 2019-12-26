<?= $form->field($model, \common\models\Project::RELATION_PROJECT_USERS)
    ->widget(\unclead\multipleinput\MultipleInput::class, [
        // https://github.com/unclead/yii2-multiple-input
        'id' => 'project-users-widget',
        'max' => 10,
        'min' => 0,
        'addButtonPosition' => \unclead\multipleinput\MultipleInput::POS_HEADER,
        'columns' => [
            [
                'name' => 'id',
                'type' => 'hiddenInput',
            ],
            [
                'name' => 'project_id',
                'type' => 'hiddenInput',
                'defaultValue' => $model->project_id,
            ],
            [
                'name' => 'user_id',
                'type' => 'dropDownList',
                'title' => 'User',
                'items' => $users,
            ],
            [
                'name' => 'role',
                'type' => 'dropDownList',
                'title' => 'Role',
                'items' => \common\models\ProjectUser::ROLES_LABELS,
            ],
        ],
    ]) ?>