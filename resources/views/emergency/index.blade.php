@extends('layouts.app')

@section('content')
    <style>
        .emergency-card {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
            border: 1px solid #ffe1e1;
        }

        .emergency-header {
            background: linear-gradient(135deg, #dc3545, #ff4d4d);
            color: #fff;
            padding: 16px;
            font-size: 18px;
            font-weight: bold;
        }

        .emergency-body {
            padding: 20px;
        }

        .emergency-btn {
            background: linear-gradient(135deg, #ff1f1f, #ff5e5e);
            color: #fff;
            border: none;
            padding: 12px 18px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: .3s;
            animation: pulse 1.5s infinite;
        }

        .emergency-btn:hover {
            transform: scale(1.05);
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.5);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(255, 0, 0, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
            }
        }

        .status-box {
            margin-top: 12px;
            padding: 10px;
            background: #f8f9fa;
            border-left: 4px solid #dc3545;
            border-radius: 8px;
            font-size: 14px;
        }

        .info-grid {
            display: flex;
            gap: 10px;
            margin: 15px 0;
        }

        .info-item {
            flex: 1;
            background: #f1f3f5;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            border-left: 4px solid #dc3545;
        }

        .map-box {
            height: 500px;
            border-radius: 12px;
            border: 2px solid #ddd;
        }
    </style>
    <div class="container mt-4">

        <div class="emergency-card">

            <div class="emergency-header">
                🚑 Emergency Route Navigation
            </div>

            <div class="emergency-body">

                <button class="emergency-btn" id="emergencyBtn">
                    ⚠ Activate Emergency Assistance
                </button>

                <div class="status-box" id="statusBox">
                    Ready for emergency request...
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        📍 Distance: <span id="distance">--</span>
                    </div>

                    <div class="info-item">
                        ⏱ ETA: <span id="eta">--</span>
                    </div>
                </div>

                <div id="map" class="map-box"></div>

            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const clinic = {
                name: "Vet Clinic - Zone 1B, Opol, Misamis Oriental",
                lat: 8.5142,
                lng: 124.5747
            };

            const map = L.map('map').setView([clinic.lat, clinic.lng], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(map);

            L.marker([clinic.lat, clinic.lng])
                .addTo(map)
                .bindPopup(clinic.name);

            let routeControl;

            const statusBox = document.getElementById("statusBox");

            document.getElementById("emergencyBtn").addEventListener("click", function() {

                statusBox.innerText = "📡 Getting your location...";

                navigator.geolocation.getCurrentPosition(
                    function(position) {

                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;

                        statusBox.innerText = "🚑 Calculating route...";

                        saveEmergency(userLat, userLng);
                        drawRoute(userLat, userLng);

                    },
                    function(error) {

                        console.log(error);

                        statusBox.innerText = "❌ Location error";

                        alert("Please allow location access.");

                    }
                );
            });

            function drawRoute(userLat, userLng) {

                if (routeControl) {
                    map.removeControl(routeControl);
                }

                routeControl = L.Routing.control({

                    waypoints: [
                        L.latLng(userLat, userLng),
                        L.latLng(clinic.lat, clinic.lng)
                    ],

                    routeWhileDragging: false

                }).on('routesfound', function(e) {

                    const route = e.routes[0];

                    const distanceKm = route.summary.totalDistance / 1000;
                    const timeMin = route.summary.totalTime / 60;

                    document.getElementById("distance").innerText = distanceKm.toFixed(2) + " km";
                    document.getElementById("eta").innerText = Math.round(timeMin) + " mins";

                    statusBox.innerText = "✅ Route ready";

                }).on('routingerror', function() {

                    statusBox.innerText = "⚠ Route failed";

                }).addTo(map);
            }

            function saveEmergency(lat, lng) {

                fetch('/emergency/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify({
                        latitude: lat,
                        longitude: lng
                    })
                });

            }

        });
    </script>
@endpush
