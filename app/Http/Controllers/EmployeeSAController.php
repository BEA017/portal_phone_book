<?php

namespace App\Http\Controllers;
 use App\Models\Employee;
 use App\Models\Person;
 use App\Models\WorkingPost;

use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\DB;
use App\Models\Structure;
 use function Laravel\Prompts\error;

 class EmployeeSAController extends Controller
{
public function index(Request $request)
    {        //добавить проверку на отдел
//        if(isset($request->user()->role))
//        {
//            dd($request->user()->struct_id);
//        }


          $employeeCards = DB::table('Employees as e')
            ->select('e.id as employee_id', 'p.id', 'p.dateOfBirth', 'e.workPhoneNumber','e.internalPhoneNumber', 'p.personName', 'wp.postName', 's.structName', 'e.workplaceAddress', 'p.personalEmail', 'p.personalPhoneNumber')
            ->join('People as p', 'e.idEmployee', '=', 'p.id')
            ->join('working_posts as wp', 'e.postId', '=', 'wp.id')
            ->join('Structures as s', 'e.idworkingStructure', '=', 's.id')
//            ->join('main_structs as ms', 'e.idworkingStructure', '=', 'ms.id')
//            ->where('e.idWorkingStructure', $request->user()->struct_id)
             ->join('main_structs as ms', 's.parentIdMainStruct', '=', 'ms.id') // Предполагается, что mainStructId - внешний ключ в Structures
             ->where('ms.id', $request->user()->struct_id)
            ->get();

        $posts = WorkingPost::all();
         $structs = DB::table('structures')
            ->where('parentIdMainStruct', $request->user()->struct_id)
            ->get();

        return view('structAdmin.employee', compact('employeeCards', 'posts', 'structs'));
    }

    public function create(Request $request)
     {
         try {
              DB::beginTransaction();
                 $lastInsertedId = DB::table('people')->insertGetId([
                    'personName' => $request-> personName,
                     'personalEmail' => $request->personalEmail,
                    'personalPhoneNumber' =>$request->personalPhoneNumber,
                    'created_at' =>  \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);

        //добавить в employee

                 DB::table('employees')->insert([
                    'idEmployee' => $lastInsertedId,
                    'idworkingStructure' =>$request-> SelectStruct,
                    'postId' => $request-> SelectPost,
                    'workPhoneNumber' => $request-> workPhoneNumber,
                    'internalPhoneNumber' => $request-> internalPhoneNumber,
                    'workplaceAddress' =>$request-> workplaceAddress,
                    'created_at' =>  \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);

                 DB::table('employee_absences')->insert([
                    'idPerson' => $lastInsertedId,
                    'absenceType' => 1,
                     'created_at' =>  \Carbon\Carbon::now(),
                     'updated_at' => \Carbon\Carbon::now(),
                ]);

                 DB::table('employee_accountings')->insert([
                    'idPerson' => $lastInsertedId,
                     'created_at' =>  \Carbon\Carbon::now(),
                     'updated_at' => \Carbon\Carbon::now(),
                ]);

            DB::commit();

            return redirect()->route('sa.employee')->with('success', 'Успешно создан!');

         } catch (\Exception $e) {

            DB::rollback();
            // dd($e);
             return redirect()->route('sa.employee')->with('error', 'Ошибка при создании. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
         }
    }

    public function edit($id, Request $request)
    {
        $employeeCard = DB::table('Employees as e')
            ->select('e.id as employee_id', 'p.id', 'p.dateOfBirth', 'e.postId','e.idworkingStructure', 'e.workPhoneNumber','e.internalPhoneNumber', 'p.personName', 'wp.postName', 's.structName', 'e.workplaceAddress', 'p.personalEmail', 'p.personalPhoneNumber' )
            ->join('People as p', 'e.idEmployee', '=', 'p.id')
            ->join('working_posts as wp', 'e.postId', '=', 'wp.id')
            ->join('Structures as s', 'e.idworkingStructure', '=', 's.id')
            ->where('p.id', $id)
            ->get();
        $posts = WorkingPost::all();
        $structs = DB::table('structures')
            ->where('parentIdMainStruct', $request->user()->struct_id)
            ->get();
        if($employeeCard->count()<1)
            return redirect()->route('sa.employee');

         return view('structAdmin.employeeEdit', compact('employeeCard', 'posts', 'structs' ));

    }

    public function update($id, Request $request)
    {
        try {
        DB::beginTransaction();

            $updatePerson = DB::table('people')->where('id', $id)->update([
                'personName' => $request-> personName,
                'dateOfBirth'=> $request-> dateOfBirth,
                'personalEmail' => $request-> personalEmail,
                'personalPhoneNumber' =>$request-> personalPhoneNumber,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            //добавить в employee


            DB::table('employees')->where('idEmployee', $id)->update([
                'idworkingStructure' => $request-> SelectStruct,
                'postId' => $request-> SelectPost,
                'workPhoneNumber' => $request-> workPhoneNumber,
                'internalPhoneNumber' => $request-> internalPhoneNumber,
                'workplaceAddress' =>$request-> workplaceAddress,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

             DB::commit();

             return redirect()->route('sa.employee')->with('success', 'Успешно!');

        } catch (\Exception $e) {

             DB::rollback();

             return redirect()->route('sa.employee')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
         }
    }

    public function del($id)
    {
        try {
            DB::beginTransaction();
            $employeeCard = DB::table('Employees')->where('id', $id)->first();
            $absenceData = DB::table('employee_absences')->where('idPerson',$id)->first();

            DB::table('employees')->delete($employeeCard->id);
            DB::table('people')->delete($id);
            DB::table('employee_absences')->delete($absenceData->id);

            DB::commit();
            return redirect()->route('sa.employee')->with('success', 'Успешно!');

        } catch (\Exception $e) {
            DB::rollback();
            //  dd($e);
             return redirect()->route('sa.employee')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
         }
    }
 }
