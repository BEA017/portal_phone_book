<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use App\Models\WorkingPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeAccountingMAController extends Controller
{

    public function index()
    {
        //добавить проверку на отдел

        $accountCards = DB::table('Employees as e')
            ->select('e.id as employee_id', 'p.id', 'p.dateOfBirth',   'p.personName', 'wp.postName', 's.structName', 'ea.dateStartAccounting', 'ea.dateEndAccounting', 'ea.accountingInfo')
            ->join('People as p', 'e.idEmployee', '=', 'p.id')
            ->join('working_posts as wp', 'e.postId', '=', 'wp.id')
            ->join('Structures as s', 'e.idworkingStructure', '=', 's.id')
            ->join('employee_accountings as ea', 'e.idEmployee', '=', 'ea.idPerson')
            ->get();


        return view('mainAdmin.adminEmployeeAccounting', compact('accountCards' ));
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('employee_accountings')->insert([
                'idPerson' =>  $request-> personId,
                'dateStartAccounting' =>  $request-> dateStartAccounting,
                'dateEndAccounting' =>  $request-> dateEndAccounting,
                'accountingInfo' =>  $request-> accountingInfo,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::commit();

            return redirect()->route('ma.emp_accounting')->with('success', 'Успешно создан!');

        } catch (\Exception $e) {

            DB::rollback();
          //  dd($e);
            return redirect()->route('ma.emp_accounting')->with('error', 'Ошибка при создании. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

    public function edit($id)
    {
        $accountCard = DB::table('Employees as e')
            ->select('e.id as employee_id', 'p.id', 'p.dateOfBirth',   'p.personName', 'wp.postName', 's.structName', 'ea.dateStartAccounting', 'ea.dateEndAccounting', 'ea.accountingInfo')
            ->join('People as p', 'e.idEmployee', '=', 'p.id')
            ->join('working_posts as wp', 'e.postId', '=', 'wp.id')
            ->join('Structures as s', 'e.idworkingStructure', '=', 's.id')
            ->join('employee_accountings as ea', 'e.idEmployee', '=', 'ea.idPerson')
            ->get();

        return view('mainAdmin.adminEmployeeAccountingEdit', compact('accountCard'  ));

    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('employee_accountings')->where('idPerson', $id)->update([
                 'dateStartAccounting' =>  $request-> dateStartAccounting,
                'dateEndAccounting' =>  $request-> dateEndAccounting,
                'accountingInfo' =>  $request-> accountingInfo,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::commit();

            return redirect()->route('ma.emp_accounting')->with('success', 'Успешно!');

        } catch (\Exception $e) {

            DB::rollback();
            //dd($e);

            return redirect()->route('ma.emp_accounting')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

    public function del($id)
    {
        try {
            DB::beginTransaction();
             $absenceData = DB::table('employee_accountings')->where('idPerson',$id)->first();

             DB::table('employee_accountings')->delete($absenceData->id);

            DB::commit();
            return redirect()->route('ma.emp_accounting')->with('success', 'Успешно!');

        } catch (\Exception $e) {
            DB::rollback();
            //  dd($e);
            return redirect()->route('ma.emp_accounting')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

}
