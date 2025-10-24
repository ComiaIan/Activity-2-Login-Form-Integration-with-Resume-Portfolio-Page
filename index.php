<?php
session_start();
require 'db.php';

$stmt = $pdo->query("SELECT * FROM resume LIMIT 1");
$resume = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$resume) {
    die("No resume data found in the database.");
}

// Fetch skills
$stmt = $pdo->prepare("SELECT category, description FROM skills WHERE resume_id = :id");
$stmt->execute(['id' => $resume['id']]);
$skills = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch projects
$stmt = $pdo->prepare("SELECT id, title FROM projects WHERE resume_id = :id");
$stmt->execute(['id' => $resume['id']]);
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch project details
$projectData = [];
foreach ($projects as $proj) {
    $stmt = $pdo->prepare("SELECT detail FROM project_details WHERE project_id = :pid");
    $stmt->execute(['pid' => $proj['id']]);
    $details = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $projectData[] = [
        'title' => $proj['title'],
        'details' => $details
    ];
}

// Fetch education
$stmt = $pdo->prepare("SELECT institution, period, degree FROM education WHERE resume_id = :id");
$stmt->execute(['id' => $resume['id']]);
$education = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check login state
$isLoggedIn = isset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($resume["name"]); ?> - CV</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            min-height: 100vh;
            padding: 40px 20px;
            overflow-x: hidden;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            position: relative;
        }
        h1, h2 { color: #2c3e50; }
        h1 { border-bottom: 2px solid #2c3e50; padding-bottom: 10px; }
        .contact { margin-bottom: 20px; }
        .section { margin-bottom: 25px; }
        ul { margin: 10px 0 0 20px; }
        .project-title { font-weight: bold; }
        .topbar {
            text-align: right;
            margin-bottom: 20px;
        }
        .topbar a {
            text-decoration: none;
            color: white;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102,126,234,0.4);
            display: inline-block;
        }
        .topbar a:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(102,126,234,0.5);
        }
        .edit-btn {
            color: #007bff;
            text-decoration: underline;
            cursor: pointer;
            margin-left: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="topbar">
        <?php if ($isLoggedIn): ?>
            Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?> |
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>

    <!-- Header -->
    <h1>
        <?php echo htmlspecialchars($resume["name"]); ?>
        <?php if ($isLoggedIn): ?><span class="edit-btn" onclick="editField('name')">[Edit]</span><?php endif; ?>
    </h1>
    <div class="contact">
        <p>📞 <?php echo htmlspecialchars($resume["phone"]); ?> |
           📧 <a href="mailto:<?php echo htmlspecialchars($resume["email"]); ?>"><?php echo htmlspecialchars($resume["email"]); ?></a> |
           📍 <?php echo htmlspecialchars($resume["location"]); ?>
        </p>
    </div>

    <!-- Summary -->
    <div class="section">
        <h2>SUMMARY <?php if ($isLoggedIn): ?><span class="edit-btn" onclick="editField('summary')">[Edit]</span><?php endif; ?></h2>
        <p><?php echo nl2br(htmlspecialchars($resume["summary"])); ?></p>
    </div>

    <!-- Skills -->
    <div class="section">
        <h2>TECHNICAL SKILLS</h2>
        <ul>
            <?php foreach ($skills as $skill): ?>
                <li>
                    <strong><?php echo htmlspecialchars($skill["category"]); ?>:</strong> <?php echo htmlspecialchars($skill["description"]); ?>
                    <?php if ($isLoggedIn): ?><span class="edit-btn">[Edit]</span><?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Projects -->
    <div class="section">
        <h2>PROJECTS</h2>
        <?php foreach ($projectData as $proj): ?>
            <p class="project-title">
                <?php echo htmlspecialchars($proj["title"]); ?>
                <?php if ($isLoggedIn): ?><span class="edit-btn">[Edit]</span><?php endif; ?>
            </p>
            <ul>
                <?php foreach ($proj["details"] as $detail): ?>
                    <li><?php echo htmlspecialchars($detail); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </div>

    <!-- Education -->
    <div class="section">
        <h2>EDUCATION</h2>
        <?php foreach ($education as $edu): ?>
            <p>
                <strong><?php echo htmlspecialchars($edu["institution"]); ?></strong>
                (<?php echo htmlspecialchars($edu["period"]); ?>)<br>
                <?php echo htmlspecialchars($edu["degree"]); ?>
            </p>
        <?php endforeach; ?>
    </div>
</div>

<script>
function editField(field) {
    alert("Editing feature coming soon: " + field);
    // TODO: Later, you’ll replace this with a form or inline editing system
}
</script>
</body>
</html>
