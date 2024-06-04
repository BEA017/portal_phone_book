<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkingPostMAController extends Controller
{

    public function index()
    {
        //добавить проверку на отдел
        $Posts= DB::table('working_posts')
            ->select('working_posts.id', 'working_posts.postName', 'working_posts.parentId')
            ->get();

        return view('mainAdmin.adminPosts' , compact('Posts') );
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::table('working_posts')->insert([
                'postName' => $request->PostName,
                'parentId' => $request->ParentId,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::commit();

            return redirect()->route('ma.posts')->with('success', 'Успешно создан!');

        } catch (\Exception $e) {

            DB::rollback();
            // dd($e);
            return redirect()->route('ma.posts')->with('error', 'Ошибка при создании. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

    public function edit($id)
    {
        $Post= DB::table('working_posts')
            ->select('working_posts.id', 'working_posts.postName', 'working_posts.parentId')
            ->where('working_posts.id', $id)
            ->get();

        return view('mainAdmin.adminPostsEdit', compact('Post' ));
    }

    public function update($id, Request $request)
    {
        try {
            DB::table('working_posts')->where('id', $id)->update([
                'postName' => $request->PostName,
                'parentId' => $request->ParentId,
                'created_at' =>  \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);

            DB::commit();

            return redirect()->route('ma.posts')->with('success', 'Успешно!');

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('ma.posts')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

    public function del($id)
    {
        try {
            DB::beginTransaction();

            DB::table('working_posts')->delete($id);

            DB::commit();
            return redirect()->route('ma.posts')->with('success', 'Успешно!');

        } catch (\Exception $e) {
            DB::rollback();
            //  dd($e);
            return redirect()->route('ma.posts')->with('error', 'Ошибка. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

}
