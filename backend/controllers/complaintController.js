const Complaint = require('../models/Complaint');
const User = require('../models/User');

// ================= ADD COMPLAINT =================
exports.addComplaint = async (req, res) => {
  try {
    const { title, category, description } = req.body;

    if (!title || !category || !description) {
      return res.status(400).json({ message: "All fields required" });
    }

    const complaint = new Complaint({
      user: req.user._id,
      title,
      category,
      description
    });

    await complaint.save();

    // ✅ populate user so name/email available
    const populatedComplaint = await Complaint.findById(complaint._id)
      .populate("user", "name email");

    res.json(populatedComplaint);

  } catch (err) {
    console.error(err);
    res.status(500).json({ message: "Server error" });
  }
};

// ================= STUDENT: MY COMPLAINTS =================
exports.getMyComplaints = async (req, res) => {
  try {
    const complaints = await Complaint.find({ user: req.user._id })
      .populate("user", "name email")   // ✅ THIS WAS MISSING
      .sort({ createdAt: -1 });

    res.json(complaints);
  } catch (err) {
    res.status(500).json({ message: "Server error" });
  }
};

// ================= WARDEN: ALL COMPLAINTS =================
exports.getAllComplaints = async (req, res) => {
  try {
    const complaints = await Complaint.find()
      .populate("user", "name email")
      .sort({ createdAt: -1 });

    res.json(complaints); // ❗ direct array (NOT {complaints})
  } catch (err) {
    res.status(500).json({ message: "Server error" });
  }
};

// ================= UPDATE STATUS =================
exports.updateStatus = async (req, res) => {
  try {
    const { status } = req.body;

    if (!["Pending", "In Progress", "Resolved"].includes(status)) {
      return res.status(400).json({ message: "Invalid status" });
    }

    const complaint = await Complaint.findById(req.params.id);
    if (!complaint) {
      return res.status(404).json({ message: "Not found" });
    }

    complaint.status = status;
    await complaint.save();

    const populated = await Complaint.findById(complaint._id)
      .populate("user", "name email");

    res.json(populated);
  } catch (err) {
    res.status(500).json({ message: "Server error" });
  }
};
