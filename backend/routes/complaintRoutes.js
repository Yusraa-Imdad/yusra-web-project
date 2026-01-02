const express = require('express');
const router = express.Router();
const auth = require('../middlewares/authMiddleware');
const { permit } = require('../middlewares/roleMiddleware');
const ctrl = require('../controllers/complaintController');

// Student
router.post('/add', auth, ctrl.addComplaint);
router.get('/my', auth, ctrl.getMyComplaints);

// Warden
router.get('/all', auth, permit('Warden'), ctrl.getAllComplaints);
router.put('/status/:id', auth, permit('Warden'), ctrl.updateStatus);

module.exports = router;
