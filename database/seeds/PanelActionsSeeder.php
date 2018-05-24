<?php

use Illuminate\Database\Seeder;
use App\PanelAction;

class PanelActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PanelAction::create([
           'name' => 'dodany(a)'
        ]);
        PanelAction::create([
           'name' => 'edytowany(a)'
        ]);
        PanelAction::create([
           'name' => 'zduplikowany(a)'
        ]);
        PanelAction::create([
           'name' => 'usunięty(a)'
        ]);
        PanelAction::create([
           'name' => 'usunięty - w akcji masowej'
        ]);
        PanelAction::create([
           'name' => 'edytowany- zmieniono producenta w akcji masowej'
        ]);
        PanelAction::create([
           'name' => 'edytowany- zmieniono widoczność w akcji masowej'
        ]);
        PanelAction::create([
           'name' => 'edytowany- zmieniono stan magazynowy w akcji masowej'
        ]);
        PanelAction::create([
           'name' => 'edytowany- zmieniono kategorię główną w akcji masowej'
        ]);
        PanelAction::create([
           'name' => 'edytowany- zmieniono cenę w akcji masowej'
        ]);

    }
}
