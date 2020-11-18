<?php

namespace App\Services;

use App\Models\Manager;

class ManagerService extends BaseService
{
    /**
     * 
     * Init the class and inform the model
     * 
     * @param  \App\Models\Manager  $manager
     */
    public function __construct(Manager $manager)
    {
        parent::__construct($manager);
    }
}
