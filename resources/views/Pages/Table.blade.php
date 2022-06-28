@extends('layout.Base')
@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Data Contoh</h5>
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
                                    class="fa-solid fa-plus"></i> Tambah Data</a>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabs card-block">
                        <div class="mt-2 tab-pane active" id="table" role="tabpanel" aria-expanded="true">
                            <blockquote class="blockquote">
                                <p class="m-b-0">Hati-hati dalam <b class="text-danger">menghapus</b> data, pastikan
                                    data tidak terelasi dengan tabel lainya.</p>
                                <footer class="blockquote-footer">Tabel Data
                                </footer>
                            </blockquote>
                            <div class="card-block table-border-style">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="tableData">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
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
                            <form class="row" style="padding: 8px 100px 9px;">
                                <div class="col-md-6 form-group">
                                    <label class="col-form-label">Lable Name</label>
                                    <input type="text" class="form-control mt-2" placeholder="Autocomplete Off"
                                        autocomplete="off">
                                    <small class="text-danger" id="label-name-alert"></small>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="col-form-label">Select Box</label>
                                    <select name="select" class="form-control form-control-sm">
                                        <option selected disabled>Select One Value Only</option>
                                    </select>
                                    <small class="text-danger" id="label-name-alert"></small>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label class="col-form-label">Textarea</label>
                                    <textarea rows="5" cols="5" class="form-control" placeholder="Default textarea"></textarea>
                                    <small class="text-danger" id="label-name-alert"></small>
                                </div>
                                <div class="col-md-12 form-group">
                                    <button class="float-right btn btn-sm waves-effect waves-light btn-primary"><i
                                            class="fa-solid fa-paper-plane"></i></i>Kirim Formulir</button>
                                    <button type="button" id="button-modal"
                                        class="float-right mr-2 btn btn-sm waves-effect waves-light btn-secondary">Open
                                        Modal</button>
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

            $('#button-modal').on('click', function() {
                $('#modalUniv').modal('show');
            });
        })
    </script>
@endsection
