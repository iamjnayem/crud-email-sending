@extends('layout.welcome')
@section('title', 'Add Student')
@section('content')

    <div class="table-responsive">
        <div class="table-wrapper">

            <div class="modal-content">
                <form method="POST" action="{{ route('students.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Student</h4>
                        <a href="{{ route('students.index') }}">
                            <button type="button" class="close" aria-hidden="true">&times;</button>
                        </a>
                    </div>
                    <div class="modal-body">
                        @if ($errors->has('f_name'))
                            <span class="text-danger">{{ "**".$errors->first('f_name') }}</span>
                        @endif
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="f_name" required value="{{old('f_name')}}">
                        </div>

                        @if ($errors->has('l_name'))
                            <span class="text-danger">{{ "**".$errors->first('l_name') }}</span>
                        @endif
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="l_name" required value="{{old('l_name')}}">
                        </div>
                        @if ($errors->has('age'))
                            <span class="text-danger">{{ "**".$errors->first('age') }}</span>
                        @endif
                        <div class="form-group">
                            <label>Age</label>
                            <input type="text" class="form-control" name="age" required value="{{old('age')}}">
                        </div>
                        @if ($errors->has('department'))
                            <span class="text-danger">{{ "**".$errors->first('department') }}</span>
                        @endif
                        <div class="form-group">
                            <h6>By Selecting Department Subject will be shown automatically</h6>
                            <label for="department">Department:</label>
                            <select name="department" id="departments" class="p-2" onchange="fetchSubjects()">
                                <option value="">Choose Your Department</option>
                                @foreach ($depts as $key)
                                    <option value={{ $key->id }}>{{ $key->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('subjects'))
                            <span class="text-danger">{{ "**".$errors->first('subjects') }}</span>
                        @endif
                        <label for="subjects" id="sub-heading" style="display: none;">Subjects:</label><br />
                        <div class="form-group" id="subject-zone">
                            {{-- <input type="checkbox" id="s1" name="subject[]" value="Bangla">
                            <label for="s1"> Bangla</label><br> --}}
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

{{-- @push('subjects') --}}
<script>
    function fetchSubjects() {
        let department = document.getElementById("departments").value;
        let base_url = window.location.origin;
        fetch(base_url + "/subjects/" + department)
            .then(res => res.json())
            .then((data) => {
                let sub = document.getElementById('subject-zone');
                sub.innerText = "";
                let subheading = document.getElementById('sub-heading')
                subheading.style.display = ''

                let subjects = data['subjects'];
                for (let item of subjects) {


                    let checkbox = document.createElement('input')
                    checkbox.type = 'checkbox'
                    checkbox.name = 'subjects[]'
                    checkbox.id = 'sub' + item['id']
                    checkbox.value = item['id']



                    sub.appendChild(checkbox);

                    let lable = document.createElement('label')
                    lable.innerText = item['name']
                    lable.style.marginLeft = "8px";
                    lable.style.marginRight = "8px";
                    // lable.for = 'sub' + item['id']
                    // lable.setAttibute('for', 'sub' + item['id'])

                    sub.appendChild(lable);


                }
            })

    }
</script>
{{-- @endpush --}}
