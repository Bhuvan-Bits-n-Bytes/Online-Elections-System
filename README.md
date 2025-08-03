# Online Election System

A complete virtual solution designed to digitize traditional elections. Online Election System is an intermediate-level PHP project created for a final year requirement, tailored primarily for school elections but adaptable for colleges, companies, and social groups. It streamlines the election process online, ensuring convenience, security, and integrity. The project features multi-role access (Admin, Staff, Voters) and supports printable reports, candidate and voter management, and enhanced security via face detection and recognition.

## Project Overview

This web-based voting platform was created for a specific school. Candidate and voter details are securely managed. Students register using their student ID; after registration, an admin activates their account for voting. The project distinguishes three user roles:

- Admin: Full system control—manages all data, users, candidates, activates accounts, and generates reports.
- Staff: Limited data access and reporting abilities.
- Voters: Students who register, await activation, and then vote.

A printable report with vote tallies for candidates is available for administrators and staff.

## Features

### Admin Side
- Login/Logout
- Manage Candidates
- Activate/Deactivate Voters
- Manage Student Data
- Generate and Print Election Reports
- Manage User/Staff List
- View User Time Logs

### Staff Side
- Login/Logout
- Manage Candidates
- View Voters List
- Manage Students
- Generate Election Reports
- View User/Staff List

### Voters
- Register (requires Student ID)
- Vote after account activation

### Security
- Face Detection & Recognition: Integrated Flask & Python module adds an extra layer for authentication during login/voting.
- Single Vote Enforcement: System ensures each student may vote only once.

## Technical Stack

- PHP/Mysqli
- MySQL Database
- HTML, CSS
- Javascript (jQuery, Ajax)
- Bootstrap
- Python, Flask (for face detection/recognition module)
- VSCode

## How to Run

### Requirements
- Download and install a local web server: XAMPP or WAMP.
- Download the project source code (zip).

### Installation / Setup
1. Launch Apache and MySQL via your web server control panel.
2. Extract the downloaded source code.
3. For XAMPP, move the folder to `htdocs`; for WAMP, to `www`.
4. Open phpMyAdmin at [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
5. Create a database named `vote`.
6. Import the provided `vote.sql` from `/database` into phpMyAdmin.
7. Update database credentials as needed in project files.
8. Before starting the voting process, you must run the Flask application for face detection and recognition:  
   - Open your terminal, navigate to the Python project directory, and run:  
     ```
     python3 server.py
     ```
   - Then open [http://localhost:5000/recognition](http://localhost:5000/recognition) in your browser to launch the face recognition interface.
9. Access the voting system at [http://localhost/voting](http://localhost/voting).

### Demo Accounts

Admin Access  
- Username: admin  
- Password: admin

User Access  
- Username: user  
- Password: user

(Use Logi ID 1 for admin, 4 for user if needed.)

## Database

- Import the SQL file `vote.sql` from `/database` into phpMyAdmin.
- No extra migrations or manual schema work needed.

## Face Detection & Recognition Integration

The Online Election System features a security layer using face detection and recognition. This mechanism is implemented using Python and Flask, leveraging popular libraries such as OpenCV and `face_recognition` (which is built on dlib’s deep learning models).

### Technical Approach

- Flask Web Framework serves as the backend for the face recognition API, handling requests from the frontend (such as the main election login or voting page).
- Python Libraries:
    - `face_recognition`: Used for encoding known faces and comparing them with images captured via webcam. It uses deep learning for accurate recognition.
    - `OpenCV`: Handles image/video capture from the user’s camera and basic pre-processing.
- System Flow:
    1. During registration, a photo (face image) of each voter is captured and stored on the server.
    2. When voting or authenticating, the Flask server captures a fresh image from the user.
    3. The captured face is compared against stored encodings using `face_recognition`.
    4. If the face matches, access is granted (allowing the user to vote).
    5. To activate the face recognition interface, users must access [http://localhost:5000/recognition](http://localhost:5000/recognition) after starting the Flask application.

### Key Components

- The main recognition and detection logic is contained in the `face_rec.py` file, which handles facial detection and matching tasks.
- Flask server exposing HTTP endpoints (e.g., `/recognize`) used by the PHP front-end to request face verification in real time.
- A simple HTML/JavaScript interface to access camera input.
- Python scripts load trained facial encodings and use them for recognition.
- Real-time video frame processing with OpenCV.
- Recognition feedback (success/failure) is sent back to the Online Election System’s PHP backend to enforce security during voting/login.

### Dependencies

- Python 3.x
- Flask
- face_recognition (install via pip)
- OpenCV (install via pip)
- Numpy

### Example Endpoints & Usage

- `/upload`: Accepts an image for face recognition (POST request).
- `/video_feed`: Streams real-time video with face detection overlay for feedback in browser.

To run the Flask server, navigate to the face recognition project directory and start it using. After starting, open [http://localhost:5000/recognition](http://localhost:5000/recognition) in your browser to use the face recognition interface in the voting process.

### Best Practices

- Store each user’s known face encodings during registration.
- Secure the connection between Flask and the PHP application (e.g., with CORS and authentication).
- Regularly update facial data if users’ appearance may change.

## Security and Limitations

- Some PHP errors may vary depending on local setup.
- Ensure you configure Flask (Python) for face recognition correctly for it to function as intended.
- Core project is for study/demo; not production-ready (no password hashing or advanced validation).
- Use at your own discretion; especially face detection components.

## References

- Face Detection and Recognition integration inspired by the YouTube tutorial:  
  https://www.youtube.com/live/Hs584K075-g?si=0vK1y6BlJ7c7kx__

