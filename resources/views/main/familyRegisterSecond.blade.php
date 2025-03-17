@extends('layouts.main')

@section('content')
    <section class="join-us">
        <div class="left-section">
            <img src="{{ asset('images/join-us.png') }}" alt="Join Us" />
            <div class="title">Join us with some of your family.</div>
        </div>

        <div class="right">
            @include('include/alert')
            <form method="POST" action="{{ route('family.register.second', $user->username) }}" enctype="multipart/form-data">
                @csrf
                <!-- Second section -->
                <div class="input-section">
                    <div class="input-item-grid">
                        <input type="text" name="location" placeholder="City" value="{{ old('location') }}" />
                        <input type="text" name="country" placeholder="Country of residence" value="{{ old('country') }}" />
                    </div>

                    <div class="input-item-grid">
                        <select name="marital" id="">
                            <option value="">Marital status</option>
                            <option value="Single" {{ old('marital') == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ old('marital') == 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Nothing to say" {{ old('marital') == 'Nothing to say' ? 'selected' : '' }}>Nothing to say</option>
                        </select>
                        <input type="text" name="religious" placeholder="Religious status" value="{{ old('religious') }}" />
                    </div>

                    <div class="input-item-grid">
                        <select name="children" id="">
                            <option value="">Do you have children</option>
                            <option value="Yes" {{ old('children') == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ old('children') == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                        <select name="grandchildren" id="">
                            <option value="">Do you have grandchildren</option>
                            <option value="Yes" {{ old('grandchildren') == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No" {{ old('grandchildren') == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="next-btn-sec">
                        <button type="button" class="back-btn" onclick="window.location.href='{{ route('family.register', $user->username) }}'">Back</button>
                        <button type="submit" class="save-btn">Next</button>
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
