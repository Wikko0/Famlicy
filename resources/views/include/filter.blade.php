@if((isset($posts) && $posts->isNotEmpty()))
<div class="filter-section">
    <div class="row g-3 align-items-center">
        <div class="col-md-5">
            <label for="sortBy" class="form-label fw-bold text-white">Sort by:</label>
            <select class="form-select btn-lg" id="sortBy">
                <option value="newest" selected>Newest</option>
                <option value="oldest">Oldest</option>
            </select>
        </div>

        <div class="col-md-5">
            <label for="contentT" class="form-label fw-bold text-white">Post Type:</label>
            <select class="form-select btn-lg" id="contentT">
                <option value="all" selected>All</option>
                <option value="global">Global Only</option>
                @if(isset($userCommunities))
                    @foreach ($userCommunities as $community)
                        <option value="{{ $community->name }}">{{ $community->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-md-1">
            <button class="btn-filter mt-4" onclick="applyFilters()"><i class="fas fa-filter"></i></button>
        </div>
    </div>

</div>
@endif
<script>
    function applyFilters() {
        const sortBy = document.getElementById('sortBy').value;
        const contentType = document.getElementById('contentT').value;


        let url = `{{ route('home') }}?sortBy=${sortBy}`;


        if (contentType !== 'all') {
            url += `&contentType=${contentType}`;
        }

        window.location.href = url;
    }
</script>

