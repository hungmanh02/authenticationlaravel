<?php

use App\Models\Doctors;

function isDoctorActive($email){
    $count=Doctors::where('email',$email)->where('is_active',1)->count();
    if($count>0){
        return true;
    }
    return false;
}
