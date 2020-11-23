<?php

namespace App\Services;

use App\Models\Complaint;

class ComplaintService extends BaseService
{
    /**
     * 
     * Init the class and inform the model
     * 
     * @param  \App\Models\Complaint  $complaint
     */
    public function __construct(Complaint $complaint)
    {
        parent::__construct($complaint);
    }
}
