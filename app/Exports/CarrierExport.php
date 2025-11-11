<?php

namespace App\Exports;

use App\Models\Carrier;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CarrierExport implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0; 

    public function collection()
    {
        $query = Carrier::with('user.teamLead', 'user.teamManager')->orderBy('id', 'ASC');

        if (Auth::user()->userrole != 'Admin' && Auth::user()->userrole != 'Operations') {
            $query->where('user_id', Auth::user()->id);
        }

        return $query->get();
    }

    public function map($carrier): array
    {
        $this->rowNumber++; 

        return [
            $this->rowNumber,
            $carrier->carrier_name,
            $carrier->mc_ff_hidden,
            $carrier->load_type,
            $carrier->address,
            $carrier->city,
            $carrier->state,
            $carrier->zip_code,
            $carrier->telephone,
            $carrier->acc_sts == 1 ? 'Active' : 'Deactive',
            $carrier->approve_sts ?? 'Pending',
            $carrier->created_at ? $carrier->created_at->format('Y-m-d H:i') : '',
            $carrier->user ? $carrier->user->name : 'N/A',
            $carrier->user && $carrier->user->teamLead ? $carrier->user->teamLead->name : 'N/A',
            $carrier->user && $carrier->user->teamManager ? $carrier->user->teamManager->name : 'N/A',
        ];
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Carrier Name',
            'MC/FF No',
            'Load Type',
            'Address',
            'City',
            'State',
            'Zip',
            'Telephone',
            'Status',
            'Approval Status',
            'Date Added',
            'Added By User',
            'Team Lead',
            'Team Manager',
        ];
    }
}
