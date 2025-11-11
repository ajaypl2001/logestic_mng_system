<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;
class CustomerExport implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;
    public function collection()
    {
        $query = Customer::with('user.teamLead', 'user.teamManager', 'country', 'stateInfo', 'billingStateInfo')->orderBy('id', 'ASC');

        if (Auth::user()->userrole != 'Admin' && Auth::user()->userrole != 'Operations') {
            $query->where('user_id', Auth::user()->id);
        }

        return $query->get();
    }

    public function headings(): array
    {
         return [
            'Sno',
            'Customer Name',
            'Address',
            'City',
            'State',
            'Zip Code',
            'Telephone',
            'Account Status',
            'Approval Status',
            'Created Date',
            'Added By',
            'Team Lead',
            'Team Manager',
            'Credit Limit',
            'Total Credit Limit Used',
            'Remaining Credit Limit',
        ];
    }

    public function map($customer): array
    {
        $this->rowNumber++;
           return [
            $this->rowNumber,
            $customer->customer_name,
            $customer->address,
            $customer->city,
            $customer->stateInfo->state ?? 'N/A',
            $customer->zip_code,
            $customer->telephone,
            $customer->acc_sts == 1 ? 'Active' : 'Deactive',
            $customer->approve_sts ?? 'Pending',
            $customer->created_at ? $customer->created_at->format('Y-m-d') : 'N/A',
            $customer->user ? $customer->user->name : 'N/A',
            $customer->user && $customer->user->teamLead ? $customer->user->teamLead->name : 'N/A',
            $customer->user && $customer->user->teamManager ? $customer->user->teamManager->name : 'N/A',
            $customer->credit_limit,
            'N/A',
            'N/A'
        ];
    }
}
