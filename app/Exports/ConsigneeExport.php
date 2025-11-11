<?php

namespace App\Exports;

use App\Models\Consignee;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConsigneeExport implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0; // for S.No

    public function collection()
    {
        $query = Consignee::with('user.teamLead', 'user.teamManager', 'country')
            ->where('acc_sts', 1)
            ->orderBy('id', 'ASC');

        if (Auth::user()->userrole != 'Admin' && Auth::user()->userrole != 'Operations') {
            $query->where('user_id', Auth::user()->id);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Name',
            'Address',
            'Contact',
            'Status',
            'Date Added',
            'Added By User',
            'Team Lead',
            'Team Manager',
        ];
    }

    public function map($Consignee): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $Consignee->name,
            $Consignee->addressl_1,
            $Consignee->tele_phone,
            $Consignee->acc_sts == 1 ? 'Active' : 'Deactive',
            $Consignee->created_at ? $Consignee->created_at->format('Y-m-d') : '',
            $Consignee->user ? $Consignee->user->name : 'N/A',
            ($Consignee->user && $Consignee->user->teamLead) ? $Consignee->user->teamLead->name : 'N/A',
            ($Consignee->user && $Consignee->user->teamManager) ? $Consignee->user->teamManager->name : 'N/A',
        ];
    }
}
