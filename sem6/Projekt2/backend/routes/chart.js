const router = require('express').Router();
const Project = require('../models/Project'); // Model projektu

router.get('/', async (req, res) => {
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

        const categoryMapping = {
            "Edukacja": ["121", "122", "123", "124", "148", "149", "150", "151"],
            "Energetyka": ["038", "040", "041", "042", "044", "045", "046", "047", "048", "050", "054"],
            "Badania i Innowacje": ["001", "002", "003", "006", "009", "010", "011", "012", "013", "016", "019", "020", "021", "023", "024", "025", "026", "027", "028", "029", "030"],
            "Zdrowie": ["128", "129", "019", "160", "161"],
            "Transport": ["081", "082", "083", "087", "088", "089", "090", "093", "107"],
            "Społeczeństwo": ["127", "134", "136", "137", "138", "139", "140", "141", "142", "143", "145", "146", "147", "152", "153", "156", "157", "158", "159", "163"],
            "Środowisko": ["058", "059", "060", "065", "066", "067", "071", "073", "075", "076", "077", "078", "079"],
            "Kultura i Turystyka": ["165", "166", "167", "168"],
            "Administracja": ["169", "170", "173", "179", "180", "181", "182"],
            "Bezpieczeństwo": ["FBWP-3", "FBWP-4"],
            "Gospodarka Morska": ["FEDR-11"],
            "Łączność i Infrastruktura": ["IZGW-1", "IZGW-4", "034"]
        };

        const result = [];

        for (const woj of wojewodztwa) {
            const projectsInWoj = projects.filter(project => project.projectLocation.includes(woj));
            for (const [category, codes] of Object.entries(categoryMapping)) {
                const totalValue = projectsInWoj
                    .filter(project => codes.some(code => project.typeOfIntervention.includes(code)))
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
        const projects = await Project.find({
            projectStartDate: { $exists: true },
            totalProjectValuePLN: { $exists: true },
            euCoFinancingPLN: { $exists: true }
        });

        const lineChartData = projects.map(project => ({
            date: project.projectStartDate,
            totalProjectValuePLN: parseFloat(project.totalProjectValuePLN) || 0,
            euCoFinancingPLN: parseFloat(project.euCoFinancingPLN) || 0
        }));

        res.json(lineChartData);
    } catch (error) {
        console.error('Error fetching line chart data', error);
        res.status(500).json({ message: 'Server error' });
    }
});

module.exports = router;
