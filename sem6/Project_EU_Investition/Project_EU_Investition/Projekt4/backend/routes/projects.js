const express = require('express');
const router = express.Router();
const Project = require('../models/Project');


const categories = require('../categories');

router.get('/', async (req, res) => {
  const { page = 1, limit = 100, type = '', location = '' } = req.query;
  try {
    const projects = await Project.find({
      type: { $regex: type, $options: 'i' },
      projectLocation: { $regex: '.*' + location + '.*', $options: 'i' }
    })
        .limit(limit * 1)
        .skip((page - 1) * limit)
        .exec();

    const count = await Project.countDocuments({
      type: { $regex: type, $options: 'i' },
      projectLocation: { $regex: '.*' + location + '.*', $options: 'i' }
    });

    res.json({
      projects,
      totalPages: Math.ceil(count / limit),
      currentPage: page
    });
  } catch (err) {
    console.error(err.message);
  }
});

router.get('/:id', async (req, res) => {
  try {
    const project = await Project.findById(req.params.id);
    if (!project) return res.status(404).json({ message: 'Cannot find project' });
    res.json(project);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
});

module.exports = router;