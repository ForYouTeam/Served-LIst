@extends('layout.Base')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Data Prioritas</h5>
        </div>
        <div class="card-block tab-icon">
            <!-- Row start -->
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs  tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#table" role="tab" aria-expanded="true"><i
                                    class="fa-solid fa-table-list"></i> Table</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#form" role="tab" aria-expanded="false"><i
                                    class="fa-solid fa-plus"></i> Tambah Prioritas</a>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabs card-block">
                        <div class="mt-2 tab-pane active" id="table" role="tabpanel" aria-expanded="true">
                            <blockquote class="blockquote">
                                <p class="m-b-0">Hati-hati dalam <b class="text-danger">menghapus</b> data, pastikan
                                    data tidak terelasi dengan tabel lainya.</p>
                                <footer class="blockquote-footer">Tabel Data Prioritas
                                </footer>
                            </blockquote>
                            <div class="card-block table-border-style">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="tableData">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px;">#</th>
                                                <th>Nama Prioritas</th>
                                                <th>Deadline</th>
                                                <th>Color</th>
                                                <th style="width: 100px;">Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($data as $d)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $d->nama_prioritas }}</td>
                                                    <td>{{ $d->deadline }} Hari</td>
                                                    <td><button class="btn btn-icon"
                                                            style="background: {{ $d->color }};"></button></td>
                                                    <td>
                                                        <button id="btn-edit"
                                                            class="btn waves-effect waves-light btn-primary btn-icon"
                                                            data-id="{{ Crypt::encrypt($d->id) }}"><i
                                                                class="fa-solid fa-square-pen"
                                                                style="padding: 10px 10px 10px;"></i></button>
                                                        <button id="btn-hapus"
                                                            class="btn waves-effect waves-light btn-inverse btn-icon"
                                                            data-id="{{ Crypt::encrypt($d->id) }}"><i
                                                                class="fa-solid fa-trash-can"
                                                                style="padding: 10px 10px 10px;"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="form" role="tabpanel" aria-expanded="false">
                            <div style="padding: 35px 100px 0px">
                                <blockquote class="blockquote">
                                    <p class="m-b-0">Pastikan semua field terisi.</p>
                                    <footer class="blockquote-footer">Formulir Pengimputan Data
                                    </footer>
                                </blockquote>
                                <hr>
                            </div>
                            <form id="form-simpan" class="row" style="padding: 8px 100px 9px;">
                                @csrf
                                <div class="col-md-12 form-group">
                                    <label class="col-form-label">Nama Prioritas</label>
                                    <input name="nama_prioritas" type="text" class="form-control mt-2"
                                        placeholder="klik disini!" autocomplete="off">
                                    <small class="text-danger" id="nama_prioritas-alert"></small>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="col-form-label">Deadline (Hari)</label>
                                    <input name="deadline" type="number" class="form-control mt-2"
                                        placeholder="Satuan Hari" autocomplete="off">
                                    <small class="text-danger" id="deadline-alert"></small>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="col-form-label">Color</label>
                                    <input type="color" name="color" class="form-control" autocomplete="off">
                                    <small class="text-danger" id="color-alert"></small>
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="button" id="btn-simpan"
                                        class="float-right btn waves-effect waves-light btn-primary"><i
                                            class="fa-solid fa-paper-plane"></i></i>Kirim Formulir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end -->
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#tableData').DataTable();
        });

        $(document).on('click', '#btn-simpan', function() {
            let url = `{{ config('app.url') }}` + "/api/prioritas";
            let data = $('#form-simpan').serialize();
            $('#btn-simpan').prop('disabled', true);
            $.ajax({
                url: url,
                method: "POST",
                data: data,
                success: function(result) {
                    Swal.fire({
                        title: result.response.title,
                        text: result.response.message,
                        icon: result.response.icon,
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oke'
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(result) {
                    $('#btn-simpan').prop('disabled', false);
                    let data = result.responseJSON
                    let errorRes = data.errors
                    Swal.fire({
                        icon: data.response.icon,
                        title: data.response.title,
                        text: data.response.message,
                    });
                    if (errorRes.length >= 1) {
                        $('.miniAlert').html('');
                        $('#nama_prioritas-alert').html(errorRes.data.nama_prioritas);
                        $('#deadline-alert').html(errorRes.data.deadline);
                        $('#color-alert').html(errorRes.data.color);
                    }
                }
            });
        });

        $(document).on('click', '#btn-edit', function() {
            let _id = $(this).data('id');
            let url = `{{ config('app.url') }}/api/prioritas/${_id}`;

            $.ajax({
                url: url,
                method: "GET",
                success: function(result) {
                    $('.modal-title').html('Form Ubah Data');
                    $('#form-update').html('');
                    $('#form-update').append(`
                    <div class="row card-body" style="padding: 30px 120px 42px">
                        <div class="col-md-12 form-group">
                            <label class="col-form-label">Nama Prioritas</label>
                            <input type="hidden" id="idPrioritas" value="${_id}">
                            <input name="nama_prioritas" type="text" class="form-control mt-2"
                                placeholder="klik disini!" autocomplete="off" value="${result.data.nama_prioritas}">
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="col-form-label">Deadline (Hari)</label>
                            <input name="deadline" type="number" class="form-control mt-2"
                                    placeholder="klik disini!" autocomplete="off" value="${result.data.deadline}">
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="col-form-label">Color</label>
                            <input type="color" name="color" class="form-control" autocomplete="off" value="${result.data.color}">
                        </div>
                        <blockquote class="blockquote mt-3">
                            <p class="m-b-0">Pastikan semua field terisi sebelum mengirim formulir.</p>
                        </blockquote>    
                    </div>
                    `);
                    $('#modalUniv').modal('show');
                },
                error: function(result) {
                    let data = result.responseJSON
                    let errorRes = data.errors
                    Swal.fire({
                        icon: data.response.icon,
                        title: data.response.title,
                        text: data.response.message,
                    });
                }
            });
        });

        $(document).on('click', '#btn-update', function() {
            let _id = $('#idPrioritas').val();
            let url = `{{ config('app.url') }}/api/prioritas/${_id}`;
            let data = $('#form-update').serialize();
            $('#btn-edit').prop('disabled', true);
            $('#modalUniv').modal('hide');
            $.ajax({
                url: url,
                method: "PATCH",
                data: data,
                success: function(result) {
                    Swal.fire({
                        title: result.response.title,
                        text: result.response.message,
                        icon: result.response.icon,
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oke'
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(result) {
                    $('#btn-edit').prop('disabled', false);
                    let data = result.responseJSON
                    let errorRes = data.errors
                    Swal.fire({
                        icon: data.response.icon,
                        title: data.response.title,
                        text: data.response.message,
                    });
                    if (errorRes.length >= 1) {
                        $('.miniAlert').html('');
                        $('#nama_prioritas-alert').html(errorRes.data.nama_prioritas);
                        $('#deadline-alert').html(errorRes.data.deadline);
                        $('#color-alert').html(errorRes.data.color);
                    }
                }
            });
        });

        $(document).on('click', '#btn-hapus', function() {
            let _id = $(this).data('id');
            let url = `{{ config('app.url') }}/api/prioritas/${_id}`;
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data ini mungkin terhubung ke tabel yang lain!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus'
            }).then((res) => {
                if (res.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'delete',
                        success: function(result) {
                            let data = result.data;
                            Swal.fire({
                                title: result.response.title,
                                text: result.response.message,
                                icon: result.response.icon,
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Oke'
                            }).then((result) => {
                                location.reload();
                            });
                        },
                        error: function(result) {
                            let data = result.responseJSON
                            Swal.fire({
                                icon: data.response.icon,
                                title: data.response.title,
                                text: data.response.message,
                            });
                        }
                    });
                }
            })
        });
    </script>
@endsection
