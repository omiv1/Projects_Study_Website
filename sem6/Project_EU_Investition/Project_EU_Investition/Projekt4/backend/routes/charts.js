const express = require('express');
const router = express.Router();
const Project = require("../models/Project");
const categories = require("../models/Categories");
const authMiddleware = require("../middlewares/authMiddleware");



router.get('/chart-data', authMiddleware, async (req, res) => {
    try {
        const { startDate, endDate } = req.query;

        if (!startDate || !endDate) {
            return res.status(400).json({ message: 'Start date and end date are required' });
        }

        const start = new Date(startDate).toISOString();
        const end = new Date(endDate).toISOString();

        console.log(`Fetching projects between ${start} and ${end}`);

        const projects = await Project.find({
            projectStartDate: { $gte: start },
            projectEndDate: { $lte: end }
        });

        console.log(`Fetched ${projects.length} projects`);
        console.log(projects);

        if (projects.length === 0) {
            return res.json([]);
        }

        const wojewodztwa = [
            "DOLNOŚLĄSKIE", "KUJAWSKO-POMORSKIE", "LUBELSKIE", "LUBUSKIE",
            "ŁÓDZKIE", "MAŁOPOLSKIE", "MAZOWIECKIE", "OPOLSKIE",
            "PODKARPACKIE", "PODLASKIE", "POMORSKIE", "ŚLĄSKIE",
            "ŚWIĘTOKRZYSKIE", "WARMIŃSKO-MAZURSKIE", "WIELKOPOLSKIE", "ZACHODNIOPOMORSKIE"
        ];

        const result = [];

        for (const woj of wojewodztwa) {
            const projectsInWoj = projects.filter(project => project.projectLocation.includes(woj));
            for (const category of Object.keys(categories)) {
                const totalValue = projectsInWoj
                    .filter(project => project.category === category)
                    .reduce((acc, curr) => acc + parseFloat(curr.totalProjectValuePLN) || 0, 0);

                if (totalValue > 0) {
                    result.push({
                        wojewodztwo: woj,
                        category,
                        value: totalValue
                    });
                }
            }
        }

        console.log("Result:", result);

        res.json(result);
    } catch (error) {
        console.error('Error generating chart data', error);
        res.status(500).json({ message: 'Server error' });
    }
});

router.get('/line-chart-data', async (req, res) => {
    try {
        console.log(`Fetching all projects`);

        const projects = await Project.find({}, 'projectStartDate totalProjectValuePLN euCoFinancingPLN').sort({ projectStartDate: 1 });

        console.log(`Fetched ${projects.length} projects`);
        console.log(projects);

        if (projects.length === 0) {
            return res.json([]);
        }

        const result = projects.map(project => ({
            date: project.projectStartDate,
            totalProjectValuePLN: parseFloat(project.totalProjectValuePLN),
            euCoFinancingPLN: parseFloat(project.euCoFinancingPLN)
        }));

        console.log("Result:", result);

        res.json(result);
    } catch (error) {
        console.error('Error generating line chart data', error);
        res.status(500).json({ message: 'Server error' });
    }
});

module.exports = router;