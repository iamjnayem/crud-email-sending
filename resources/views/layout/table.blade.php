
@extends('layout.welcome')

@section('title', 'Home')

@section('content')

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>
                <span class="custom-checkbox">
                    <input type="checkbox" id="selectAll">
                    <label for="selectAll"></label>
                </span>
            </th>
            <th>Student Id</th>
            <th>Name</th>
            <th>AGE</th>
            <th>Department</th>
            <th>Subjects</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $data)
            <tr>
                <td>
                    <span class="custom-checkbox">
                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                        <label for="checkbox1"></label>
                    </span>
                </td>
                <td>{{ $data->id }}</td>
                <td>{{ $data->first_name }} {{ $data->last_name }}</td>
                <td>{{$data->age}}</td>
                <td>{{ $data->department->name }}</td>
                <td>

                    @forelse ($data->subjects as $subject)
                        <li>{{ $subject->name  }}</li>
                    @empty
                    <li>Not Assigned</li>
                    @endforelse


                </td>
                <td>
                    {{-- <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a> --}}
                    <a href="{{ route('students.edit', $data->id) }}" class="edit"><i class="material-icons"
                            data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <form action="{{ route('students.destroy', ['student' => $data->id]) }}" method="POST">
                        @method('delete')
                        @csrf
                        <button style="border: none; background:none;">
                        <a class="delete"><i class="material-icons" data-toggle="tooltip"
                                title="Delete">&#xE872;</i></a>
                        </button >
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $students->links() !!}
@endsection
