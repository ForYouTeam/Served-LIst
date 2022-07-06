@extends('layout.Base')
@section('content')
    <div class="card">
        <div class="row" style="padding: 20px 25px 0px;">
            <div class="col-md-4">
                <p style="font-size: 12pt; color: #789395; margin-bottom: 0px;">Board Page / Username</p>
                <h3>Semua Task</h3>
            </div>
            <div class="col-md-8 text-right" style="padding-top: 25px;">
                <span class="mr-3" style="font-size: 12pt; color: #789395;"><i class="ti-receipt"></i> 10 Total
                    Task</span>
                <button id="btn-tambah" class="btn btn-primary waves-effect waves-light" style="border-radius: 4px;">Tambah
                    Task
                    Baru</button>
            </div>
        </div>
        <div class="row" style="padding: 31px 25px 30px">
            <div class="col-md-3 mb-2">
                <input type="text" class="form-control form-control-round" placeholder="Search">
            </div>
            <div class="col-md-9">
                <span class="float-right">
                    <label style="color: #789395;" for="" class="form-label mr-2">GROUP BY</label>
                    <div class="dropdown-primary dropdown open">
                        <button style="color: #789395; width: 90px;"
                            class="btn btn-sm btn-default dropdown-toggle waves-effect waves-light " type="button"
                            id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">- Pilih
                            -</button>
                        <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn"
                            data-dropdown-out="fadeOut" x-placement="bottom-start"
                            style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <button type="button" class="dropdown-item waves-light waves-effect">Action</button>
                        </div>
                    </div>
                </span>
            </div>
        </div>

        <div id="all-height" class="row" style="padding: 0px 25px 50px;">
            {{-- CARD TODO --}}
            <div class="col-md-3" style="padding: 2px 7px">
                <div data-id="todo" class="card myStatus"
                    style="padding: 0px 0px 6px; color: #748DA6; background: rgba(156, 180, 204, 0.199)">
                    <p style="font-size: 15pt; font-weight: 500; margin: 20px 15px 20px">Todo</p>
                    @foreach ($data as $d)
                        @if ($d->status == 'todo')
                            <div data-id="{{ $d->id }}" draggable="true" class="card-block bg-white myBox myTask"
                                style="margin: 3px 5px; padding: 15px;">
                                <div class="row">
                                    <div class="col-sm-12" style="color: black; font-size: 12pt;">{{ $d->nama_task }}
                                        <button data-id="{{ $d->id }}" id="btn-hapus" type="button"
                                            class="rmBg float-right"><i class="ti-trash"></i></button>
                                        <button data-id="{{ $d->id }}" id="btn-edit" type="button"
                                            class="rmBg float-right"><i class="ti-pencil"></i></button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <label class="label label-md"
                                            style="background: #{{ $d->prioritasRole->color }}">{{ $d->prioritasRole->nama_prioritas }}</label>
                                    </div>
                                </div>
                                <div class="row" style="padding: 15px 0px 0px">
                                    <div class="col-sm-12">
                                        <i class="ti-alarm-clock"></i> Deadline
                                        {{ date('d F', strtotime($d->created_at . '+' . $d->prioritasRole->deadline . 'days')) }}
                                        <span class="float-right">
                                            <button style="margin-top: -10px;"
                                                class="float-right btn btn-sm waves-effect waves-light btn-secondary btn-icon"
                                                data-toggle="tooltip" data-placement="top" data-trigger="hover"
                                                title="" data-original-title="{{ $d->staffRole->nama }}">
                                                {{ Str::of($d->staffRole->nama)->limit(3) }}
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            {{-- BATASSSS --}}
            {{-- CARD IN PROGRESS --}}
            <div class="col-md-3" style="padding: 2px 7px">
                <div data-id="inprogress" class="card myStatus"
                    style="padding: 0px 0px 6px; color: #748DA6; background: rgba(156, 180, 204, 0.199)">
                    <p style="font-size: 15pt; font-weight: 500; margin: 20px 15px 20px">In Progress</p>
                    @foreach ($data as $d)
                        @if ($d->status == 'inprogress')
                            <div data-id="{{ $d->id }}" draggable="true" class="card-block bg-white myBox myTask"
                                style="margin: 3px 5px; padding: 15px;">
                                <div class="row">
                                    <div class="col-sm-12" style="color: black; font-size: 12pt;">{{ $d->nama_task }}
                                        <button data-id="{{ $d->id }}" id="btn-hapus" type="button"
                                            class="rmBg float-right"><i class="ti-trash"></i></button>
                                        <button data-id="{{ $d->id }}" id="btn-edit" type="button"
                                            class="rmBg float-right"><i class="ti-pencil"></i></button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <label class="label label-md"
                                            style="background: #{{ $d->prioritasRole->color }}">{{ $d->prioritasRole->nama_prioritas }}</label>
                                    </div>
                                </div>
                                <div class="row" style="padding: 15px 0px 0px">
                                    <div class="col-sm-12">
                                        <i class="ti-alarm-clock"></i> Deadline
                                        {{ date('d F', strtotime($d->created_at . '+' . $d->prioritasRole->deadline . 'days')) }}
                                        <span class="float-right">
                                            <button style="margin-top: -10px;"
                                                class="float-right btn btn-sm waves-effect waves-light btn-secondary btn-icon"
                                                data-toggle="tooltip" data-placement="top" data-trigger="hover"
                                                title="" data-original-title="{{ $d->staffRole->nama }}">
                                                {{ Str::of($d->staffRole->nama)->limit(3) }}
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            {{-- BATASSSS --}}
            {{-- CARD REVIEW --}}
            <div class="col-md-3" style="padding: 2px 7px">
                <div data-id="review" class="card myStatus"
                    style="padding: 0px 0px 6px; color: #748DA6; background: rgba(156, 180, 204, 0.199)">
                    <p style="font-size: 15pt; font-weight: 500; margin: 20px 15px 20px">Review</p>
                    @foreach ($data as $d)
                        @if ($d->status == 'review')
                            <div data-id="{{ $d->id }}" draggable="true" class="card-block bg-white myBox myTask"
                                style="margin: 3px 5px; padding: 15px;">
                                <div class="row">
                                    <div class="col-sm-12" style="color: black; font-size: 12pt;">{{ $d->nama_task }}
                                        <button data-id="{{ $d->id }}" id="btn-hapus" type="button"
                                            class="rmBg float-right"><i class="ti-trash"></i></button>
                                        <button data-id="{{ $d->id }}" id="btn-edit" type="button"
                                            class="rmBg float-right"><i class="ti-pencil"></i></button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <label class="label label-md"
                                            style="background: #{{ $d->prioritasRole->color }}">{{ $d->prioritasRole->nama_prioritas }}</label>
                                    </div>
                                </div>
                                <div class="row" style="padding: 15px 0px 0px">
                                    <div class="col-sm-12">
                                        <i class="ti-alarm-clock"></i> Deadline
                                        {{ date('d F', strtotime($d->created_at . '+' . $d->prioritasRole->deadline . 'days')) }}
                                        <span class="float-right">
                                            <button style="margin-top: -10px;"
                                                class="float-right btn btn-sm waves-effect waves-light btn-secondary btn-icon"
                                                data-toggle="tooltip" data-placement="top" data-trigger="hover"
                                                title="" data-original-title="{{ $d->staffRole->nama }}">
                                                {{ Str::of($d->staffRole->nama)->limit(3) }}
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            {{-- BATASSSS --}}
            {{-- CARD DONE --}}
            <div class="col-md-3" style="padding: 2px 7px">
                <div data-id="done" class="card myStatus"
                    style="padding: 0px 0px 6px; color: #748DA6; background: rgba(156, 180, 204, 0.199)">
                    <p style="font-size: 15pt; font-weight: 500; margin: 20px 15px 20px">Done</p>
                    @foreach ($data as $d)
                        @if ($d->status == 'done')
                            <div data-id="{{ $d->id }}" draggable="true" class="card-block bg-white myBox myTask"
                                style="margin: 3px 5px; padding: 15px;">
                                <div class="row">
                                    <div class="col-sm-12" style="color: black; font-size: 12pt;">{{ $d->nama_task }}
                                        <button data-id="{{ $d->id }}" id="btn-hapus" type="button"
                                            class="rmBg float-right"><i class="ti-trash"></i></button>
                                        <button data-id="{{ $d->id }}" id="btn-edit" type="button"
                                            class="rmBg float-right"><i class="ti-pencil"></i></button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <label class="label label-md"
                                            style="background: #{{ $d->prioritasRole->color }}">{{ $d->prioritasRole->nama_prioritas }}</label>
                                    </div>
                                </div>
                                <div class="row" style="padding: 15px 0px 0px">
                                    <div class="col-sm-12">
                                        <i class="ti-alarm-clock"></i> Deadline
                                        {{ date('d F', strtotime($d->created_at . '+' . $d->prioritasRole->deadline . 'days')) }}
                                        <span class="float-right">
                                            <button style="margin-top: -10px;"
                                                class="float-right btn btn-sm waves-effect waves-light btn-secondary btn-icon"
                                                data-toggle="tooltip" data-placement="top" data-trigger="hover"
                                                title="" data-original-title="{{ $d->staffRole->nama }}">
                                                {{ Str::of($d->staffRole->nama)->limit(3) }}
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            {{-- BATASSSS --}}
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
        });

        let form = `
            <div class="row" style="padding: 10px 3px;">
                <div class="col-md-6 form-group">
                    <label class="col-form-label">Nama Task</label>
                    <input name="nama_task" type="text" class="form-control mt-2" placeholder="Klik disini"
                        autocomplete="off">
                    <small class="text-danger" id="nama_task-alert"></small>
                </div>
                <div class="col-md-6 form-group">
                    <label class="col-form-label">Kode Task</label>
                    <input name="code_task" type="text" class="form-control mt-2" placeholder="Klik disini"
                        autocomplete="off">
                    <small class="text-danger" id="code_task-alert"></small>
                </div>
                <div class="col-md-6 form-group">
                    <label class="col-form-label">Prioritas</label>
                    <select name="level_prioritas" class="form-control form-control-sm">
                        <option selected disabled>Select One Value Only</option>
                    </select>
                    <small class="text-danger" id="level_prioritas-alert"></small>
                </div>
                <div class="col-md-6 form-group">
                    <label class="col-form-label">Staff</label>
                    <select name="id_staff" class="form-control form-control-sm">
                        <option selected disabled>Select One Value Only</option>
                    </select>
                    <small class="text-danger" id="id_staff-alert"></small>
                </div>
                <div class="col-md-12 form-group">
                    <label class="col-form-label">Tag</label>
                    <input name="tags" type="text" class="form-control" placeholder="Tag baru atau pilih"
                        autocomplete="off">
                    <small class="text-danger" id="tags-alert"></small>
                </div>
                <div class="col-md-12 form-group">
                    <label class="col-form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="8" cols="5" class="form-control" placeholder="Masukan Deskripsi"></textarea>
                    <small class="text-danger" id="deskripsi-alert"></small>
                </div>
            </div>
        `

        $(document).on('click', '#btn-tambah', function() {
            $('#modalUniv').modal('show');
            $('#form-update').html('');
            $('#form-update').append(form);
            $('.modal-title').html('Buat Task Baru');
            let url = `{{ config('app.url') }}/api/prioritas/`;
            $.get(url, function(result) {
                $('select[name="level_prioritas"]').html(
                    `<option selected disabled>Select One Value Only</option>`
                );

                $.each(result.data, function(i, value) {
                    $('select[name="level_prioritas"]').append(
                        `<option value="${value.id}">${value.nama_prioritas}</option>`
                    );
                });
            });

            url = `{{ config('app.url') }}/api/staff/`;
            $.get(url, function(result) {
                $('select[name="id_staff"]').html(
                    `<option selected disabled>Select One Value Only</option>`
                );

                $.each(result.data, function(i, value) {
                    $('select[name="id_staff"]').append(
                        `<option value="${value.id}">${value.nama}</option>`
                    );
                });
            });

            url = `{{ config('app.url') }}/api/tag/`;
            $.get(url, function(result) {
                let sugest = [];
                $.each(result.data, function(i, val) {
                    sugest[i] = {
                        tag: val.nama_tag,
                        value: val.id
                    }
                });
                $('input[name="tags"]').amsifySuggestags({
                    type: 'bootstrap',
                    suggestions: sugest,
                    tagLimit: 5
                });
            });
        });

        let carId = null;
        const updateStatus = (stat) => {
            let url = `{{ config('app.url') }}/api/task/realtimeUpdate/${carId}`;
            let data = {
                status: stat
            }
            $.ajax({
                type: "PATCH",
                url: url,
                data: data,
            });
        }

        const mytask = document.querySelectorAll('.myTask');
        const mystatus = document.querySelectorAll('.myStatus');
        let draggableTask = null;

        mytask.forEach((task) => {
            task.addEventListener("dragstart", dragStart);
            task.addEventListener("dragend", dragEnd);
        });

        mystatus.forEach((status) => {
            status.addEventListener("dragover", dragOver);
            status.addEventListener("dragenter", dragEnter);
            status.addEventListener("dragleave", dragLeave);
            status.addEventListener("drop", drop);
        });

        function dragStart() {
            draggableTask = this;
            carId = this.getAttribute('data-id');
        }

        function dragEnd() {
            draggableTask = null;

        }

        function dragOver(e) {
            e.preventDefault();

        }

        function dragEnter() {
            this.style.border = "1px solid #ccc";
        }

        function dragLeave() {
            this.style.border = "none";
        }

        function drop() {
            this.appendChild(draggableTask);
            this.style.border = "none";
            let _id = this.getAttribute('data-id');
            updateStatus(_id);
        }

        $(document).on('click', '#btn-update', function() {
            let url = `{{ config('app.url') }}/api/task/`;
            let data = $('#form-update').serialize();

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function(result) {
                    console.log(result);
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
                error: function(err) {
                    $('#modalUniv').modal('hide');
                    let res = err.responseJSON;
                    let errorRes = res.errors;
                    console.log(res);
                    Swal.fire({
                        icon: res.response.icon,
                        title: res.response.title,
                        text: res.response.message,
                    }).then(() => {
                        $('#modalUniv').modal('show');
                        if (errorRes.length >= 1) {
                            $('.miniAlert').html('');
                            $.each(errorRes.data, function(i, value) {
                                $(`#${i}-alert`).html(value);
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
