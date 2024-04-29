const express = require("express");
const mysql = require("mysql");
const dotenv = require("dotenv");

// Load environment variables from .env file
dotenv.config();

// Create Express app
const app = express();

// Database connection configuration
const connection = mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_NAME,
});

// Connect to the database
connection.connect((err) => {
  if (err) {
    console.error("Error connecting to database:", err);
    return;
  }
  console.log("Connected to database");
});

// Define a route to fetch an example record from the database
app.get("/example", (req, res) => {
  // Query to fetch an example record from a table
  const query = "SELECT * FROM example_table LIMIT 1";

  // Execute the query
  connection.query(query, (err, results) => {
    if (err) {
      console.error("Error querying database:", err);
      res.status(500).json({ error: "Internal server error" });
      return;
    }
    if (results.length === 0) {
      res.status(404).json({ error: "Record not found" });
      return;
    }
    // Send the fetched record as JSON response
    res.json(results[0]);
  });
});

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
