<?php

namespace App\Exports;

use App\Models\Shipper;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SipperExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        $query = Shipper::with('user.teamLead', 'user.teamManager')->where('acc_sts', 1)->orderBy('id', 'ASC');

        if (Auth::user()->userrole != 'Admin' && Auth::user()->userrole != 'Operations') {
            $query->where('user_id', Auth::user()->id);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Address',
            'Contact No.',
            'Account Status',
            'Created Date',
            'User',
            'Team Lead',
            'Team Manager',
        ];
    }

    public function map($shiper): array
    {
        return [
            $shiper->name,
            $shiper->addressl_1,
            $shiper->tele_phone,
            $shiper->acc_sts == 1 ? 'Active' : 'Deactive',
            optional($shiper->created_at)->format('Y-m-d'),
            $shiper->user ? $shiper->user->name : 'N/A',
            $shiper->user && $shiper->user->teamLead ? $shiper->user->teamLead->name : 'N/A',
            $shiper->user && $shiper->user->teamManager ? $shiper->user->teamManager->name : 'N/A',
        ];
    }
}
