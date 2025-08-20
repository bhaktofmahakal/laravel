@extends('layouts.app')

@section('title', $facility->business_name)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-building me-2"></i>{{ $facility->business_name }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6><i class="fas fa-calendar me-2"></i>Last Updated</h6>
                        <p class="mb-3">
                            <span class="badge bg-info">{{ $facility->last_update_date->format('F d, Y') }}</span>
                        </p>

                        <h6><i class="fas fa-map-marker-alt me-2"></i>Address</h6>
                        <p class="mb-3">
                            {{ $facility->street_address }}<br>
                            {{ $facility->city }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="fas fa-recycle me-2"></i>Materials Accepted</h6>
                        <div class="mb-3">
                            @foreach($facility->materials as $material)
                                <span class="badge bg-success me-1 mb-1">{{ $material->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('facilities.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                    <div>
                        <a href="{{ route('facilities.edit', $facility) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('facilities.destroy', $facility) }}" 
                              class="d-inline ms-2" onsubmit="return confirm('Are you sure you want to delete this facility?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-map me-2"></i>Location</h6>
            </div>
            <div class="card-body p-0">
                <div id="map" style="height: 300px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function initMap() {
    const address = "{{ $facility->street_address }}, {{ $facility->city }}";
    const geocoder = new google.maps.Geocoder();
    
    geocoder.geocode({ address: address }, function(results, status) {
        if (status === 'OK') {
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: results[0].geometry.location
            });
            
            new google.maps.Marker({
                position: results[0].geometry.location,
                map: map,
                title: "{{ $facility->business_name }}"
            });
        } else {
            document.getElementById('map').innerHTML = 
                '<div class="d-flex align-items-center justify-content-center h-100">' +
                '<div class="text-center text-muted">' +
                '<i class="fas fa-map-marker-alt fa-2x mb-2"></i><br>' +
                'Map not available' +
                '</div></div>';
        }
    });
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
@endsection