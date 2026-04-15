const express = require('express');
const mongoose = require('mongoose');

const app = express();

app.use(express.json());

// --- DATABASE CONNECTION ---

const uri = "mongodb://host1:27017,host2:27017,host3:27017/yourdb?replicaSet=...";

mongoose.connect(uri, {
  serverSelectionTimeoutMS: 5000,
})
.then(() => console.log('✅ Success! Connected to MongoDB Atlas'))
.catch(err => {
  console.error('❌ Connection error:', err.message);
});

// Optional: show Mongoose connection events
mongoose.connection.on('connected', () => {
  console.log('📡 Mongoose connected to DB');
});

mongoose.connection.on('error', (err) => {
  console.log('⚠️ Mongoose connection error:', err.message);
});

// --- ROUTE ---
app.post('/api/register', (req, res) => {
  const { username, password } = req.body;

  console.log("Received a registration for:", username);

  res.status(201).send({ message: "User data received by backend!" });
});

// --- SERVER ---
const PORT = 3000;
app.listen(PORT, () =>
  console.log(`🚀 Server running on http://localhost:${PORT}`)
);