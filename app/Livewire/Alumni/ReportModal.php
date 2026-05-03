<?php

namespace App\Livewire\Alumni;

use App\Models\Report;
use Livewire\Component;

class ReportModal extends Component
{
    public $reportableId;
    public $reportableType;
    public $reason = '';
    public $isOpen = false;

    protected $listeners = ['openReportModal' => 'open'];

    public function open($id, $type)
    {
        $this->reportableId = $id;
        $this->reportableType = $type;
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
        $this->reset(['reason', 'reportableId', 'reportableType']);
    }

    public function submit()
    {
        $this->validate([
            'reason' => 'required|min:5',
        ]);

        Report::create([
            'user_id' => auth()->id(),
            'reportable_id' => $this->reportableId,
            'reportable_type' => $this->reportableType,
            'reason' => $this->reason,
            'status' => 'pending',
        ]);

        $this->close();
        $this->dispatch('notify', ['message' => 'Laporan Anda telah dikirim. Terima kasih.', 'type' => 'success']);
    }

    public function render()
    {
        return view('livewire.alumni.report-modal');
    }
}
