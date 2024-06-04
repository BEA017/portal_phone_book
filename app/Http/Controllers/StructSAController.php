<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StructSAController extends Controller
{
    public function index(request $request)
    {
        //добавить проверку на отдел
        $Structures= DB::table('structures')
            ->select('structures.id', 'structures.structName', 'structures.structPhone', 'structures.structAddress', 'structures.parentId', 'structures.parentIdMainStruct')
            ->where('structures.parentIdMainStruct', $request->user()->struct_id)
            ->get();

        return view('structAdmin.structs' , compact('Structures') );
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('structures')->insert([
                'structName' => $request->StructName,
                'structPhone' => $request->StructPhone,
                'structAddress' => $request->StructAddress,
                'parentId' => $request->StructParent,
                'parentIdMainStruct' => $request->user()->struct_id,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::commit();

            return redirect()->route('sa.structs')->with('success', 'Успешно создан!');

        } catch (\Exception $e) {

            DB::rollback();
            dd($e);
            return redirect()->route('sa.structs')->with('error', 'Ошибка при создании. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

    public function edit($id)
    {
        $Struct= DB::table('structures')
            ->select('structures.id', 'structures.structName', 'structures.structPhone', 'structures.structAddress', 'structures.parentId')
            ->where('structures.id', $id)
            ->get();

        return view('structAdmin.structsEdit', compact('Struct' ));
    }

    public function update($id, Request $request)
    {
        try {
            DB::table('structures')->where('id', $id)->update([
                'structName' => $request->StructName,
                'structPhone' => $request->StructPhone,
                'structAddress' => $request->StructAddress,
                'parentId' => $request->StructParent,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::commit();

            return redirect()->route('sa.structs')->with('success', 'Успешно!');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('sa.structs')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

    public function del($id)
    {
        try {
            DB::beginTransaction();

            DB::table('structures')->delete($id);

            DB::commit();
            return redirect()->route('sa.structs')->with('success', 'Успешно!');

        } catch (\Exception $e) {
            DB::rollback();
            //  dd($e);
            return redirect()->route('sa.structs')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

}
