<?php
  
namespace App\Exports;
  
use App\User;
use App\Country;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
  
class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id',
            'first name',
            'country',
        ];
    }
    public function collection($country_id = null)
    {
        return User::select('id','first_name','country')->whereCountry(2)->get();
        // return User::limit(50)->get();
    }
}