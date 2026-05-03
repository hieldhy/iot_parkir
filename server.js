import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';
import mqtt from 'mqtt';
import cors from 'cors';

const app = express();
app.use(cors());

const server = createServer(app);
const io = new Server(server, {
    cors: {
        origin: '*', // Allow all origins for local development
        methods: ['GET', 'POST']
    }
});

// --- Konfigurasi MQTT ---
const MQTT_BROKER = 'mqtt://broker.emqx.io:1883'; // Menggunakan TCP asli, lebih stabil dari WSS
const MQTT_TOPIC = 'ta/parkir/yolo';

console.log(`Menghubungkan ke broker MQTT: ${MQTT_BROKER}...`);

const mqttClient = mqtt.connect(MQTT_BROKER, {
    clean: true,
    connectTimeout: 5000,
});

mqttClient.on('connect', () => {
    console.log('[MQTT] Berhasil terhubung ke Broker EMQX!');
    mqttClient.subscribe(MQTT_TOPIC, (err) => {
        if (!err) {
            console.log(`[MQTT] Berhasil mendengarkan topik: ${MQTT_TOPIC}`);
        } else {
            console.error('[MQTT] Gagal subscribe:', err);
        }
    });
});

mqttClient.on('message', (topic, message) => {
    if (topic === MQTT_TOPIC) {
        try {
            // Meneruskan pesan langsung ke klien Socket.io
            const payloadString = message.toString();
            const data = JSON.parse(payloadString);
            
            // Broadcast ke semua tab browser yang terbuka
            io.emit('yolo_data', data);
        } catch (error) {
            console.error('[MQTT] Gagal memparsing data JSON:', error.message);
        }
    }
});

mqttClient.on('error', (err) => {
    console.error('[MQTT] Error Koneksi:', err);
});

// --- Konfigurasi Socket.io ---
io.on('connection', (socket) => {
    console.log(`[Socket.io] Client Dashboard Terhubung: ${socket.id}`);
    
    socket.on('disconnect', () => {
        console.log(`[Socket.io] Client Dashboard Terputus: ${socket.id}`);
    });
});

const PORT = 3000;
server.listen(PORT, () => {
    console.log(`===============================================`);
    console.log(`🚀 Node.js MQTT Intermediary Server Berjalan!`);
    console.log(`🔌 Socket.io aktif di port: ${PORT}`);
    console.log(`===============================================`);
});
