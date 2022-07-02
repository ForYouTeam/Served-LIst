@extends('layout.Base')
@section('content')
    <div class="row" style="padding: 0px 10px">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white row" style="padding: 0; margin: 0; border-radius: 11px 11px 0 0">
                    <div class="col-sm-6 text-left text-secondary pt-2">
                        <h6 style="font-weight: 600; letter-spacing: 1px;">Todo</h6>
                    </div>
                    <div class="col-sm-6 text-info text-right pt-2">
                        <div class="label-icon">
                            <i class="ti-receipt"></i>
                            <label class="badge badge-info badge-top-right">9</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4" style="padding: 25px 12px">
                <ul>
                    <li>
                        <i class="ti-angle-double-right text-success"></i> <b>Lorem ipsum dolor sit amet</b>
                    </li>
                    <div class="row mb-3 mt-2">
                        <i class="ti-tag col-sm-1"></i>
                        <label class="ml-1 label label-primary">Biji</label>
                        <label class="ml-1 label label-info">Batang</label>
                        <label class="ml-1 label label-success">Daun</label>
                    </div>
                    <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam beatae cum eveniet
                        expedita,
                        exercitationem cupiditate totam debitis commodi minima velit repellendus voluptas accusantium eaque!
                        Deserunt neque odio error repudiandae qui?</p>
                </ul>
                <div class="row">
                    <div class="col-sm-6">
                        <button type="button" class="mt-2 btn btn-sm btn-info waves-effect waves-light"><i
                                class="ti-calendar mr-1"></i>
                            {{ date('F d') }}
                        </button>
                    </div>
                    <div class="col-sm-6 text-right mt-1">
                        <button class="btn btn-sm waves-effect waves-light btn-dark btn-icon">AD</button>
                        <button class="btn btn-sm waves-effect waves-light btn-dark btn-icon">DK</button>
                        <button class="btn btn-sm waves-effect waves-light btn-dark btn-icon">KNT</button>
                    </div>
                </div>
            </div>
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
        })
    </script>
@endsection
