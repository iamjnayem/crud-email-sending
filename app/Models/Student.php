<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'age', 'department_id'];
    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class);
    }
}
