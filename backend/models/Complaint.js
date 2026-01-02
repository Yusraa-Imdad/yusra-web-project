// models/Complaint.js
const mongoose = require('mongoose');

const complaintSchema = new mongoose.Schema({
  user: { type: mongoose.Schema.Types.ObjectId, ref: 'User', required: true },
  title: { type: String, required: true },
  category: { type: String, required: true },
  description: { type: String, required: true },
  status: { type: String, enum: ['Pending','In Progress','Resolved'], default: 'Pending' },
  response: { type: String, default: '' }, // warden reply if any
  createdAt: { type: Date, default: Date.now },
  updatedAt: { type: Date }
});

complaintSchema.pre('save', function(next){
  this.updatedAt = Date.now();
  next();
});

module.exports = mongoose.model('Complaint', complaintSchema);
