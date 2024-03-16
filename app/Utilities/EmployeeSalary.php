<?php

namespace App\Utilities;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use App\Models\Salary;
use Filament\Notifications\Notification;


class EmployeeSalary
{
    public function generateSalary($month, $year){
        $employees = Employee::all();
        $monthNumber = date("m", strtotime($month));
        $monthOfSalary = Carbon::createFromFormat('Y-m-d', "$year-$monthNumber-01");

        foreach($employees as $employee){

            $employeeAttendents = $employee->attendents()
                                ->filterByMonthYear($monthNumber, $year);


            $basicSalary = $employee->salaryFormat;

            $salary = $this->calculateSalary(
                $basicSalary, 
                $employeeAttendents->where("status","absent")->count(),
                $monthOfSalary->daysInMonth,
            );

            $this->storeRecord([
                "employee_id" => $employee->id, 
                "month" => $month, 
                "year" => $year,
                "basic_salary" => $salary["basic_salary"],
                "bonus" => $salary["bonus"],
                "allowances" => $salary["allowances"],
                "deduction" => $salary["deduction"],
                "paid" => $salary["total_salary"],
                "is_received" => false,
            ]);

        }
    }


    public function calculateSalary($salary, $absent, $daysInMonth)
    {
        $salaryPerDay = round($salary->basic_salary / $daysInMonth);

        $subSalaryForAbsent = $salaryPerDay * $absent;

        $allowances = $salary->meat_allowance;

        $employeeSalary = $salary->basic_salary + $salary->bonus + $salary->meat_allowance;

        $deduction = $subSalaryForAbsent;

        return [
            "total_salary" => round($employeeSalary - $deduction),
            "bonus" => $salary->bonus,
            "allowances" => $allowances,
            "basic_salary" => $salary->basic_salary,
            "deduction" => $deduction,
        ];
    }


    public static function updateReceivedDate($record, $state){
        if($slate = "1"){
            $record->date_of_receive = Carbon::now()->toDateString();
            $record->save();
        }
    }

    public function storeRecord($record)
    {
        Salary::create($record);
    }
}