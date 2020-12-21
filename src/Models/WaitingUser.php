<?php

namespace ArtisanBuild\WaitingList\Models;

use Illuminate\Database\Eloquent\Model;

class WaitingUser extends Model
{
    protected $guarded = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('waiting_list.table', 'waiting_users'));

        if (!is_null(config('waiting_list.connection'))) {
            $this->setConnection(config('waiting_list.connection'));
        }
    }
}
