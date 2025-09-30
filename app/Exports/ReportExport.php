<?php

  namespace App\Exports;

  use App\User;
  use App\Country;
  use Maatwebsite\Excel\Concerns\FromQuery;
  use Maatwebsite\Excel\Concerns\Exportable;
  use Maatwebsite\Excel\Concerns\WithHeadings;
  use Illuminate\Support\Facades\DB;


  class ReportExport implements FromQuery, WithHeadings
  {
      use Exportable;

      public function __construct($country,$state,$category,$year,$option)
      {
          $this->country  = $country;
          $this->state    = $state;
          $this->category = $category;
          $this->year     = $year;
          $this->option   = $option;
      }
      public function headings(): array
      {
          return [
              'Member Number',
              'First name',
              'Last name',
              'Email',
              'Type',
              'Created at',
              'Category',
              'Country',
              'City',
              'State',
              'Address',
              'Expiry Date',
              'Payment Status',
          ];
      }
      public function query()
      {
        $user = User::select(
          'users.membership_token',
          'users.first_name',
          'users.last_name',
          'users.email',
          'users.type',
          DB::raw('DATE_FORMAT(users.created_at, "%m-%d-%Y") as created_date'),
          'categories.name as categ',
          'countries.name',
          'users.city',
          'states.name as state',
          'users.address_1',
          DB::raw('DATE_FORMAT(payments.transaction_expiry_date, "%m-%d-%Y") as expired_date'),
          DB::raw('(CASE WHEN payments.is_expire = "0" THEN "Active" ELSE "Expired" END) AS expire')
        )->join('countries','users.country','=','countries.id')
        ->join('states','users.state','=','states.id')
        ->join('categories','users.category','=','categories.id')
        ->join('payments','payments.user_id','=','users.id');

        if( intval($this->country) > 0 )
          $user->where('country', '=', $this->country);

        if( intval($this->state) > 0 )
          $user->where('state', '=', $this->state);

        if( intval($this->category) > 0 )
          $user->where('category', '=', $this->category);

        if( $this->year > 0 )
          $user->whereYear('payments.transaction_expiry_date', '=', $this->year );

        if( $this->option != '' ){

          if ($this->option == 'active')
            $user->where('payments.is_expire', 0);
          if ($this->option == 'inactive')
            $user->where('payments.is_expire', 1);

        }

          $user->orderBy('countries.id', 'asc');
          $user->orderBy('payments.created_at', 'asc');

          return $user;
	  }
  }
