<?php

namespace App\Exports;

use App\Models\Mc;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class McExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        $query = Mc::with(['user.teamLead', 'user.teamManager'])->orderBy('id', 'ASC');

        if (Auth::user()->userrole != 'Admin' && Auth::user()->userrole != 'Operations') {
            $query->where('user_id', Auth::user()->id);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'S.No.',
            'Carrier Name',
            'Commodity Value',
            'Commodity Type',
            'Equipment Type',
            'Approval Status',
            'Date Added',
            'Added By User',
            'Team Lead',
            'Team Manager',
        ];
    }

    public function map($mc_dataa): array
    {
        static $count = 0;
        $count++;

        return [
            $count,
            $mc_dataa->carrier_name,
            $mc_dataa->commodity_value,
            $mc_dataa->commodity_type,
            $mc_dataa->equ_type,
            $mc_dataa->approve_sts ?? 'Pending',
            $mc_dataa->created_datetime,
            $mc_dataa->user ? $mc_dataa->user->name : 'N/A',
            $mc_dataa->user && $mc_dataa->user->teamLead ? $mc_dataa->user->teamLead->name : 'N/A',
            $mc_dataa->user && $mc_dataa->user->teamManager ? $mc_dataa->user->teamManager->name : 'N/A',
        ];
    }
}
