@extends('admin.master')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('/css/CustomStyle.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">PayGates</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="col-md-12">
                <table class="table table-hover table-bordered">
                    <thead class="background-blue color-white">
                        <th>
                            <td>Name</td>
                            <td>Code</td>
                            <td>Url</td>
                            <td class="text-center">Action</td>
                        </th>
                    </thead>
                    <tbody>
                        @if(!empty($payGates))
                            @foreach($payGates as $payGate)
                                <tr>
                                    <td class="text-center">{{ $payGate->id }}</td>
                                    <td>{{ $payGate->name }}</td>
                                    <td>{{ $payGate->code }}</td>
                                    <td>{{ $payGate->url }}</td>
                                    <td class="text-center"><a href="{{ url('/admin/paygates/'.$payGate->id.'/edit') }}"><i class="fas fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('') }}"></script>
@endsection
