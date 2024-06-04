<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusesMAController extends Controller
{

    public function index()
    {
        //добавить проверку на отдел
        $Statuses= DB::table('statuses')
            ->select('statuses.id', 'statuses.statusName')
            ->get();

        return view('mainAdmin.adminStatuses' , compact('Statuses') );
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('statuses')->insert([
                'statusName' => $request->StatusName,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::commit();

            return redirect()->route('ma.statuses')->with('success', 'Успешно создан!');

        } catch (\Exception $e) {

            DB::rollback();
            // dd($e);
            return redirect()->route('ma.statuses')->with('error', 'Ошибка при создании. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

    public function edit($id)
    {
        $Status= DB::table('statuses')
            ->select('statuses.id', 'statuses.statusName' )
            ->where('statuses.id', $id)
            ->get();

        return view('mainAdmin.adminStatusesEdit', compact('Status' ));
    }

    public function update($id, Request $request)
    {
        try {
            DB::table('statuses')->where('id', $id)->update([
                'statusName' => $request->StatusName,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::commit();

            return redirect()->route('ma.statuses')->with('success', 'Успешно!');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('ma.statuses')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

    public function del($id)
    {
        try {
            DB::beginTransaction();

            DB::table('statuses')->delete($id);

            DB::commit();
            return redirect()->route('ma.statuses')->with('success', 'Успешно!');

        } catch (\Exception $e) {
            DB::rollback();
            //  dd($e);
            return redirect()->route('ma.statuses')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

}
