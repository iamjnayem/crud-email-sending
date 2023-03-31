@extends('layout.welcome')

@section('content')
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2><b>SSL Assesment</b></h2>
					</div>
					<div class="col-sm-6">
						{{-- <a class='btn btn-success'>
							<i class="material-icons">&#xE147;</i> <span> Edit Student</span>
						</a> --}}
					</div>
				</div>
			</div>

            <div class="modal-content">
                <form method="POST" action="{{route('students.update', $student->id)}}">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Student</h4>
						<a href="{{route('students.index')}}">
                        	<button type="button" class="close"  aria-hidden="true">&times;</button>
						</a>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="f_name" value="{{$student->first_name}}" required>
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="l_name" value="{{$student->last_name}}" required>
                        </div>
                        <div class="form-group">
                            <label>AGE</label>
                            <input type="text" class="form-control" name="age" value={{$student->age}} required>
                        </div>
                        <div class="form-group">
                            <label for="departments">Department:</label>

                            <select name="departments" id="departments" class="p-2" onchange="fetchSubjects()">
                                <option value="">Choose Your Department</option>
                                @foreach($depts as $dept )
                                    <option value="{{$dept->id}}" {{($dept->id == $student->department->id) ? "selected": "disabled"}}>{{$dept->name}}</option>
                                @endforeach
                            </select>
                        </div>
						<label for="subjects"  id="sub-heading">Subjects:</label><br/>
                        <div class="form-group"  id="subject-zone">
                            @php
                                $subject_ids = [];
                                foreach($student->subjects as $subject){
                                    $subject_ids[] = $subject->id;
                                }

                            @endphp
                           @foreach ($subjects as $subject)
                                <input type="checkbox" id="s1" name="subject[]" value="{{$subject->id}}"
                                @if (in_array($subject->id, $subject_ids))
                                    {{"checked"}}
                                @endif
                                >
                                <label for="s1">{{$subject->name}}</label><br>
                           @endforeach
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </form>
            </div>
		</div>
	</div>
</div>

@endsection

<script>
	function fetchSubjects(){
		let department = document.getElementById("departments").value;

		fetch("http://localhost:8000" + "/subjects/"+ department)
		.then(res => res.json())
		.then((data) => {
			let sub = document.getElementById('subject-zone');
			sub.innerText = "";
			let subheading = document.getElementById('sub-heading')
			subheading.style.display = ''

			let subjects = data['subjects'];
			for(let item of subjects){


				let checkbox = document.createElement('input')
				checkbox.type = 'checkbox'
				checkbox.name = 'subject[]'
				checkbox.id = 'sub' + item['id']
				checkbox.value = item['id']



				sub.appendChild(checkbox);

				let lable = document.createElement('label')
				lable.innerText = item['name']
				lable.style.marginLeft="8px";
				lable.style.marginRight="8px";
				// lable.for = 'sub' + item['id']
				// lable.setAttibute('for', 'sub' + item['id'])

				sub.appendChild(lable);


			}
		}
		)

	}
</script>

</body>
</html>
