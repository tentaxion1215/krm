<?php

namespace App\Exports;

use App\User;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;


class CompanyExport implements FromCollection, WithHeadings, ShouldAutoSize , WithEvents, WithMapping,FromQuery
{
    use Exportable;
    
    public function query()
    {
         ini_set('memory_limit', '1024M');
        return User::orderBy('id')->get(['id','name','email','phone']);
    }

    public function collection()
    {
         
            return User::where('usertype','Company')->orderBy('id','DESC')->get(['id','name','email','phone','address','company_website','company_working_day','company_working_time']);
           
    }

    public function map($users): array
    {
        return [             
            $users->id,
            $users->name,
            $users->email,
            $users->phone,
            $users->address,
            $users->company_website,
            $users->company_working_day,
            $users->company_working_time 
            
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Phone',
            'Address',
            'Website',
            'Working Day',
            'Working Time'     
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:D1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

}