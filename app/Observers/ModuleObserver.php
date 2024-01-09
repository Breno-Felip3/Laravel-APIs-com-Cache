<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Module;

class ModuleObserver
{
    /**
     * Handle the module "creating" event.
     */
    public function creating(module $module)
    {
        $module->uuid = (string)Str::uuid();
    }

}
