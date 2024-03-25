const express = require("express");
const bodyParser = require("body-parser");
const mysql = require("mysql");

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware to parse JSON requests
app.use(bodyParser.json());

// Endpoint to accept temperature
app.get("/temp/:temp", (req, res) => {
  //const { temperature } = req.body;
  const temperature = req.params.temp;
  console.log(temperature);
  // also console log the time and date
  const date = new Date();
  console.log(date);

  if (temperature === undefined || temperature === null) {
    return res.status(400).json({ error: "Temperature value is missing." });
  }

  // add to database

  //res.json("Success");
  res.status(200).send();
});

// Start the server
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
