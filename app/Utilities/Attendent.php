<?php

namespace App\Utilities;

use Illuminate\Support\Carbon;

use App\Models\Employee;
use App\Models\EmployeeAttend;

class Attendent
{
    // ["key" => value]
    public $datesToToday = [];
    public $todayDay;
    public $daysInMonth;
    public $today;

    public $year;
    public $month;

    public function __construct() 
    {
        $todayCarbon = Carbon::now();
        $this->todayDay = (int)$todayCarbon->isoFormat("D");
        $this->daysInMonth =  $todayCarbon->daysInMonth;
        $this->today = $todayCarbon;
        $this->year = $todayCarbon->year;
        $this->month = $todayCarbon->month;
    }

    private function createDateString($day)
    {
        return Carbon::createFromDate($this->year, $this->month, $day)->toDateString();
    }

    public function generateDatesToToday()
    {
        $yesterday = (int)$this->today->subDays(1)->isoFormat("D");
        // dd($this->todayDay);
        $datesArr = [];

        for ($i = $this->todayDay; $i > 0 ; $i--) { 
            if($i === $this->todayDay){
                $datesArr[$this->createDateString($i)] = "Today";
            }else if($i === $yesterday){
                $datesArr[$this->createDateString($i)] = "Yesterday";
            }else{
                $datesArr[$this->createDateString($i)] = $this->createDateString($i);
            }
        }
        return $datesArr;
    }

    static public function generateAllEmployeeAtt(){
        
        $currentDate = Carbon::now()->toDateString();

        if(!(EmployeeAttend::where("date", $currentDate)->first())){
            Employee::all()->map(function ($item, $key) {
                EmployeeAttend::create([
                    "employee_id" => $item->id,
                    "date" => Carbon::now()->toDateString(),
                    "status" => "absent"
                ]);
            });
        }
    }
}