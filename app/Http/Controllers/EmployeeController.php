<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeCard;
use App\Models\MainStruct;
use App\Models\Person;
use App\Models\PositionPost;
use App\Models\PositionStructure;
use App\Models\Status;
use App\Models\Structure;
use App\Models\User;
use App\Models\WorkingPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EmployeeController extends Controller
{
    public function index(){
       // $employees=Employee::all();
      //  $people=Person::all();
       // $structure=Structure::all();
     //   $cards=array();

//        foreach ($people as $person) {//переделать н хранимую функцию в бд
//            foreach ($employees as $item) {
//           //     if ($item->idEmployee==$person->id)
//               // array_push($cards, new employeeCard());
//            }
//
//
//        }




// $employeeCard = DB::table('employees')
// ->select('employees.id AS employee_id', 'people.personName', 'posts.postName', 'structures.structName', 'employees.workPhoneNumber', 'employees.internalPhoneNumber', 'employees.workplaceAddress', 'people.personalEmail','people.personalPhoneNumber', 'employee_absences.absenceType')
// ->join('people', 'employees.idEmployee', '=', 'people.id')
// ->join('posts', 'employees.postId', '=', 'posts.id')
// ->join('structures', 'employees.idworkingStructure', '=', 'structures.id')
// ->join('employee_absences', 'employees.idEmployee', '=', 'employee_absences.idPerson')
// ->join('position_structures', 'employees.id', '=', 'position_structures.structureId')
// ->join('position_posts', 'employees.id', '=', 'position_posts.postId')
// ->orderBy('employees.postId')
// ->get();
        /*
$employeeCard = DB::table('employees')
->select('employees.id AS employee_id', 'people.personName', 'wor
->join('working_posts', 'employees.postId', '=', 'working_posts.id')
->join('structures', 'employees.idworkingStructure', '=', 'structures.id')
->join('position_structures', 'employees.id', '=', 'position_structures.structureId')
->join('position_posts', 'employees.id', '=', 'position_posts.postId')
->orderBy('employees.postId')
->get();*/
        $employeeCard = DB::table('Employees as e')
            ->select('e.id as employee_id', 'p.id', 'e.workPhoneNumber','e.internalPhoneNumber', 'p.personName',
                'wp.postName', 's.structName', 'e.workplaceAddress', 'p.personalEmail', 'p.personalPhoneNumber',
                'ea.dateStartAbsence', 'ea.dateEndAbsence', 'ea.absenceType', 'ea.absenceInfo', 'wp.parentId')
            ->join('People as p', 'e.idEmployee', '=', 'p.id')
            ->join('working_posts as wp', 'e.postId', '=', 'wp.id')
            ->join('Structures as s', 'e.idworkingStructure', '=', 's.id')
            ->join('employee_absences as ea', 'e.idEmployee', '=', 'ea.idPerson')
            ->orderBy('wp.parentId')
            ->get();

//        $employeeCard = DB::table('Employees as e')
//            ->select('e.id as employee_id', 'p.id', 'e.workPhoneNumber','e.internalPhoneNumber', 'p.personName',
//                'wp.postName', 's.structName', 'e.workplaceAddress', 'p.personalEmail', 'p.personalPhoneNumber',
//                'ea.dateStartAbsence', 'ea.dateEndAbsence', 'ea.absenceType', 'ea.absenceInfo')
//            ->join('People as p', 'e.idEmployee', '=', 'p.id')
//            ->join('working_posts as wp', 'e.postId', '=', 'wp.id')
//            ->join('Structures as s', 'e.idworkingStructure', '=', 's.id')
//            ->join('employee_absences as ea', 'e.idEmployee', '=', 'ea.idPerson')
//            ->get();

        //  echo("<script>console.log('php_array: ".json_encode($employeeCard)."');</script>");

        $structures= DB::table('structures')
        ->select('structures.*')
        ->orderBy('structures.parentId')
        ->get();
        $statuses= DB::table('statuses')
            ->select('statuses.id', 'statuses.statusName')
            ->get();


       // dd($statuses);
    return view('employee.index', compact('employeeCard','structures', 'statuses' ));
    }

    public function seedTestData(){
//        $peopleArr=[[
//                'personName'=>'Грязнов Дмитрий',
//            ],
//            [
//                'personName'=>'Решетник Кирилл',
//            ],
//            [
//                'personName'=>'Микова Лариса',
//            ],
//            [
//                'personName'=>'Ковальчук Анастасия',
//            ],
//        ];
//        $employeeArr=[[
//                'idEmployee'=>'1',
//                'idworkingStructure'=>'1',
//                'postId'=>'7',
//                'workPhoneNumber'=>'777',
//                'internalPhoneNumber'=>'777',
//                'workplaceAddress'=>'p67'
//            ],
//            [
//                'idEmployee'=>'2',
//                'idworkingStructure'=>'1',
//                'postId'=>'5',
//                'workPhoneNumber'=>'747',
//                'internalPhoneNumber'=>'747',
//                'workplaceAddress'=>'p67'
//            ],
//            [
//                'idEmployee'=>'3',
//                'idworkingStructure'=>'2',
//                'postId'=>'7',
//                'workPhoneNumber'=>'737',
//                'internalPhoneNumber'=>'737',
//                'workplaceAddress'=>'p67'
//            ],
//            [
//                'idEmployee'=>'4',
//                'idworkingStructure'=>'2',
//                'postId'=>'8',
//                'workPhoneNumber'=>'885',
//                'internalPhoneNumber'=>'885',
//                'workplaceAddress'=>'p67'
//            ],
//
//        ];
        try {
            DB::beginTransaction();
            $postsArr = [['postName' => 'Глава муниципального образования
город-курорт Анапа', 'parentId' => 0],
                ['postName' => 'Помощник', 'parentId' => 1],
                ['postName' => 'Советник', 'parentId' => 2],
                ['postName' => 'Первый заместитель главы', 'parentId' => 1],
                ['postName' => 'Глава администрации', 'parentId' => 0],
                ['postName' => 'Заместитель главы администрации', 'parentId' => 1],
                ['postName' => 'Руководитель', 'parentId' => 2],
                ['postName' => 'Испольняющий обязанности руководителя', 'parentId' => 3],
                ['postName' => 'Генеральный директор', 'parentId' => 2],
                ['postName' => 'Директор', 'parentId' => 3],
                ['postName' => 'Председатель', 'parentId' => 3],
                ['postName' => 'Начальник', 'parentId' => 3],
                ['postName' => 'Исполняющий обязанности начальника', 'parentId' => 4],
                ['postName' => 'Заместитель начальника', 'parentId' => 4],
                ['postName' => 'Заведующий приемной', 'parentId' => 4],
                ['postName' => 'Депутат', 'parentId' => 4],
                ['postName' => 'Инспектор', 'parentId' => 5],
                ['postName' => 'Главный бухгалтер', 'parentId' => 5],
                ['postName' => 'Бухгалтер', 'parentId' => 6],
                ['postName' => 'Главный специалист', 'parentId' => 6],
                ['postName' => 'Ведущий специалист', 'parentId' => 7],
                ['postName' => 'Спеиалист I категории', 'parentId' => 8],
            ];

            $structureArr = [['structName' => 'Главы МО г-к Анапа ',
                'structAddress' => 'Анапа, ул. Крымская 99', 'parentId' => 0, 'parentIdMainStruct' => 1],
                ['structName' => 'Заместители главы муниципального образования город-курорт Анапа',
                    'structAddress' => 'Анапа, ул. Крымская 99', 'parentId' => 1, 'parentIdMainStruct' => 1],
                ['structName' => 'Управление делами',
                    'structAddress' => 'Анапа, ул. Крымская 99', 'parentId' => 2, 'parentIdMainStruct' => 1],
                ['structName' => 'Отдел муниципальной службы и кадровой работы',
                    'structAddress' => 'Анапа, ул. Крымская 99', 'parentId' => 3, 'parentIdMainStruct' => 1],
                ['structName' => 'Отдел контроля',
                    'structAddress' => 'Анапа, ул. Крымская 99', 'parentId' => 4, 'parentIdMainStruct' => 1],
                ['structName' => 'Отдел протокола и международного сотрудничества',
                    'structAddress' => 'Анапа, ул. Крымская 99', 'parentId' => 5, 'parentIdMainStruct' => 1],
                ['structName' => 'Архивный отдел',
                    'structAddress' => 'Анапа, ул. Крымская 99', 'parentId' => 6, 'parentIdMainStruct' => 1],
                ['structName' => 'Отдел делопроизводства',
                    'structAddress' => 'Анапа, ул. Крымская 99', 'parentId' => 7, 'parentIdMainStruct' => 1]];
            $statusesArr = [
                ['statusName' => 'На работе'],
                ['statusName' => 'В отпуске'],
                ['statusName' => 'В командировке'],
                ['statusName' => 'На больничном']];

            $MainStructureArr = [['structName' => 'Администрация',
                'parentId' => 0],
                ['structName' => 'МБУ ЦА',
                    'parentId' => 1]];
            $UserArr = [['name' => 'admin',
                'role' => 'admin',
                'struct_id' => '1',
                'email' => 'ad@anapa.ru',
                'password' => 'wsxCDE32'], ['name' => 'main_admin',
                'role' => 'main_admin',
                'struct_id' => '1',
                'email' => 'main_admin@anapa.ru',
                'password' => '12345678']];

            foreach ($postsArr as $item) {
                WorkingPost::create($item);
            }
            foreach ($structureArr as $item) {
                Structure::create($item);
            }
            foreach ($statusesArr as $item) {
                Status::create($item);
            }
            foreach ($MainStructureArr as $item) {
                MainStruct::create($item);
            }

            foreach ($UserArr as $item) {
                User::create($item);
            }
            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollback();

            dd($e);
        }


    }

}
