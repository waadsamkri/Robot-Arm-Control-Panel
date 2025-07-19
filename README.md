# 🤖 Robot Arm Control Panel

A web-based control panel for a 6-motor robotic arm built using HTML, CSS, JavaScript, PHP, and MySQL.

---

## 🚀 Project Overview

This project allows users to control six servo motors through sliders on a web interface.  
You can **save**, **load**, and **remove** different motor poses (positions) and manage them easily via a dynamic table.

---

## 🧰 Technologies Used

- HTML5 & CSS3
- JavaScript (Vanilla)
- PHP (for server-side logic)
- MySQL (for storing poses)
- Apache (via XAMPP/WAMP/LAMP for local hosting)

---


## ⚙️ Setup Instructions (Localhost)

1. **Install a local server environment** like [XAMPP](https://www.apachefriends.org/) or WAMP.
2. Clone or download this repository.
3. Place the project folder inside the `htdocs` (for XAMPP) or `www` (for WAMP) directory.
4. Start **Apache** and **MySQL** from the control panel.
5. Create a new MySQL database (e.g., `robot_db`) and import the SQL schema if provided.
6. Update your database credentials in `db.php`.
7. Open your browser and navigate to:http://localhost/robot-panel/


---

## 📌 Features

- 🎚️ Real-time slider controls for 6 motors
- 💾 Save any pose to the database
- 📋 View all saved poses in a table
- 📥 Load any pose to update sliders
- ❌ Remove poses (soft delete via status)
- 🛠️ Placeholder for connecting to physical robot (via Arduino, ESP32, etc.)

---





