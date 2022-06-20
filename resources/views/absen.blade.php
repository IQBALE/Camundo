@extends('main')
@section('Title', 'Dashboard')

@section('Content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-2">Active Instance</h6>
                    </div>
                    @if(session('msg'))
                    <div class="alert alert-success" role="alert">
                        {{session('msg')}}
                    </div>
                    @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Instance</th>
                                <th scope="col">Assign</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($task as $dt)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <th scope="row">{{$dt["id"]}}</th>
                                    <th scope="row">{{$dt["assignee"]}}</th>
                                    <th scope="row">{{$dt["name"]}}</th>
                                    @if($dt["name"]  === "Mengisi Formulir Peminjaman")
                                    <th scope="row"> <a href="/formulir/{{$dt['processInstanceId']}}" type="button">Isi Form</a> </th>
                                    @else
                                    <th scope="row"> <a href="/approval/{{$dt['processInstanceId']}}" type="button">Verifikasi</a> </th>
                                    @endif
                                </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Data diri</h6>
                    <small>*Isi absensi terlebih dahulu</small>
                </div>
               
                <form method="POST" action="/daftarAct" >
                    {{csrf_field()}}
                    <div class="mb-3">
                        <label for="exampleInputNama" class="form-label">Nama Lengkap</label>
                        <input name="nama" type="text" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputAlamat" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" required>
                    </div>
        
                 
                    <div class="mb-3">
                        <label for="exampleInputNama" class="form-label">Nim</label>
                        <input name="nim" type="text" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputUsia" class="form-label">Prodi</label>
                        <input name="prodi" type="text" class="form-control" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="exampleInputAlamat" class="form-label">Tanggal</label>
                        <input name="tanggal" type="date" class="form-control" required >
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputAlamat" class="form-label">Keterangan</label>
                        <input name="keterangan" type="text" class="form-control" required>
                    </div>
                
                    <button class="btn btn-primary w-100" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('Footer')
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">SiBuku</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        </br>
                        Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
@endsection