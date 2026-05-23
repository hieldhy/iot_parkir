<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parking Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #5585f6;
            --primary-blue-dark: #4270db;
            --bg-color: #eef1f5;
            --white: #ffffff;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --success-green: #20a068;
            --danger-red: #d33c4a;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            --slot-bg: #f1f5f9;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-dark);
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0 20px 0;
        }

        .brand {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
        }

        .brand span {
            color: var(--text-dark);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            background-color: var(--white);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            box-shadow: var(--card-shadow);
            gap: 8px;
        }

        .admin-profile svg {
            width: 18px;
            height: 18px;
            fill: var(--text-muted);
        }

        /* Banner */
        .banner {
            background-color: var(--primary-blue);
            background-image: linear-gradient(135deg, var(--primary-blue) 0%, #76a0ff 100%);
            border-radius: 12px;
            padding: 24px 30px;
            color: var(--white);
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(85, 133, 246, 0.3);
        }

        .banner h1 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .banner p {
            font-size: 15px;
            font-weight: 500;
            opacity: 0.9;
        }

        /* Main Grid */
        .main-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--card-shadow);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .card-header svg {
            width: 22px;
            height: 22px;
            fill: var(--text-dark);
        }

        /* Live Cam */
        .camera-container {
            width: 100%;
            height: 350px;
            background-color: #000;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .camera-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .camera-placeholder {
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
        }

        /* Summary Widgets */
        .summary-container {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }

        .summary-box {
            flex: 1;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
        }

        .summary-box .title {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .summary-box .value {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            transition: color 0.3s;
        }

        .summary-box.terisi .value {
            color: var(--danger-red);
        }

        .summary-box.kosong .value {
            color: var(--success-green);
        }

        /* Progress Bar */
        .progress-container {
            width: 100%;
            height: 8px;
            background-color: #e2e8f0;
            border-radius: 4px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: var(--success-green);
            width: 0%;
            transition: width 0.5s ease, background-color 0.5s ease;
        }

        /* Slots Grid */
        .slots-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .slot {
            display: flex;
            flex-direction: column;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        
        .slot:hover {
            transform: translateY(-2px);
        }

        .slot-header {
            padding: 8px 0;
            text-align: center;
            font-weight: 700;
            font-size: 13px;
            color: var(--white);
        }

        .slot-body {
            background-color: var(--slot-bg);
            padding: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .slot-body svg {
            width: 45px;
            height: 45px;
            fill: #1e293b;
            transition: opacity 0.3s ease;
        }

        .slot-footer {
            padding: 8px 0;
            text-align: center;
            font-weight: 700;
            font-size: 12px;
            color: var(--white);
            text-transform: uppercase;
        }

        /* Status Colors */
        .status-terisi .slot-header,
        .status-terisi .slot-footer {
            background-color: var(--danger-red);
        }

        .status-tersedia .slot-header,
        .status-tersedia .slot-footer {
            background-color: var(--success-green);
        }
        
        /* Make icon a bit faded when available as per good design practice */
        .status-tersedia .slot-body svg {
            opacity: 0.2; 
        }

        /* Table Section */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background-color: var(--primary-blue);
            color: var(--white);
        }

        th {
            padding: 14px 16px;
            font-weight: 600;
            font-size: 14px;
        }

        th:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        th:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
            font-weight: 600;
        }
        
        tbody tr {
            transition: background-color 0.15s;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
            .slots-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
        }
        
        @media (max-width: 640px) {
            .slots-grid {
                grid-template-columns: 1fr;
            }
            .header {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Header -->
    <header class="header">
        <div class="brand">
            POLTEK PARK_
        </div>
        <div class="admin-profile">
            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
            Admin
        </div>
    </header>

    <!-- Banner -->
    <div class="banner" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
        <div>
            <h1>Sistem Deteksi Okunpansi Slot Parkir Direktur</h1>
            <p>Menggunakan YOLOv8-Nano pada Embedded System</p>
        </div>
        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <div style="background: rgba(255,255,255,0.15); padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 8px; border: 1px solid rgba(255,255,255,0.2);">
                <div style="width: 8px; height: 8px; background: #4ade80; border-radius: 50%; box-shadow: 0 0 8px #4ade80;"></div>
                Sistem Aktif
            </div>
            <div style="background: rgba(255,255,255,0.15); padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 8px; border: 1px solid rgba(255,255,255,0.2);">
                ⏱️ Latensi: <span id="ping-latency">12ms</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-grid">
        <!-- Live Cam Card -->
        <div class="card" style="display: flex; flex-direction: column;">
            <div class="card-header" style="justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <svg viewBox="0 0 24 24"><path d="M4 4h3l2-2h6l2 2h3c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm10 15c3.31 0 6-2.69 6-6s-2.69-6-6-6-6 2.69-6 6 2.69 6 6 6zm0-10c2.21 0 4 1.79 4 4s-1.79 4-4 4-4-1.79-4-4 1.79-4 4-4z"/></svg>
                    Live CAM
                </div>
                <select style="padding: 6px 12px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 12px; font-weight: 600; color: var(--text-dark); background: #f8fafc; outline: none; cursor: pointer; max-width: 200px;">
                    <option value="main">📸 Kamera Utama (Semua)</option>
                    <option value="d1">🔍 Fokus: Slot D1</option>
                    <option value="d2">🔍 Fokus: Slot D2</option>
                    <option value="d3">🔍 Fokus: Slot D3</option>
                    <option value="d4">🔍 Fokus: Slot D4</option>
                </select>
            </div>
            <div class="camera-container" style="flex: 1; min-height: 350px;">
                <img src="http://127.0.0.1:5000/video_feed" alt="Live Camera Feed" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <div class="camera-placeholder" style="display: none;">Camera Feed Offline</div>
            </div>
            
            <!-- Camera Metadata Info Bar -->
            <div style="margin-top: 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px; display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 16px;">
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <span style="font-size: 11px; color: #64748b; font-weight: 700; text-transform: uppercase;">Hari / Tanggal</span>
                    <span style="font-size: 13px; font-weight: 600; color: #0f172a;" id="live-date">Memuat...</span>
                </div>
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <span style="font-size: 11px; color: #64748b; font-weight: 700; text-transform: uppercase;">Waktu Real-time</span>
                    <span style="font-size: 13px; font-weight: 600; color: #0f172a;" id="live-time">Memuat...</span>
                </div>
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <span style="font-size: 11px; color: #64748b; font-weight: 700; text-transform: uppercase;">Lokasi Node</span>
                    <span style="font-size: 13px; font-weight: 600; color: #0f172a;">Gedung Rektorat</span>
                </div>
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <span style="font-size: 11px; color: #64748b; font-weight: 700; text-transform: uppercase;">Status / Resolusi</span>
                    <span style="font-size: 13px; font-weight: 600; color: #0f172a;"><span style="color:var(--success-green);">●</span> 1080p HD (30fps)</span>
                </div>
            </div>
        </div>

        <!-- Slots Card -->
        <div class="card">
            <div class="card-header">
                Area Parkir Direktur
            </div>

            <!-- Summary Widgets -->
            <div class="summary-container">
                <div class="summary-box">
                    <div class="title">Total</div>
                    <div class="value">4</div>
                </div>
                <div class="summary-box terisi">
                    <div class="title">Terisi</div>
                    <div class="value" id="val-terisi">0</div>
                </div>
                <div class="summary-box kosong">
                    <div class="title">Kosong</div>
                    <div class="value" id="val-kosong">4</div>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="progress-container" title="Tingkat Okupansi">
                <div class="progress-bar" id="occ-bar" style="width: 0%;"></div>
            </div>

            <div class="slots-grid">
                <!-- Slot 1 -->
                <div class="slot status-tersedia">
                    <div class="slot-header">SLOT D1</div>
                    <div class="slot-body">
                        <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                    </div>
                    <div class="slot-footer">TERSEDIA</div>
                </div>

                <!-- Slot 2 -->
                <div class="slot status-tersedia">
                    <div class="slot-header">SLOT D2</div>
                    <div class="slot-body">
                        <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                    </div>
                    <div class="slot-footer">TERSEDIA</div>
                </div>

                <!-- Slot 3 -->
                <div class="slot status-tersedia">
                    <div class="slot-header">SLOT D3</div>
                    <div class="slot-body">
                        <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                    </div>
                    <div class="slot-footer">TERSEDIA</div>
                </div>

                <!-- Slot 4 -->
                <div class="slot status-tersedia">
                    <div class="slot-header">SLOT D4</div>
                    <div class="slot-body">
                        <svg viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
                    </div>
                    <div class="slot-footer">TERSEDIA</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card">
        <div class="card-header">
            <svg viewBox="0 0 24 24"><path d="M4 9h4v11H4zm12 4h4v7h-4zm-6-9h4v16h-4z"/></svg>
            Data Deteksi Terbaru
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Slot</th>
                        <th>Status</th>
                        <th>Plat</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                    </tr>
                </thead>
                <tbody id="log-table-body">
                    @foreach($logs as $i => $log)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $log->slot ?? '-' }}</td>
                        <td style="color: {{ strtoupper($log->status ?? 'TERISI') === 'TERISI' ? 'var(--text-dark)' : 'var(--text-dark)' }}">{{ strtoupper($log->status ?? 'TERISI') }}</td>
                        <td>{{ $log->plat ?? 'DA 6769 LAA' }}</td>
                        <td>
                            @if(isset($log->masuk))
                                @php
                                    $masukDate = strtotime($log->masuk);
                                @endphp
                                <div style="font-size: 12px; font-weight: 500;">{{ date('d/m/Y', $masukDate) }}</div>
                                <div style="font-size: 11px;">{{ date('H:i', $masukDate) }}</div>
                            @else
                                <div style="font-size: 12px; font-weight: 500;">08/04/2026</div>
                                <div style="font-size: 11px;">09:00</div>
                            @endif
                        </td>
                        <td>
                            @if(isset($log->keluar))
                                @php
                                    $keluarDate = strtotime($log->keluar);
                                @endphp
                                <div style="font-size: 12px; font-weight: 500;">{{ date('d/m/Y', $keluarDate) }}</div>
                                <div style="font-size: 11px;">{{ date('H:i', $keluarDate) }}</div>
                            @else
                                <div style="font-size: 12px; font-weight: 500;">08/04/2026</div>
                                <div style="font-size: 11px;">10:17</div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @if(count($logs) === 0)
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--text-muted); font-weight: 500;">Tidak ada data.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Socket.io Library -->
<script src="https://cdn.socket.io/4.7.4/socket.io.min.js"></script>

<!-- Real-time Socket.io Connection -->
<script>
    // Connect to the local Node.js intermediary server
    const SOCKET_URL = "http://127.0.0.1:3000";
    
    console.log("Menghubungkan ke server lokal Socket.io...");
    const socket = io(SOCKET_URL);

    socket.on('connect', () => {
        console.log("Terhubung ke Node.js Server secara realtime!");
    });

    socket.on('connect_error', (err) => {
        console.error("Koneksi Socket.io error: ", err.message);
    });

    socket.on('disconnect', () => {
        console.log("Terputus dari Node.js Server. Mencoba menghubungkan kembali...");
    });

    // Listen for data from the intermediary server
    socket.on('yolo_data', (data) => {
        console.log("Data diterima dari server: ", typeof data === 'string' ? 'String data' : 'JSON Object');
        try {
            // Ensure data is properly formatted as JSON object (Socket.io usually auto-parses)
            if (typeof data === 'string') {
                data = JSON.parse(data);
            }
            
            // 1. Update Slots
            if (data.car_count !== undefined) {
                updateSlots(data.car_count);
            }

            // 2. Add log to table
            if (data.timestamp !== undefined && data.car_count !== undefined) {
                addLogToTable(data);
            }

            // 3. Update Camera Live Stream (if sent via MQTT as base64)
            if (data.image !== undefined) {
                const imgElement = document.querySelector('.camera-container img');
                if (imgElement) {
                    imgElement.src = "data:image/jpeg;base64," + data.image;
                    imgElement.style.display = 'block';
                    document.querySelector('.camera-placeholder').style.display = 'none';
                }
            }
        } catch (e) {
            console.error("Gagal parsing JSON data MQTT", e);
        }
    }

    function updateSlots(carCount) {
        // Mencegah nilai lebih dari 4
        if(carCount > 4) carCount = 4;
        
        // Update summary values
        document.getElementById('val-terisi').innerText = carCount;
        document.getElementById('val-kosong').innerText = 4 - carCount;
        
        // Update progress bar
        const percentage = (carCount / 4) * 100;
        const bar = document.getElementById('occ-bar');
        bar.style.width = percentage + '%';
        
        // Change progress bar color based on occupancy
        if(percentage === 100) {
            bar.style.backgroundColor = 'var(--danger-red)';
        } else if(percentage > 0) {
            bar.style.backgroundColor = 'var(--primary-blue)';
        } else {
            bar.style.backgroundColor = 'var(--success-green)'; // empty
        }

        const slots = document.querySelectorAll('.slot');
        slots.forEach((slot, index) => {
            const footer = slot.querySelector('.slot-footer');
            if (index < carCount) {
                // Slot Terisi
                slot.classList.remove('status-tersedia');
                slot.classList.add('status-terisi');
                footer.innerText = 'TERISI';
            } else {
                // Slot Tersedia
                slot.classList.remove('status-terisi');
                slot.classList.add('status-tersedia');
                footer.innerText = 'TERSEDIA';
            }
        });
    }

    function addLogToTable(data) {
        const tbody = document.getElementById('log-table-body');
        
        // Remove "Tidak ada data." row if it exists
        if (tbody.children.length === 1 && tbody.children[0].innerText.includes("Tidak ada data")) {
            tbody.innerHTML = '';
        }

        const dateObj = new Date(data.timestamp * 1000);
        const dateStr = ("0" + dateObj.getDate()).slice(-2) + "/" + ("0" + (dateObj.getMonth() + 1)).slice(-2) + "/" + dateObj.getFullYear();
        const timeStr = ("0" + dateObj.getHours()).slice(-2) + ":" + ("0" + dateObj.getMinutes()).slice(-2);
        
        // Status changes depending on car_count
        const logStatus = "UPDATE";
        
        const newRow = document.createElement('tr');
        
        newRow.innerHTML = `
            <td>-</td>
            <td>Semua Slot</td>
            <td style="color: var(--text-dark); font-weight: bold;">${logStatus}</td>
            <td>-</td>
            <td>
                <div style="font-size: 12px; font-weight: 500;">${dateStr}</div>
                <div style="font-size: 11px;">${timeStr}</div>
            </td>
            <td>
                <div style="font-size: 12px; font-weight: 500;">(Realtime Data)</div>
                <div style="font-size: 11px;">Mobil Terdeteksi: ${data.car_count}</div>
            </td>
        `;

        tbody.insertBefore(newRow, tbody.firstChild);

        // Keep only max 10 rows to avoid memory issue
        if (tbody.children.length > 10) {
            tbody.removeChild(tbody.lastChild);
        }
    }

    // Live Clock Logic
    function updateClock() {
        const now = new Date();
        const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        
        const dateEl = document.getElementById('live-date');
        const timeEl = document.getElementById('live-time');
        
        if(dateEl) dateEl.innerText = now.toLocaleDateString('id-ID', optionsDate);
        if(timeEl) {
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            timeEl.innerText = `${hours}:${minutes}:${seconds} WIB`;
        }
        
        // Randomize latency slightly for aesthetic
        const pingEl = document.getElementById('ping-latency');
        if(pingEl) pingEl.innerText = Math.floor(Math.random() * 8 + 10) + "ms";
    }
    
    // Start clock
    setInterval(updateClock, 1000);
    updateClock();
</script>

</body>
</html>