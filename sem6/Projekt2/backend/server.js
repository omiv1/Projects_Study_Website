const express = require('express');
const axios = require('axios');
const cors = require('cors');
const connectDB = require('./db.js');
const authRoutes = require('./routes/auth');
const projectRoutes = require('./routes/projects');
const chartRoutes = require('./routes/chart'); // Import tras dla wykresów
const tokenVerification = require('./middlewares/tokenVerification'); // Middleware do weryfikacji tokena

const app = express();
const port = process.env.PORT || 5000;

connectDB();

app.use(cors());
app.use(express.json());

app.use('/api/auth', authRoutes);
app.use('/api/projects', projectRoutes);
app.use('/api/chart-data', tokenVerification, chartRoutes); // Używanie tras dla wykresów z tokenVerification

app.get('/api/load-projects', async (req, res) => {
    try {
        let page = 1;
        let hasNextPage = true;

        while (hasNextPage) {
            const response = await axios.get(`http://api.dane.gov.pl/1.4/resources/56902,lista-projektow-realizowanych-z-funduszy-europejskich-w-polsce-w-latach-2021-2027-5-maja-2024-r/data?page=${page}`);
            const projects = response.data.data.map(item => {
                const attributes = item.attributes;
                const typeOfIntervention = attributes.col17.repr;
                return {
                    projectName: attributes.col1.repr,
                    projectSummary: attributes.col2.repr,
                    contractNumber: attributes.col3.repr,
                    beneficiaryName: attributes.col4.repr,
                    fund: attributes.col5.repr,
                    specificObjective: attributes.col6.repr,
                    program: attributes.col7.repr,
                    priority: attributes.col8.repr,
                    measure: attributes.col9.repr,
                    totalProjectValuePLN: attributes.col10.repr,
                    unionCoFinancingRate: attributes.col11.repr,
                    euCoFinancingPLN: attributes.col12.repr,
                    euroExchangeRate: attributes.col13.repr,
                    projectLocation: attributes.col14.repr,
                    projectStartDate: attributes.col15.repr,
                    projectEndDate: attributes.col16.repr,
                    typeOfIntervention,
                    category: determineCategory(typeOfIntervention)
                };
            });

            await Project.insertMany(projects);

            hasNextPage = !!response.data.links.next;
            page++;
        }

        res.json({ message: 'Projects loaded successfully' });
    } catch (error) {
        console.error('Error loading projects', error);
        res.status(500).json({ message: 'Server error' });
    }
});

app.get('/api/locations', async (req, res) => {
    try {
        const locations = await Project.distinct('projectLocation');
        res.json(locations);
    } catch (error) {
        console.error('Error fetching locations', error);
        res.status(500).json({ message: 'Server error' });
    }
});

app.get('/api/measures', async (req, res) => {
    try {
        const measures = await Project.distinct('measure');
        res.json(measures);
    } catch (error) {
        console.error('Error fetching measures', error);
        res.status(500).json({ message: 'Server error' });
    }
});

app.get('/api/getType', async (req, res) => {
    try {
        const typeOfIntervention = await Project.distinct('typeOfIntervention');
        res.json(typeOfIntervention);
    } catch (error) {
        console.error('Error fetching type of intervention', error);
        res.status(500).json({ message: 'Server error' });
    }
});

app.get('/api/type', async (req, res) => {
    try {
        const type = Object.keys(categories);
        res.json(type);
    } catch (error) {
        console.error('Error fetching types', error);
        res.status(500).json({ message: 'Server error' });
    }
});

app.listen(port, () => {
    console.log(`Server running on port ${port}`);
});
