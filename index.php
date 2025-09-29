<?php
session_start();

// Redirect to login if user not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Personal Information
$personal_info = [
    "name" => "Ian Emmanuel Comia",
    "phone" => "+639926251615",
    "email" => "comiaianemmanuel@gmail.com",
    "location" => "Taysan, Batangas"
];

// Summary
$summary = "A computer science undergraduate with experience in programming and development using Python, Java,
C++, and C#. With a good foundation in AI and data science with practical work on LangChain, Google Gemini
API, and regression modeling techniques. Demonstrates strong problem-solving skills, adaptability, and a proven
ability to learn new technologies quickly.";

// Technical Skills
$skills = [
    "Programming Languages" => "Experienced with C#, Java; Proficient with Python, C++",
    "Data Analysis & Visualization" => "Matplotlib, Pandas",
    "Machine Learning & AI" => "TensorFlow, Scikit-learn, LangChain",
    "Databases" => "MySQL, MongoDB"
];

// Projects
$projects = [
    [
        "title" => "FarmEase - AI-Powered Agricultural E-Commerce Platform (March 2025 - May 2025)",
        "details" => [
            "Machine learning model for crop recommendations based on soil, weather, and market data.",
            "Direct sales channel for farmers to sell produce to buyers without intermediaries.",
            "Digital platform for farmers to purchase inputs (seeds, fertilizers, equipment) at competitive prices."
        ]
    ],
    [
        "title" => "Improvements on the Existing Linear Regression Algorithm (March 2025 - May 2025)",
        "details" => [
            "Enhanced linear regression with preprocessing, robust regression, and transformations, reducing RMSE by 5.4% and increasing R² by 2.0%.",
            "Used residual diagnostics to improve stability and uncover limitations such as residual skew and linearity.",
            "Balanced accuracy with efficiency, gaining performance at the cost of significantly higher runtime and memory use."
        ]
    ]
];

// Education
$education = [
    [
        "institution" => "Batangas State University",
        "period" => "August 2023 - Present",
        "degree" => "Bachelor of Science in Computer Science"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $personal_info["name"]; ?> - CV</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            min-height: 100vh;
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -250px;
            right: -250px;
            animation: float 6s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: fixed;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            bottom: -200px;
            left: -200px;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        h1, h2 {
            color: #2c3e50;
        }
        h1 {
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
        }
        .contact {
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 25px;
        }
        ul {
            margin: 10px 0 0 20px;
        }
        .project-title {
            font-weight: bold;
        }
        .welcome {
            text-align: right;
            margin-bottom: 15px;
        }
        .welcome a {
            text-decoration: none;
            color: white;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            display: inline-block;
        }
        .welcome a:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(102, 126, 234, 0.5);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="welcome">
        Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?> | <a href="logout.php">Logout</a>
    </div>

    <!-- Header -->
    <h1><?php echo $personal_info["name"]; ?></h1>
    <div class="contact">
        <p>📞 <?php echo $personal_info["phone"]; ?> | 
           📧 <a href="mailto:<?php echo $personal_info["email"]; ?>"><?php echo $personal_info["email"]; ?></a> | 
           📍 <?php echo $personal_info["location"]; ?>
        </p>
    </div>

    <!-- Summary -->
    <div class="section">
        <h2>SUMMARY</h2>
        <p><?php echo $summary; ?></p>
    </div>

    <!-- Technical Skills -->
    <div class="section">
        <h2>TECHNICAL SKILLS</h2>
        <ul>
            <?php foreach ($skills as $category => $desc): ?>
                <li><strong><?php echo $category; ?>:</strong> <?php echo $desc; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Projects -->
    <div class="section">
        <h2>PROJECTS</h2>
        <?php foreach ($projects as $project): ?>
            <p class="project-title"><?php echo $project["title"]; ?></p>
            <ul>
                <?php foreach ($project["details"] as $detail): ?>
                    <li><?php echo $detail; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </div>

    <!-- Education -->
    <div class="section">
        <h2>EDUCATION</h2>
        <?php foreach ($education as $edu): ?>
            <p><strong><?php echo $edu["institution"]; ?></strong> (<?php echo $edu["period"]; ?>)<br>
                <?php echo $edu["degree"]; ?>
            </p>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>