const express = require("express");
const mysql = require("mysql");
const dotenv = require("dotenv");

// Load environment variables from .env file
dotenv.config();

// Create Express app
const app = express();

app.use(express.json());

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
  console.log("GET /example");
  // Query to fetch an example record from a table
  const query = "SELECT * FROM test_table LIMIT 1";

  // Execute the query
  connection.query(query, (err, results) => {
    if (err) {
      console.error("Error querying database:", err);
      res.status(500).json({ error: "Internal server eRror", err });
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

// route to post a new task
app.post("/tasks", (req, res) => {
  const task = req.body;

  if (req.body === undefined) {
    res.status(400).json({ error: "data not found / undefined" });
    return;
  } else {
    //console.log("body:", req.body);
  }

  // Construct the SQL statement
  const query = `
    INSERT INTO tasks 
    (title, description, location, duration, show_email, show_phone, category_id, status_id, creator_id) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
  `;

  // Extract values from the task object
  const values = [
    task.title,
    task.description,
    task.location,
    task.duration,
    task.show_email,
    task.show_phone,
    task.category_id,
    task.status_id,
    task.creator_id,
  ];

  // Execute the query
  connection.query(query, values, (err, results) => {
    if (err) {
      console.error("Error inserting task:", err);
      res.status(500).json({ error: "Internal server error" });
      return;
    }

    // Return the inserted task data along with the success message
    res.status(201).json({
      message: "Task added successfully",
      task: { id: results.insertId, ...task }, // Assuming task has an id field
    });
  });
});

// Define a route to fetch all tasks from the database
app.get("/tasks", (req, res) => {
  // Query to fetch all tasks from the tasks table
  const query = "SELECT * FROM tasks";

  // Execute the query
  connection.query(query, (err, results) => {
    if (err) {
      console.error("Error querying database:", err);
      res.status(500).json({ error: "Internal server error" });
      return;
    }

    // Return the fetched tasks as JSON response
    res.json(results);
  });
});

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
