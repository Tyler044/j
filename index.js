const express = require('express');
const mongoose = require('mongoose');
const app = express();

// This line allows your server to read the data (like email/password) 
// sent from your website form.
app.use(express.json());

// --- DATABASE CONNECTION ---
// You will replace 'YOUR_MONGODB_URL' later with a link from MongoDB Atlas
mongoose.connect('mongodb://LTEADMIN:ltepass2026@ac-sytc2eg-shard-00-00.n4xmv2t.mongodb.net:27017,ac-sytc2eg-shard-00-01.n4xmv2t.mongodb.net:27017,ac-sytc2eg-shard-00-02.n4xmv2t.mongodb.net:27017/test?ssl=true&replicaSet=atlas-m0-shard-0&authSource=admin&retryWrites=true&w=majority', {
  serverSelectionTimeoutMS: 5000 
})
  .then(() => console.log('✅ Success! Finally connected.'))
  .catch(err => console.log('❌ Connection error: ', err.message));
    
// --- REGISTRATION ROUTE ---
app.post('/api/register', (req, res) => {
    const { username, password } = req.body;
    
  // This is where you will add 'bcrypt' later to lock the password
    console.log("Received a registration for:", username);
    
    res.status(201).send({ message: "User data received by backend!" });
});

const PORT = 3000;
app.listen(PORT, () => console.log(`🚀 Server running on http://localhost:${PORT}`));