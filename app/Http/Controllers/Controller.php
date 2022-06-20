<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Mail\CamundoMail;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  
    public function home(){
        
        $task = Http::post(env("API_URL") . '/task', [
            'processDefinitionId' => env("PROCESS_ID")
        ]);
        $task = $task->json();
        // return $task;
        return view('absen', compact('task'));
    }

    public function formulir($id){
        $data =[];
        $data = Http::get(env("API_URL") . "/task", [
            'processInstanceId' => $id,
        ])->json();
        // return $data;

        return view('formulir', compact('data'));
    }

    public function approval($id){
        
        $data = [];

        $tanggal = Http::post(env('API_URL')."/variable-instance",[
            "activityInstanceIdIn" => [$id],
            "variableName" => "tanggal_pinjam",
        ]);
        $judul = Http::post(env('API_URL')."/variable-instance",[
            "activityInstanceIdIn" => [$id],
            "variableName" => "judul",
        ]);
        $pengarang = Http::post(env('API_URL')."/variable-instance",[
            "activityInstanceIdIn" => [$id],
            "variableName" => "pengarang",
        ]);
        $penerbit = Http::post(env('API_URL')."/variable-instance",[
            "activityInstanceIdIn" => [$id],
            "variableName" => "penerbit",
        ]);
        $tahun = Http::post(env('API_URL')."/variable-instance",[
            "activityInstanceIdIn" => [$id],
            "variableName" => "tahun",
        ]);
        $email = Http::post(env('API_URL')."/variable-instance",[
            "activityInstanceIdIn" => [$id],
            "variableName" => "email",
        ]);
        $nama = Http::post(env('API_URL')."/variable-instance",[
            "activityInstanceIdIn" => [$id],
            "variableName" => "nama",
        ]);

        $id = Http::get(env("API_URL") . "/task", [
            'processInstanceId' => $id,
        ]);
    

        $data["tanggal_pinjam"] = $tanggal->json();
        $data["judul"] = $judul->json();
        $data["pengarang"] = $pengarang->json();
        $data["penerbit"] = $penerbit->json();
        $data["tahun"] = $tahun->json();
        $data["email"] = $email->json();
        $data["nama"] = $nama->json();
        $data["id"] = $id->json();
        // return $data;
        return view('approval', compact('data'));
    }

    public function login(){
        return view('login');
    }

    //act
    public function login_act(Request $request){

        $cek  = Http::post(env("API_URL"). "/identity/verify", [
            "username" => $request->username,
            "password" => $request->password
        ]);

        if($cek["authenticated"]){
            $request->session()->put("user", $request->all());
            return redirect("/");
        }else{
            return redirect()->back()->with("msg", "Username atau Password Salah");
        }   
    }

    public function logout(){
        session()->forget("user");
        return redirect("/login");
    }

    public function daftar_act(Request $request){
        Http::post(env("API_URL")."/process-definition/". env("PROCESS_ID") . "/start", [
            "variables" => [
                "nama" => [
                    "value" => $request->nama,
                    "type" => "String"
                ],
                "email" => [
                    "value" => $request->email,
                    "type" => "String"
                ],
                "nim" => [
                    "value" => $request->nim,
                    "type" => "String"
                ],
                "prodi" => [
                    "value" => $request->prodi,
                    "type" => "String"
                ],
                "tanggal" => [
                    "value" => $request->tanggal,
                    "type" => "String"
                ],
                "keterangan" => [
                    "value" => $request->keterangan,
                    "type" => "String"
                ],
            ]
        ]);      
        // return $task;
        return redirect()->back()->with("msg", "Absen Berhasil");
    }

    public function formulir_act(Request $request){
        Http::post(env("API_URL") . "/task/" . $request->id . "/submit-form", [
            "variables" => [
                "tanggal_pinjam" => [
                    "value" => $request->tanggal_p,
                    "type" => "String"
                ],
                "judul" => [
                    "value" => $request->judul,
                    "type" => "String"
                ],
                "pengarang" => [
                    "value" => $request->pengarang,
                    "type" => "String"
                ],
                "penerbit" => [
                    "value" => $request->penerbit,
                    "type" => "String"
                ],
                "tahun" => [
                    "value" => $request->tahun,
                    "type" => "String"
                ],
            ] 
        ]);
        return redirect("/")->with("msg", "Berhasil mengisi peminjaman buku");
    }

    public function approval_act(Request $request){
        // dd($request);
        $data = [
            "nama" => $request->nama,
            "email" => $request->email,
            "judul_buku" => $request->judul,
            "pengarang" => $request->pengarang,
            "penerbit" => $request->penerbit,
            "tahun_terbit" => $request->tahun_terbit,
            "tanggal_peminjaman" => $request->tanggal,
            "status" => $request->verif,
        ];

        Mail::to($request->email)->send(new CamundoMail($data));

        // DOKUMENTASI
        // if($request->verif === "Ada") {
            // Mail::send('mail.ada', $data, function ($message) use ($request) {
            //     $message->from(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME"));
            //     $message->to($request->email, $request->nama);
            //     $message->subject("Pemberitahuan Berhasil Meminjam Buku");
            // });
            
            // DISPLAY ERROR LARAVEL
            // ini_set('display_errors', 1);
            // ini_set('display_startup_errors', 1);
            // error_reporting(E_ALL);
        // } else {
        //     Mail::send('mail.tidak_ada', $data, function ($message) use ($request) {
        //         $message->from(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME"));
        //         $message->to($request->email, $request->nama);
        //         $message->subject("Pemberitahuan Buku Tidak Tersedia");
        //     });       
        // }

        Http::post(env("API_URL") . '/task/'.$request->id.'/submit-form', [
            'variables' => [
                "decision" => [
                    "value" => $request->verif,
                    "type" => "string",
                ],
            ],
        ]);

        return redirect("/");
    }

}
