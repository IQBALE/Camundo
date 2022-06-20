@extends('main')
@section('Title', 'Formulir')

@section('Content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Formulir Peminjaman</h6>
                </div>
                <form method="POST" action="/formulirAct" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="mb-3">
                        <label for="exampleInputNama" class="form-label">Tanggal Peminjaman</label>
                        <input name="id" type="text" class="form-control" value="{{$data[0]['id']}}" hidden  readonly>
                        <input name="tanggal_p" type="date" class="form-control" required>
                    </div>
                 
                    <div class="mb-3">
                        <label for="exampleInputNama" class="form-label">Judul</label>
                        <input name="judul" type="text" class="form-control" required> 
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputUsia" class="form-label">Pengarang</label>
                        <input name="pengarang" type="text" class="form-control" required>
                    </div>
    
                    <div class="mb-3">
                        <label for="exampleInputAlamat" class="form-label">Penerbit</label>
                        <input name="penerbit" type="text" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputAlamat" class="form-label">Tahun Terbit</label>
                        <input name="tahun" type="text" class="form-control" required>
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