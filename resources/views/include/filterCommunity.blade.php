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

        <div class="col-md-1">
            <button class="btn-filter mt-4" onclick="applyFilters()"><i class="fas fa-filter"></i></button>
        </div>
    </div>

</div>
@endif
<script>
    function applyFilters() {
        const sortBy = document.getElementById('sortBy').value;

        let url = `{{ route('community.page', $community->id) }}?sortBy=${sortBy}`;


        window.location.href = url;
    }
</script>

