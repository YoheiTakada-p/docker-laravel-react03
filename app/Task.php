<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    //Status replace by text and add status_label and status_color
    const STATUS = [
        1 => ['label' => 'HAVE', 'class' => 'label-danger'],
        2 => ['label' => 'DOING', 'class' => 'label-info'],
        3 => ['label' => 'DONE', 'class' => ''],
    ];

    public function getStatusLabelAttribute()
    {
        $status = $this->attributes['status'];

        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    public function getStatusClassAttribute()
    {
        $status = $this->attributes['status'];

        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['class'];
    }

    //formatted dur_date
    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])->format('Y/m/d');
    }
}
