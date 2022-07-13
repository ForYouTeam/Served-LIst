@extends('layout.Base')
@section('content')
    <div class="card">
        <div class="row" style="padding: 20px 25px 30px;">
            <div class="col-md-4">
                <p style="font-size: 12pt; color: #789395; margin-bottom: 0px;">Board Page / Username</p>
                <h3>Semua Task</h3>
            </div>
            <div class="col-md-8 text-right" style="padding-top: 5px;">
                <span class="mr-3" style="font-size: 12pt; color: #789395;"><i class="ti-receipt"></i> {{ count($data) }}
                    Total
                    Task</span>
                <button id="btn-tambah" class="btn btn-primary waves-effect waves-light" style="border-radius: 4px;">Tambah
                    Task
                    Baru</button>
            </div>
        </div>

        <div id="all-height" class="row" style="padding: 0px 25px 50px;">
            {{-- CARD TODO --}}
            <div class="col-md-3" style="padding: 2px 7px">
                <div data-id="todo" data-color="#333C83" class="card myStatus"
                    style="padding: 0px 0px 6px; color: #748DA6; background: rgba(156, 180, 204, 0.199)">
                    <p style="font-size: 15pt; font-weight: 500; margin: 20px 15px 20px">Todo</p>
                    @foreach ($data as $d)
                        @if ($d->status == 'todo')
                            <div data-id="{{ $d->id }}" draggable="true" class="card-block bg-white myBox myTask"
                                style="margin: 3px 5px; padding: 15px;">
                                <div class="row">
                                    <div class="col-sm-10" style="color: black; font-size: 12pt;">{{ $d->nama_task }}
                                    </div>
                                    <div class="col-sm-2">
                                        <button data-id="{{ $d->id }}" id="btn-edit" type="button"
                                            class="rmBg float-right"><i class="ti-pencil"></i></button>
                                        <button data-id="{{ $d->id }}" id="btn-hapus" type="button"
                                            class="rmBg float-right"><i class="ti-trash"></i></button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <label class="label label-md"
                                            style="background: {{ $d->prioritasRole->color }}">{{ $d->prioritasRole->nama_prioritas }}</label>
                                    </div>
                                </div>
                                <div class="row" style="padding: 15px 0px 0px">
                                    <div class="col-sm-12">
                                        <i class="ti-alarm-clock"></i> Deadline
                                        {{ date('d F', strtotime($d->created_at . '+' . $d->prioritasRole->deadline . 'days')) }}
                                        <span class="float-right">
                                            <button id="button-{{ $d->id }}"
                                                style="margin-top: -10px; background: #333C83; color: white;"
                                                class="float-right btn btn-sm waves-effect waves-light btn-icon"
                                                data-toggle="tooltip" data-placement="top" data-trigger="hover"
                                                title="" data-original-title="{{ $d->staffRole->nama }}">
                                                {{ Str::of($d->staffRole->nama)->limit(3) }}
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-sm-12">
                                        @foreach ($d->tagsRole as $d)
                                            <span class="my-cotume-tag">
                                                {{ $d->tagRole->nama_tag }}
                                            </span>
                                        @endforeach
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
                <div data-id="inprogress" data-color="#F24A72" class="card myStatus"
                    style="padding: 0px 0px 6px; color: #748DA6; background: rgba(156, 180, 204, 0.199)">
                    <p style="font-size: 15pt; font-weight: 500; margin: 20px 15px 20px">In Progress</p>
                    @foreach ($data as $d)
                        @if ($d->status == 'inprogress')
                            <div data-id="{{ $d->id }}" draggable="true" class="card-block bg-white myBox myTask"
                                style="margin: 3px 5px; padding: 15px;">
                                <div class="row">
                                    <div class="col-sm-10" style="color: black; font-size: 12pt;">{{ $d->nama_task }}
                                    </div>
                                    <div class="col-sm-2">
                                        <button data-id="{{ $d->id }}" id="btn-edit" type="button"
                                            class="rmBg float-right"><i class="ti-pencil"></i></button>
                                        <button data-id="{{ $d->id }}" id="btn-hapus" type="button"
                                            class="rmBg float-right"><i class="ti-trash"></i></button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <label class="label label-md"
                                            style="background: {{ $d->prioritasRole->color }}">{{ $d->prioritasRole->nama_prioritas }}</label>
                                    </div>
                                </div>
                                <div class="row" style="padding: 15px 0px 0px">
                                    <div class="col-sm-12">
                                        <i class="ti-alarm-clock"></i> Deadline
                                        {{ date('d F', strtotime($d->created_at . '+' . $d->prioritasRole->deadline . 'days')) }}
                                        <span class="float-right">
                                            <button id="button-{{ $d->id }}"
                                                style="margin-top: -10px; background: #F24A72; color: white;"
                                                class="float-right btn btn-sm waves-effect waves-light btn-icon"
                                                data-toggle="tooltip" data-placement="top" data-trigger="hover"
                                                title="" data-original-title="{{ $d->staffRole->nama }}">
                                                {{ Str::of($d->staffRole->nama)->limit(3) }}
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-sm-12">
                                        @foreach ($d->tagsRole as $d)
                                            <span class="my-cotume-tag">
                                                {{ $d->tagRole->nama_tag }}
                                            </span>
                                        @endforeach
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
                <div data-id="review" data-color="#FDAF75" class="card myStatus"
                    style="padding: 0px 0px 6px; color: #748DA6; background: rgba(156, 180, 204, 0.199)">
                    <p style="font-size: 15pt; font-weight: 500; margin: 20px 15px 20px">Review</p>
                    @foreach ($data as $d)
                        @if ($d->status == 'review')
                            <div data-id="{{ $d->id }}" draggable="true" class="card-block bg-white myBox myTask"
                                style="margin: 3px 5px; padding: 15px;">
                                <div class="row">
                                    <div class="col-sm-10" style="color: black; font-size: 12pt;">{{ $d->nama_task }}
                                    </div>
                                    <div class="col-sm-2">
                                        <button data-id="{{ $d->id }}" id="btn-edit" type="button"
                                            class="rmBg float-right"><i class="ti-pencil"></i></button>
                                        <button data-id="{{ $d->id }}" id="btn-hapus" type="button"
                                            class="rmBg float-right"><i class="ti-trash"></i></button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <label class="label label-md"
                                            style="background: {{ $d->prioritasRole->color }}">{{ $d->prioritasRole->nama_prioritas }}</label>
                                    </div>
                                </div>
                                <div class="row" style="padding: 15px 0px 0px">
                                    <div class="col-sm-12">
                                        <i class="ti-alarm-clock"></i> Deadline
                                        {{ date('d F', strtotime($d->created_at . '+' . $d->prioritasRole->deadline . 'days')) }}
                                        <span class="float-right">
                                            <button id="button-{{ $d->id }}"
                                                style="margin-top: -10px; background: #FDAF75; color: white;"
                                                class="float-right btn btn-sm waves-effect waves-light btn-icon"
                                                data-toggle="tooltip" data-placement="top" data-trigger="hover"
                                                title="" data-original-title="{{ $d->staffRole->nama }}">
                                                {{ Str::of($d->staffRole->nama)->limit(3) }}
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-sm-12">
                                        @foreach ($d->tagsRole as $d)
                                            <span class="my-cotume-tag">
                                                {{ $d->tagRole->nama_tag }}
                                            </span>
                                        @endforeach
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
                <div data-id="done" data-color="#3A3845" class="card myStatus"
                    style="padding: 0px 0px 6px; color: #748DA6; background: rgba(156, 180, 204, 0.199)">
                    <p style="font-size: 15pt; font-weight: 500; margin: 20px 15px 20px">Done</p>
                    @foreach ($data as $d)
                        @if ($d->status == 'done')
                            <div data-id="{{ $d->id }}" draggable="true" class="card-block bg-white myBox myTask"
                                style="margin: 3px 5px; padding: 15px;">
                                <div class="row">
                                    <div class="col-sm-10" style="color: black; font-size: 12pt;">{{ $d->nama_task }}
                                    </div>
                                    <div class="col-sm-2">
                                        <button data-id="{{ $d->id }}" id="btn-edit" type="button"
                                            class="rmBg float-right"><i class="ti-pencil"></i></button>
                                        <button data-id="{{ $d->id }}" id="btn-hapus" type="button"
                                            class="rmBg float-right"><i class="ti-trash"></i></button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <label class="label label-md"
                                            style="background: {{ $d->prioritasRole->color }}">{{ $d->prioritasRole->nama_prioritas }}</label>
                                    </div>
                                </div>
                                <div class="row" style="padding: 15px 0px 0px">
                                    <div class="col-sm-12">
                                        <i class="ti-alarm-clock"></i> Deadline
                                        {{ date('d F', strtotime($d->created_at . '+' . $d->prioritasRole->deadline . 'days')) }}
                                        <span class="float-right">
                                            <button id="button-{{ $d->id }}"
                                                style="margin-top: -10px; background: #3A3845; color:white;"
                                                class="float-right btn btn-sm waves-effect waves-light btn-icon"
                                                data-toggle="tooltip" data-placement="top" data-trigger="hover"
                                                title="" data-original-title="{{ $d->staffRole->nama }}">
                                                {{ Str::of($d->staffRole->nama)->limit(3) }}
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-sm-12">
                                        @foreach ($d->tagsRole as $d)
                                            <span class="my-cotume-tag">
                                                {{ $d->tagRole->nama_tag }}
                                            </span>
                                        @endforeach
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
                <input type="hidden" name="id" value="">
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
                    <input id="tags-form" name="tags" type="text" class="form-control" placeholder="Tag baru atau pilih"
                        autocomplete="off" value="">
                    <small class="text-danger" id="tags-alert"></small>
                </div>
                <div class="col-md-12 form-group">
                    <label class="col-form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="8" cols="5" class="form-control" placeholder="Masukan Deskripsi"></textarea>
                    <small class="text-danger" id="deskripsi-alert"></small>
                </div>
            </div>
        `

        const showForm = (defval, idtask) => {
            $('#tags-form').val(defval);
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
                    tagLimit: 5,
                    afterRemove: function(value) {
                        let tagurl = `{{ config('app.url') }}/api/task/del/${value}/${idtask}`
                        $.ajax({
                            type: "DELETE",
                            url: tagurl,
                            success: (res) => {
                                console.log(res);
                            },
                            error: (err) => {
                                console.log(err);
                            }
                        })
                    },
                });
            });
        }

        $(document).on('click', '#btn-tambah', function() {
            $('#modalUniv').modal('show');
            $('#form-update').html('');
            $('#form-update').append(form);
            $('.modal-title').html('Buat Task Baru');
            $('#btn-modif').attr('id', 'btn-update');
            showForm([], null);
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
        let color = '';

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
            let idTask = this.getAttribute('data-id');
            $('#button-' + idTask).css("background", color);
        }

        function dragOver(e) {
            e.preventDefault();

        }

        function dragEnter() {
            this.style.border = "1px solid #ccc";
            color = this.getAttribute('data-color');
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
                    $('#modalUniv').modal('hide');
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

        $(document).on('click', '#btn-edit', function() {
            let timerInterval;
            let tag = [];
            Swal.fire({
                title: 'Sabar Ya!',
                html: 'Dapatkan data dalam <b></b> milliseconds.',
                timer: 1000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100);
                    $('#form-update').html('');
                    $('#form-update').append(form);
                    $('.modal-title').html('Buat Task Baru');
                    $('#btn-update').attr('id', 'btn-modif');
                    let _id = $(this).data('id');
                    let url = `{{ config('app.url') }}/api/task/get/${_id}`;
                    $.get(url, function(result) {
                        let tags = result.data.tags_role;
                        tags.forEach(el => {
                            tag.push(el.tag_role.nama_tag);
                        });
                        showForm(tag.join(), _id);
                        $('input[name="id"]').val(result.data.id);
                        $('input[name="nama_task"]').val(result.data.nama_task);
                        $('input[name="code_task"]').val(result.data.code_task);
                        $('textarea[name="deskripsi"]').val(result.data.deskripsi);
                        setTimeout(() => {
                            $('select[name="level_prioritas"]').val(result.data
                                .level_prioritas);
                            $('select[name="id_staff"]').val(result.data.id_staff);
                        }, 500);
                    })
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    $('#modalUniv').modal('show');
                }
            })
        });

        $(document).on('click', '#btn-modif', function() {
            let _id = $('input[name="id"]').val();
            let url = `{{ config('app.url') }}/api/task/realtimeUpdate/${_id}`;
            let data = $('#form-update').serialize();

            $.ajax({
                type: "PATCH",
                url: url,
                data: data,
                success: function(result) {
                    $('#modalUniv').modal('hide');
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

        $(document).on('click', '#btn-hapus', function() {
            let _id = $(this).data('id');
            let url = `{{ config('app.url') }}/api/task/delete_task/${_id}`;
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
