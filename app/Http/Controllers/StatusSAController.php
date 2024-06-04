<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusSAController extends Controller
{
    public function index(Request $request)
    {
//        //добавить проверку на отдел
//        if(isset($request->user()->role))
//        {
//            dd($request->user()->struct_id);
//        }

        $statusCards = DB::table('Employees as e')
            ->select('e.id as employee_id', 'p.id','p.personName','wp.postName', 's.structName', 'ea.dateStartAbsence', 'ea.dateEndAbsence', 'ea.absenceType', 'ea.absenceInfo')
            ->join('People as p', 'e.idEmployee', '=', 'p.id')
            ->join('working_posts as wp', 'e.postId', '=', 'wp.id')
            ->join('Structures as s', 'e.idworkingStructure', '=', 's.id')
            ->join('employee_absences as ea', 'e.idEmployee', '=', 'ea.idPerson')
            ->join('main_structs as ms', 's.parentIdMainStruct', '=', 'ms.id') // Предполагается, что mainStructId - внешний ключ в Structures
            ->where('ms.id', $request->user()->struct_id)
            ->get();

        $statuses= DB::table('statuses')
            ->select('statuses.id', 'statuses.statusName')
            ->get();


        return view('structAdmin.status' , compact('statusCards','statuses') );
     }



    public function edit($id)
    {
        $statusCard = DB::table('Employees as e')
            ->select('e.id as employee_id', 'p.id','p.personName','wp.postName', 's.structName', 'ea.dateStartAbsence', 'ea.dateEndAbsence', 'ea.absenceType', 'ea.absenceInfo')
            ->join('People as p', 'e.idEmployee', '=', 'p.id')
            ->join('working_posts as wp', 'e.postId', '=', 'wp.id')
            ->join('Structures as s', 'e.idworkingStructure', '=', 's.id')
            ->join('employee_absences as ea', 'e.idEmployee', '=', 'ea.idPerson')
            ->where('p.id', $id)
            ->get();

        $statuses= DB::table('statuses')
            ->select('statuses.id', 'statuses.statusName')
            ->get();


        if($statusCard->count()<1)
            return redirect()->route('sa.status');

        return view('structAdmin.statusEdit', compact('statusCard', 'statuses' ));

    }

    public function update($id, Request $request)
    {
        try {

            DB::table('employee_absences')->where('idPerson', $id)->update([
                'absenceType' => $request-> absenceType,
                'dateStartAbsence' => $request-> dateStartAbsence,
                'dateEndAbsence' => $request-> dateEndAbsence,
                'absenceInfo' => $request-> absenceInfo,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::commit();

            return redirect()->route('sa.status')->with('success', 'Успешно!');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('sa.status')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }
}
