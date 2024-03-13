<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['date_of_birth'];
    protected $fillable=['name','email','date_of_birth','image'];

    public function scopeActive($query){

        $query->where('status',1);

    }

    public function getDateOfBirthToShowAttribute(){
        return date('d-M-Y',strtotime($this->date_of_birth));
    }

    public function getShowStatusAttribute(){
        $status=$this->status;
        if($status == 1) return "Active"; 
        else return "Inactive";
    }


    protected $append=['date_of_birth_to_show','show_status'];
    
}
