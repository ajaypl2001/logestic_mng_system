<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;
class CustomerExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Fetch all customer records
     */
    public function collection()
    {
        $query = Customer::with('user.teamLead', 'user.teamManager', 'country')
                         ->orderBy('id', 'ASC');

        if (Auth::user()->userrole != 'Admin' && Auth::user()->userrole != 'Operations') {
            $query->where('user_id', Auth::user()->id);
        }

        return $query->get();
    }

    /**
     * Set the column headings for Excel
     */
    public function headings(): array
    {
         return [
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
            'Column 14',
            'Column 15',
            'Actions'
        ];
    }

    /**
     * Map data from Customer model to Excel columns
     */
    public function map($customer): array
    {
           return [
            $customer->customer_name,
            $customer->address,
            $customer->city,
            $customer->state,
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
