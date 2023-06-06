<?php

use App\Models\Doctors;

function isDoctorActive($email){
    $count=Doctors::where('email',$email)->where('is_active',1)->count();
    if($count>0){
        return true;
    }
    return false;
}
function isRoleArrActiveBox($dataArr,$moduleName,$role='view'){
    if(!empty($dataArr)){
        $roleArr=$dataArr[$moduleName];
        if(!empty($roleArr) && in_array($role,$roleArr)){
            return true;
        }
    }
    return false;
}
