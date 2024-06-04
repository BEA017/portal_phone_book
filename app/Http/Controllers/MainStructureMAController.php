<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainStructureMAController extends Controller
{

    public function index()
    {
        //добавить проверку на отдел
        $MainStructures= DB::table('main_structs')
            ->select('main_structs.id', 'main_structs.structName',   'main_structs.parentId')
            ->get();


        return view('mainAdmin.adminMainStructs' , compact('MainStructures'  ));
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('main_structs')->insert([
                'structName' => $request->MainStructName,
                'parentId' => $request->StructParent,
                 'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::commit();

            return redirect()->route('ma.main_structs')->with('success', 'Успешно создан!');

        } catch (\Exception $e) {

            DB::rollback();
             //dd($e);
            return redirect()->route('ma.main_structs')->with('error', 'Ошибка при создании. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

    public function edit($id)
    {
        $MainStruct= DB::table('main_structs')
            ->select('main_structs.id', 'main_structs.structName' , 'main_structs.parentId' )
            ->where('main_structs.id', $id)
            ->get();


        return view('mainAdmin.adminMainStructsEdit', compact( 'MainStruct' ));
    }

    public function update($id, Request $request)
    {

        try {
            DB::table('main_structs')->where('id', $id)->update([
                'structName' => $request->MainStructName,
                'parentId' => $request->StructParent,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::commit();

            return redirect()->route('ma.main_structs')->with('success', 'Успешно!');

        } catch (\Exception $e) {

            DB::rollback();
            dd($e);
            return redirect()->route('ma.main_structs')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

    public function del($id)
    {
        try {
            DB::beginTransaction();

            DB::table('main_structs')->delete($id);

            DB::commit();
            return redirect()->route('ma.main_structs')->with('success', 'Успешно!');

        } catch (\Exception $e) {
            DB::rollback();
            //  dd($e);
            return redirect()->route('ma.main_structs')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

}
