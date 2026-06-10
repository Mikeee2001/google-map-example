@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        <div class="card shadow">

            <div class="card-header bg-danger text-white">

                <h4 class="mb-0">
                    🚨 Emergency Requests Map
                </h4>

            </div>

            <div class="card-body">

                <div id="map" style="height:700px;">
                </div>

            </div>

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const map = L.map('map')
                .setView([8.5142, 124.5747], 13);

            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19
                }
            ).addTo(map);

            let markers = [];

            function loadEmergencies() {
                markers.forEach(marker => {
                    map.removeLayer(marker);
                });

                markers = [];

                fetch('/admin/emergencies/data')
                    .then(response => response.json())
                    .then(data => {

                        data.forEach(item => {

                            const marker = L.marker(
                                    [item.latitude, item.longitude], {
                                        icon: emergencyIcon
                                    }
                                )
                                .addTo(map)
                                .bindPopup(`
                    <b>Emergency Request</b><br>
                    Latitude: ${item.latitude}<br>
                    Longitude: ${item.longitude}<br>
                    Status: ${item.status}<br>
                    Submitted: ${item.created_at}
                `);

                            markers.push(marker);

                        });

                    });

            }

            const emergencyIcon = L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            loadEmergencies();

            setInterval(loadEmergencies, 5000);

        });
    </script>
@endpush
