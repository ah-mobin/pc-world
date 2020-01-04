@extends('admin.admin_layouts')
@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Newsletter Table</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title mb-3">Subscribers List</h6>

                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                        <tr>
                            <th class="wd-15p">&nbsp;ID</th>
                            <th class="wd-15p">Subscriber's Email</th>
                            <th class="wd-15p">Subscribing Time</th>
                            <th class="wd-15p">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subs as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ URL::to('delete/subscribers/'.$row->id) }}" id="delete" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </div><!-- sl-pagebody -->

@endsection


