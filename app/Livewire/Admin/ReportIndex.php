<?php

namespace App\Livewire\Admin;

use App\Models\Report;
use Livewire\Component;
use Livewire\WithPagination;

class ReportIndex extends Component
{
    use WithPagination;

    public $activeTab = 'reports';
    public $filterStatus = 'pending';
    public $filterCompanyStatus = 'pending';

    public function dismissReport($reportId)
    {
        $report = Report::findOrFail($reportId);
        $report->update(['status' => 'dismissed']);
        $this->dispatch('notify', ['message' => 'Laporan diabaikan.', 'type' => 'info']);
    }

    public function deleteReportedContent($reportId)
    {
        $report = Report::findOrFail($reportId);
        $content = $report->reportable;

        if ($content) {
            $content->delete();
            $report->update(['status' => 'reviewed']);
            $this->dispatch('notify', ['message' => 'Konten berhasil dihapus dan laporan ditandai selesai.', 'type' => 'success']);
        } else {
            $report->update(['status' => 'reviewed']);
            $this->dispatch('notify', ['message' => 'Konten sudah tidak ada. Laporan ditutup.', 'type' => 'warning']);
        }
    }

    public function approveCompany($companyId)
    {
        $company = \App\Models\Company::findOrFail($companyId);
        $company->update(['status' => 'approved', 'is_verified' => true]);
        $this->dispatch('notify', ['message' => 'Perusahaan telah disetujui.', 'type' => 'success']);
    }

    public function rejectCompany($companyId)
    {
        $company = \App\Models\Company::findOrFail($companyId);
        $company->update(['status' => 'rejected']);
        $this->dispatch('notify', ['message' => 'Perusahaan ditolak.', 'type' => 'warning']);
    }

    public function render()
    {
        $reports = Report::with(['user', 'reportable'])
            ->when($this->filterStatus, function($query) {
                $query->where('status', $this->filterStatus);
            })
            ->latest()
            ->paginate(10, ['*'], 'reportsPage');

        $pendingCompanies = \App\Models\Company::with('user')
            ->when($this->filterCompanyStatus, function($query) {
                $query->where('status', $this->filterCompanyStatus);
            })
            ->latest()
            ->paginate(10, ['*'], 'companiesPage');

        return view('livewire.admin.report-index', [
            'reports' => $reports,
            'pendingCompanies' => $pendingCompanies
        ])->layout('layouts.app');
    }
}
