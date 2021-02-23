<?php

namespace App\Http\Livewire;

use App\Models\DetailImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmployeeWorkDetailManage extends Component
{
    use WithFileUploads;
    use FileNameable;

    public $workDetail;

    public $details;
    public $tenantNotes;
    public $startdate;

    public $images = [];

    protected $rules = [
        'details' => 'required',
        'tenantNotes' => 'required',
        'startdate' => 'date',
        'images.*' => 'image|max:8000'
    ];

    public function mount($workDetail)
    {
        $this->details = $workDetail->details;
        $this->tenantNotes = $workDetail->tenant_notes;
        $this->startdate = $workDetail->start_date ? $this->mysqlToViewDateConversion($workDetail->start_date) : NULL;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     *  Toggle complete
     */
    public function toggleEndDate()
    {
        if ($this->workDetail->end_date) {
            $this->workDetail->update(['end_date' => NULL]);
        } else {
            if ($this->workDetail->start_date) {
                $this->workDetail->update(['end_date' => now()]);
            } else {
                session()->flash('error', 'Please select a start date before completing');
            }
        }
    }

    /**
     *  Edit work detail
     */
    public function editWorkDetail()
    {
        $this->validate([
            'details' => 'required',
            'tenantNotes' => 'required',
            'startdate' => 'date',
        ]);

        $this->workDetail->update([
            'details' => $this->details,
            'tenant_notes' => $this->tenantNotes,
            'start_date' => $this->startdate,
        ]);

        session()->flash('success', 'Work detail updated');
    }

    /**
     *  Store Image
     */
    public function storeImage()
    {
        $customMessage = ['image' => 'Only images allowed'];

        $this->validate([
            'images.*' => 'image|max:6000'
        ], $customMessage);

        foreach ($this->images as $key => $image) {
            $this->images[$key] = $image->storeAs('work-details', $this->fileName($this->images[$key]), 'public');
        }

        if ($this->images) {
            foreach ($this->images as $image) {
                DetailImage::create([
                    'work_detail_id' => $this->workDetail->id,
                    'image' => $image,
                ]);
            }
            $this->images = [];
        } else {
            session()->flash('error', 'You must select at least one photo');
        }
    }

    /**
     *  Delete Image
     */
    public function deleteImage($imageID)
    {
        $currentImage = DetailImage::find($imageID);

        Storage::disk('public')->delete($currentImage->image);
        
        $currentImage->delete();
    }

    /**
     *  Method to format the date from the database into a format for the form
     */
    private function mysqlToViewDateConversion($date) 
    {
        return Carbon::parse($date)->toDateString();
    }

    public function render()
    {
        return view('livewire.employee-work-detail-manage', [

            'savedFiles' => $this->workDetail->detailImages()
                ->orderBy('created_at', 'desc')->paginate(12),

        ]);
    }
}
