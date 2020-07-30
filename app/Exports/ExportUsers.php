<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportUsers implements FromView
{
    public function __construct($users)
    {
        $this->users = $users;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $users = $this->users;
        
        return view('csv.form.form',
        [
            'users' => $users->all()
        ]);
    }
}
