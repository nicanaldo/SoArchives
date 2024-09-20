<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'EventID';

    protected $fillable = [
        'EventImage',
        'EventName',
        'EventDescription',
        'Date',
        'StartTime',
        'EndTime',
        'Location',
        'Link',
        'Status',
        'UserID',
    ];

    protected $foreignKey = ['Status', 'UserID'];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
