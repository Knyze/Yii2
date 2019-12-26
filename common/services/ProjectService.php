<?php

namespace common\services;


use common\models\Project;
use common\models\User;
use common\models\ProjectUser;
use yii\base\Event;
use yii\base\Component;

class AssignRoleEvent extends Event
{
    public $project;
    public $user;
    public $role;
    
    public function dump()
    {
        return ['project' => $this->project-project_id, 'user' => $this->user->id, 'role' => $this->role];
    }
}

class ProjectService extends Component
{
    const EVENT_ASSIGN_ROLE = 'event_assign_role';
    
    public function assignRole(Project $project, User $user, $role)
    {
        $event = new AssignRoleEvent();
        $event->project = $project;
        $event->user = $user;
        $event->role = $role;
        $this->trigger(self::EVENT_ASSIGN_ROLE, $event);
    }
    
    public function getRoles(Project $project, User $user)
    {
        return $project->getProjectUsers()->byUser($user->id)->select('role')->column();
    }
    
    public function hasRole(Project $project, User $user, $role = null)
    {
        $roles = $this->getRoles($project, $user);
        
        if ($role !== null) {
            return in_array($role, $roles);
        } else {
            return $roles !== [];
        }
        
    }
    
    public function hasRoleManager(User $user)
    {
        $projects = Project::find()->byUser($user, ProjectUser::ROLE_MANAGER)->onlyActive();
        return $projects !== [];
    }
    
}