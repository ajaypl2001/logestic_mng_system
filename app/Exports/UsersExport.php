<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    private $rowNumber = 0;
    public function collection()
    {
        return User::with(['teamLead', 'teamManager'])
            ->select(
                'usersite',
                'employeetype',
                'usergroup',
                'employee_code',
                'alias',
                'name',
                'email',
                'phone',
                'status',
                'created_at',
                'lead_id',
                'mang_id',
                'form_permission'
            )->where('userrole', '!=', 'Admin')
            ->get();
    }

    public function map($user): array
    {
        $this->rowNumber++;
       $permissions = $user->form_permission;
            if (is_string($permissions)) {
                $permissions = json_decode($permissions, true);
            }

            $permissionsString = is_array($permissions)
                ? implode(', ', $permissions)
                : '—';
        return [
            $this->rowNumber,
            $user->usersite,
            $user->employeetype,
            $user->usergroup,
            $user->employee_code,
            $user->alias,
            $user->name,
            $user->email,
            $user->phone,
            $user->status == 1 ? 'Active' : 'Inactive',
            $user->created_at ? $user->created_at->format('d-M-Y') : '',
            optional($user->teamLead)->name ?? '—',
            optional($user->teamManager)->name ?? '—',
            $permissionsString,
        ];
    }

    public function headings(): array
    {
        return [
            'Sno',
            'Site',
            'Employee Type',
            'User Group',
            'Employee Code',
            'Alias',
            'Name',
            'Email',
            'Phone',
            'Status',
            'Date Added',
            'Team Lead',
            'Team Manager',
            'Permission'
        ];
    }
}
