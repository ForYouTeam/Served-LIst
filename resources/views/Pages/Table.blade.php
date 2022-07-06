@extends('layout.Base')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Data Contoh</h5>
        </div>
        <div class="card-block tab-icon">
            <div class="row" style="padding: 8px 300px 9px;">
                <div class="col-md-6 form-group">
                    <label class="col-form-label">Nama Task</label>
                    <input type="text" class="form-control mt-2" placeholder="Klik disini" autocomplete="off">
                    <small class="text-danger" id="nama_task-alert"></small>
                </div>
                <div class="col-md-6 form-group">
                    <label class="col-form-label">Kode Task</label>
                    <input type="text" class="form-control mt-2" placeholder="Klik disini" autocomplete="off">
                    <small class="text-danger" id="code_task-alert"></small>
                </div>
                <div class="col-md-6 form-group">
                    <label class="col-form-label">Prioritas</label>
                    <select name="select" class="form-control form-control-sm">
                        <option selected disabled>Select One Value Only</option>
                    </select>
                    <small class="text-danger" id="prioritas-alert"></small>
                </div>
                <div class="col-md-12 form-group">
                    <label class="col-form-label">Tag</label>
                    <input name="tags" type="text" class="form-control mt-2" placeholder="Klik disini"
                        autocomplete="off">
                    <small class="text-danger" id="label-name-alert"></small>
                </div>
                <div class="col-md-12 form-group">
                    <label class="col-form-label">Deskripsi</label>
                    <textarea rows="8" cols="5" class="form-control" placeholder="Masukan Deskripsi"></textarea>
                </div>
                <div class="col-md-12 form-group">
                    <button class="float-right btn btn-sm waves-effect waves-light btn-primary"><i
                            class="fa-solid fa-paper-plane"></i></i>Kirim Formulir</button>
                    <button type="button" id="button-modal"
                        class="float-right mr-2 btn btn-sm waves-effect waves-light btn-secondary">Open
                        Modal</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('input[name="tags"]').amsifySuggestags({
            suggestions: [{
                    tag: 'Blue',
                    value: 1,
                    background: '#3AB0FF',
                    color: 'white'
                },
                {
                    tag: 'Orange',
                    value: 6,
                    background: '#F15412',
                    color: 'white'
                }
            ],
            tagLimit: 5
        });
    </script>
@endsection
