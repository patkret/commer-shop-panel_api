<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Log extends Model
{
    protected $fillable = ['user_id', 'action_id', 'module_id', 'item_name'];

    public function module()
    {

        return $this->belongsTo(PanelModule::class);
    }

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function action()
    {

        return $this->belongsTo(PanelAction::class);
    }

    public static function createNew($module_id, $item_name, $action_name)
    {
        $actions = [
            'add' => 1,
            'edit' => 2,
            'duplicate' => 3,
            'delete' => 4,
            'massDelete' => 5,
            'editVendor' => 6,
            'editVisibility' => 7,
            'editStock' => 8,
            'editMainCategory' => 9,
            'editPrice' => 10
        ];

        $log = static::create([
            'user_id' => Auth::id(),
            'module_id' => $module_id,
            'item_name' => $item_name,
            'action_id' => $actions[$action_name],
        ]);

        return $log;

    }
}
