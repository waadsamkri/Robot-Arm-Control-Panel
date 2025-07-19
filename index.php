<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Robot Arm Control Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h2>Robot Arm Control Panel</h2>

    <div id="sliders">
        <?php for ($i = 1; $i <= 6; $i++): ?>
            <label>Motor <?= $i ?>:
                <input type="range" min="0" max="180" value="90" class="motor" id="motor<?= $i ?>" oninput="updateValue(<?= $i ?>)">
                <span id="value<?= $i ?>">90</span>
            </label><br>
        <?php endfor; ?>
    </div>

    <button onclick="resetSliders()">Reset</button>
    <button onclick="savePose()">Save Pose</button>
    <button onclick="runPose()">Run</button>

    <hr>

    <div id="poseTable">
        <!-- سيتم تحميل الجدول هنا عبر JavaScript -->
    </div>

    <script src="script.js"></script>

</body>
</html>
