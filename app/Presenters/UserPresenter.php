<?php

namespace Vanguard\Presenters;

use Vanguard\Support\Enum\UserStatus;
use Illuminate\Support\Str;
use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    public function name()
    {
        if(! $this->entity->employee)
        {
            
        }else
        {
        return sprintf("%s %s", $this->entity->employee->first_name, $this->entity->employee->last_name);
        }
    }
    
    public function polistion()
    {
        if(! $this->entity->employee)
        {
            
        }else
        {
            return sprintf("%s ", $this->entity->employee->employeepositions->label);
        
        }
    }

    public function nameOrEmail()
    {
        if(! $this->entity->employee)
        {
            
        }else
        {
        return trim($this->name()) ?: $this->entity->employee->email;
        }
    }

    public function avatar()
    {
        if (! $this->entity->employee) {
            return url('assets/img/profile.png');
        }

        return Str::contains($this->entity->employee->eid, ['http', 'gravatar'])
            ? $this->entity->avatar
            : url("/storage/app/employee_photos/{$this->entity->employee->eid}.png");
    }

    public function birthday()
    {
        return $this->entity->birthday
            ? $this->entity->birthday->format(config('app.date_format'))
            : 'N/A';
    }

    public function fullAddress()
    {
        $address = '';
        $user = $this->entity;

        if ($user->address) {
            $address .= $user->address;
        }

        if ($user->country_id) {
            $address .= $user->address ? ", {$user->country->name}" : $user->country->name;
        }

        return $address ?: 'N/A';
    }

    public function lastLogin()
    {
        return $this->entity->last_login
            ? $this->entity->last_login->diffForHumans()
            : 'N/A';
    }

    /**
     * Determine css class used for status labels
     * inside the users table by checking user status.
     *
     * @return string
     */
    public function labelClass()
    {
        switch ($this->entity->status) {
            case UserStatus::ACTIVE:
                $class = 'success';
                break;

            case UserStatus::BANNED:
                $class = 'danger';
                break;

            default:
                $class = 'warning';
        }

        return $class;
    }
}
