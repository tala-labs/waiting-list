<?php


namespace ArtisanBuild\WaitingList\Models;


use Illuminate\Database\Eloquent\Model;

class WaitingUser extends Model
{
    public function __construct()
    {
        parent::__construct();

        $this->setTable(config('waiting_list.table', 'waiting_users'));

        if (!is_null(config('waiting_list.connection'))) {
            $this->setConnection(config('waiting_list.connection'));
        }
    }
}