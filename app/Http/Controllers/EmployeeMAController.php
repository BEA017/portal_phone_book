<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeCard;
use App\Models\Person;
use App\Models\PositionPost;
use App\Models\PositionStructure;
use App\Models\Structure;
use App\Models\WorkingPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EmployeeMAController extends Controller
{
//    public function index(){
//       // $employees=Employee::all();
//        $people=Person::all();
//       // $structure=Structure::all();
//     //   $cards=array();
//
////        foreach ($people as $person) {//переделать н хранимую функцию в бд
////            foreach ($employees as $item) {
////           //     if ($item->idEmployee==$person->id)
////               // array_push($cards, new employeeCard());
////            }
////
////        }
//
//// $employeeCard = DB::table('employees')
//// ->select('employees.id AS employee_id', 'people.personName', 'posts.postName', 'structures.structName', 'employees.workPhoneNumber', 'employees.internalPhoneNumber', 'employees.workplaceAddress', 'people.personalEmail','people.personalPhoneNumber', 'employee_absences.absenceType')
//// ->join('people', 'employees.idEmployee', '=', 'people.id')
//// ->join('posts', 'employees.postId', '=', 'posts.id')
//// ->join('structures', 'employees.idworkingStructure', '=', 'structures.id')
//// ->join('employee_absences', 'employees.idEmployee', '=', 'employee_absences.idPerson')
//// ->join('position_structures', 'employees.id', '=', 'position_structures.structureId')
//// ->join('position_posts', 'employees.id', '=', 'position_posts.postId')
//// ->orderBy('employees.postId')
//// ->get();
//$employeeCard = DB::table('employees')
//->select('employees.id AS employee_id', 'people.personName', 'working_posts.postName', 'structures.structName', 'employees.workPhoneNumber', 'employees.internalPhoneNumber', 'employees.workplaceAddress', 'people.personalEmail','people.personalPhoneNumber')
//->join('people', 'employees.idEmployee', '=', 'people.id')
//->join('working_posts', 'employees.postId', '=', 'working_posts.id')
//->join('structures', 'employees.idworkingStructure', '=', 'structures.id')
//->join('position_structures', 'employees.id', '=', 'position_structures.structureId')
//->join('position_posts', 'employees.id', '=', 'position_posts.postId')
//->orderBy('employees.postId')
//->get();
//        //  echo("<script>console.log('php_array: ".json_encode($employeeCard)."');</script>");
//
//        $structures= DB::table('structures')
//        ->select('structures.structName')
//        ->get();
//
//    return view('mainAdmin.adminEmployees', compact('employeeCard'), compact('structures'));
//    }
    public function index()
    {
        //добавить проверку на отдел

        $employeeCards = DB::table('Employees as e')
            ->select('e.id as employee_id', 'p.id', 'p.dateOfBirth', 'e.workPhoneNumber','e.internalPhoneNumber', 'p.personName', 'wp.postName', 's.structName', 'e.workplaceAddress', 'p.personalEmail', 'p.personalPhoneNumber')
            ->join('People as p', 'e.idEmployee', '=', 'p.id')
            ->join('working_posts as wp', 'e.postId', '=', 'wp.id')
            ->join('Structures as s', 'e.idworkingStructure', '=', 's.id')
            ->get();

        $posts = WorkingPost::all();
        $structs = Structure::all();

        return view('mainAdmin.adminEmployees', compact('employeeCards', 'posts', 'structs'));
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
                'idworkingStructure' => $request-> SelectStruct,
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

            return redirect()->route('ma.employee')->with('success', 'Успешно создан!');

        } catch (\Exception $e) {

            DB::rollback();
            //dd($e);
            return redirect()->route('ma.employee')->with('error', 'Ошибка при создании. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

    public function edit($id)
    {
        $employeeCard = DB::table('Employees as e')
            ->select('e.id as employee_id', 'p.id', 'p.dateOfBirth', 'e.postId','e.idworkingStructure', 'e.workPhoneNumber','e.internalPhoneNumber', 'p.personName', 'wp.postName', 's.structName', 'e.workplaceAddress', 'p.personalEmail', 'p.personalPhoneNumber' )
            ->join('People as p', 'e.idEmployee', '=', 'p.id')
            ->join('working_posts as wp', 'e.postId', '=', 'wp.id')
            ->join('Structures as s', 'e.idworkingStructure', '=', 's.id')
            ->where('p.id', $id)
            ->get();
        $posts = WorkingPost::all();
        $structs = Structure::all();
        if($employeeCard->count()<1)
            return redirect()->route('ma.employee');

        return view('mainAdmin.adminEmployeesEdit', compact('employeeCard', 'posts', 'structs' ));

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

            return redirect()->route('ma.employee')->with('success', 'Успешно!');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('ma.employee')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
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
            return redirect()->route('ma.employee')->with('success', 'Успешно!');

        } catch (\Exception $e) {
            DB::rollback();
            //  dd($e);
            return redirect()->route('ma.employee')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }


}
