<?php
namespace App\Observers;

use App\Notifications\NewAbsence;
use App\Absence;
use App\User;
class AbsenceObserver
{
    public function created(Absence $absence)
    {
        $new_absence = $absence->name;
        //$new_absence->notify(new NewAbsence($absence));
        $users = User::all();

        
        foreach ($users as $user) {
            $user->notify(new NewAbsence($absence, $new_absence));
        }
        
    }
}