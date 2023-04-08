<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;


class Company extends Model
{
    use HasFactory;
    protected $fillable = ['companyName', 'financialStatus', 'marketCategory', 'roundLotSize', 'securityName', 'symbol', 'testIssue'];

    public $timestamps = true;

}
