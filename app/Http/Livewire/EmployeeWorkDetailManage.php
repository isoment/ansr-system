<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EmployeeWorkDetailManage extends Component
{
    public $workDetail;

    public function render()
    {
        return view('livewire.employee-work-detail-manage');
    }
}
