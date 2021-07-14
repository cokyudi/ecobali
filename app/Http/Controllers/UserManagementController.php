<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use DataTables;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;

class UserManagementController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'Admin') {
            return redirect('/dashboard1');
        }

        $users = User::latest()->get();

        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editUser">Edit</a>';

                            if (Auth::user()->id !== $row->id) {
                                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>';
                            }

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('userManagement/index',compact('users','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user_id) {
            User::updateOrCreate(
                ['id'=> $request->user_id],
                [
                    'name'=> $request->name,
                    'role'=> $request->role
                ]
            );
            return response()->json(['success'=>'User saved successfully.', 'editedUser'=>$request->all()]);
        }

        $rules = [
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed'
        ];
 
        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return response()->json(['error'=>'Gagal menambahkan user.', 'errors'=>$validator->errors()]);
        }
 
        $user = new User;
        $user->name = $request->name;
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $simpan = $user->save();
 
        if($simpan){
            Session::flash('success', 'Register berhasil!');
            return response()->json(['success'=>'User saved successfully.']);
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect('/user-management');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return response()->json(['success'=>'User deleted successfully.']);
    }
}
