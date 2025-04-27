@extends('layouts.main')

@section('content')
    <section class="join-us">
        <div class="left-section">
            <img src="{{ asset('images/join-us.png') }}" alt="Join Us" />
            <div class="title">Join us with some of your family.</div>
        </div>

        <div class="right">
            @include('include/alert')
            <form method="POST" action="{{ route('family.register.form', $user->username) }}" enctype="multipart/form-data">
                @csrf

                <!-- First section -->
                <div class="input-section" id="inputSection1">
                    <div class="input-item">
                        <div class="left">
                            <div class="d-flex align-items-center ps-lg-3 ps-md-0 ps-0">
                                <div class="creating-account me-2">I’m creating an account for?</div>
                                <div class="btn-selection">
                                    <button type="button" class="family-mem-btn activeBar">Transitioned</button>
                                </div>
                            </div>

                            <label class="titleLabel" for="title">Title</label><br />
                            <select name="title" id="title">
                                <option value="">Title</option>
                                <option value="Mr" {{ session('step_one_data.title', old('title')) == 'Mr' ? 'selected' : '' }}>Mr</option>
                                <option value="Mrs" {{ session('step_one_data.title', old('title')) == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                <option value="Ms" {{ session('step_one_data.title', old('title')) == 'Ms' ? 'selected' : '' }}>Ms</option>
                                <option value="Miss" {{ session('step_one_data.title', old('title')) == 'Miss' ? 'selected' : '' }}>Miss</option>
                                <option value="Dr" {{ session('step_one_data.title', old('title')) == 'Dr' ? 'selected' : '' }}>Dr</option>
                            </select>
                        </div>
                        <div class="upload-img">
                            <div class="icon-circle" id="imageCircle">
                                <input type="file" name="photo" id="imageUpload" style="display:none;" />
                                <label for="imageUpload" style="cursor: pointer;">
                                    <img id="previewImage" src="{{ asset('images/camera-icon.png') }}" alt="Upload Preview" style="width: 80%; height: 80%; object-fit: cover;" />
                                </label>
                            </div>
                            <div class="up-text">Upload new image</div>
                        </div>
                    </div>

                    <div class="input-item-grid">
                        <input type="text" placeholder="Name" name="name" value="{{ session('step_one_data.name', old('name')) }}" />
                        <input type="text" placeholder="Surname" name="surname" value="{{ session('step_one_data.surname', old('surname')) }}" />
                    </div>

                    <div class="input-item-grid">
                        <input type="text" placeholder="Alias of nicknames (separete with a comma)" name="alias" value="{{ session('step_one_data.alias', old('alias')) }}" />
                        <select name="relations" class="form-control">
                            <option value="" {{ session('step_one_data.relations', old('relations')) == '' ? 'selected' : '' }}>Relation</option>
                            <option value="Mother" {{ session('step_one_data.relations', old('relations')) == 'Mother' ? 'selected' : '' }}>Mother</option>
                            <option value="Father" {{ session('step_one_data.relations', old('relations')) == 'Father' ? 'selected' : '' }}>Father</option>
                            <option value="Daughter" {{ session('step_one_data.relations', old('relations')) == 'Daughter' ? 'selected' : '' }}>Daughter</option>
                            <option value="Son" {{ session('step_one_data.relations', old('relations')) == 'Son' ? 'selected' : '' }}>Son</option>
                            <option value="Sister" {{ session('step_one_data.relations', old('relations')) == 'Sister' ? 'selected' : '' }}>Sister</option>
                            <option value="Brother" {{ session('step_one_data.relations', old('relations')) == 'Brother' ? 'selected' : '' }}>Brother</option>
                            <option value="Cousin" {{ session('step_one_data.relations', old('relations')) == 'Cousin' ? 'selected' : '' }}>Cousin</option>
                            <option value="Grandmother" {{ session('step_one_data.relations', old('relations')) == 'Grandmother' ? 'selected' : '' }}>Grandmother</option>
                            <option value="Grandfather" {{ session('step_one_data.relations', old('relations')) == 'Grandfather' ? 'selected' : '' }}>Grandfather</option>
                            <option value="Great Grandmother" {{ session('step_one_data.relations', old('relations')) == 'Great Grandmother' ? 'selected' : '' }}>Great Grandmother</option>
                            <option value="Great Grandfather" {{ session('step_one_data.relations', old('relations')) == 'Great Grandfather' ? 'selected' : '' }}>Great Grandfather</option>
                            <option value="Friend" {{ session('step_one_data.relations', old('relations')) == 'Friend' ? 'selected' : '' }}>Friend</option>
                        </select>
                    </div>

                    <div class="input-item-grid input-item-full">
                         <input type="text" placeholder="Admin Profile (nicknames, separete with a comma)" name="relation" value="{{ session('step_one_data.relation', old('relation')) }}" />
                    </div>

                    <div class="for-family-member">
                        <div class="input-with-label">
                            <label for="family_dob">Enter their date of Birth</label>
                            <div class="input-item-three">
                                <select name="family_dob_day">
                                    <option value="">Day</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ session('step_one_data.family_dob_day', old('family_dob_day')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="family_dob_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ session('step_one_data.family_dob_month', old('family_dob_month')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="family_dob_year">
                                    <option value="">Year</option>
                                    @for ($i = date('Y'); $i >= date('Y') - 100; $i--)
                                        <option value="{{ $i }}" {{ session('step_one_data.family_dob_year', old('family_dob_year')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="input-with-label">
                            <label>Enter transition date</label>
                            <div class="input-item-three">
                                <select name="family_transition_day">
                                    <option value="">Day</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ session('step_one_data.family_transition_day', old('family_transition_day')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="family_transition_month">
                                    <option value="">Month</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ session('step_one_data.family_transition_month', old('family_transition_month')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <select name="family_transition_year">
                                    <option value="">Year</option>
                                    @for ($i = date('Y'); $i >= date('Y') - 100; $i--)
                                        <option value="{{ $i }}" {{ session('step_one_data.family_transition_year', old('family_transition_year')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="next-btn-sec">
                        <button type="submit" class="next-btn">Next</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.getElementById('imageUpload').addEventListener('change', function (event) {
            const preview = document.getElementById('previewImage');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

    </script>
@endsection
