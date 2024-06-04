<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeCard extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];

    public  $personId;
    public  $personName;
    public  $postName;
    public $workingStructure;
    public  $personalPhone;
    public  $officePhone;
    public  $cabinetNumber;
    public  $email;

//    function __construct($personId, $personName, $postName,$workingStructure, $personalPhone, $officePhone, $cabinetNumber, $email)
//    {
//        $this->personId=$personId;
//        $this->personName=$personName;
//        $this->postName=$postName;
//        $this->workingStructure=$workingStructure;
//        $this->personalPhone=$personalPhone;
//        $this->officePhone=$officePhone;
//        $this->cabinetNumber=$cabinetNumber;
//        $this->email=$email;
//    }

}
