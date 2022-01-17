<?php

namespace Squirrel\Page\Models;

use App\Models\Base;
use App\Models\Employee;
use App\Traits\CastTrait;
use App\Traits\LogActivityTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Page extends Base {
    use SoftDeletes, CastTrait, LogActivityTrait;

    protected $table = 'pages';

    protected $fillable = ['name', 'title', 'excerpt', 'body', 'owner_id'];

    public function owner()
    {
        return $this->belongsTo(Employee::class, 'owner_id');
    }
}
