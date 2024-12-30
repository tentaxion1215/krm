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


class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize , WithEvents, WithMapping,FromQuery
{
    use Exportable;
    
    public function query()
    {
         ini_set('memory_limit', '1024M');
        return User::orderBy('id')->get(['id','name','email','phone','city','address','date_of_birth','gender']);
    }

    public function collection()
    {
         
            return User::where('usertype','User')->orderBy('id','DESC')->get(['id','name','email','phone','city','address','date_of_birth','gender']);
           
    }

    public function map($users): array
    {
        return [             
            $users->id,
            $users->name,
            $users->email,
            $users->phone,
            $users->city,
            $users->address,
            date('m-d-Y',$users->date_of_birth),
            $users->gender 
            
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Phone',
            'City',
            'Address',
            'DoB',
            'Gender'             
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