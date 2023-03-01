<?php
// Connect to the database
//$conn = mysqli_connect('lds20231server.mysql.database.azure.com', 'adminlds2023', 'eqFR2aNXmzkBc0RoDKVd@', 'todolist');
$con = mysqli_init();
mysqli_real_connect($conn, "lds20231server.mysql.database.azure.com", "adminlds2023", "eqFR2aNXmzkBc0RoDKVd@", "todolist", 3306, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
// Check for form submission to add a new task
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $task_name = $_POST['task_name'];
  $task_description = $_POST['task_description'];
  
  // Insert the new task into the database
  $sql = "INSERT INTO tasks (task_name, task_description, is_completed) VALUES ('$task_name', '$task_description', 0)";
  mysqli_query($conn, $sql);
}

// Get the list of tasks from the database
$sql = "SELECT * FROM tasks";
$result = mysqli_query($conn, $sql);
$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Include the header file
?>
<!DOCTYPE html>
<html>
<head>
  <title>To-do List</title>
  <style>
    /* CSS styles for the header */
    header {
      background-color: #c00;
      color: #fff;
      padding: 10px;
    }
    
    h1 {
      margin: 0;
      font-size: 36px;
      text-align: center;
      text-transform: uppercase;
      letter-spacing: 2px;
    }
    
    nav {
      display: flex;
      justify-content: center;
      margin-top: 10px;
    }
    
    nav a {
      color: #fff;
      text-decoration: none;
      padding: 5px 10px;
      border-radius: 5px;
      margin-right: 10px;
      background-color: #fff;
      color: #c00;
    }
    
    nav a:hover {
      background-color: #fff;
      color: #c00;
    }
    
    /* CSS styles for the task list */
    table {
      border-collapse: collapse;
      width: 100%;
    }
    
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    th {
      background-color: #c00;
      color: #fff;
    }
    
    /* CSS styles for the add task form */
    form {
      margin-top: 20px;
    }
    
    label {
      display: block;
      margin-bottom: 5px;
    }
    
    input[type="text"], textarea {
      width: 100%;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ddd;
      margin-bottom: 10px;
    }
    
    button[type="submit"] {
      background-color: #c00;
      color: #fff;
      padding: 8px 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    
    button[type="submit"]:hover {
      background-color: #900;
    }
  </style>
</head>
<body>
  <header>
    <h1>To-do List</h1>
    <nav>
      <a href="#">Home</a>
      <a href="#add_task">Add Task</a>
    </nav>
  </header>
  
  <main>
    <h2>All Tasks</h2>
    <table>
      <thead>
        <tr>
          <th>Task Name</th>
          <th>Description</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tasks as $task): ?>
          <tr>
            <td><?= $task['task_name'] ?></td>
            <td><?= $task['task_description'] ?></td>
            <td><?= $task['is_completed'] ? 'Completed' : 'Incomplete' ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    
    <h2 id="add_task">Add Task</h2>
    <form action="" method="post">
      <label for="task_name">Task Name</label>
      <input type="text" name="task_name" id="task_name" required>
      
      <label for="task_description">Description</label>
      <textarea name="task_description" id="task_description" rows="5" required></textarea>
      
      <button type="submit">Add Task</button>
    </form>
  </main>
  
  <footer>
    &copy; <?= date('Y') ?> To-do List App
  </footer>
</body>
</html>
