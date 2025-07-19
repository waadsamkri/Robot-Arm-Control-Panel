// تحديث القيمة بجانب كل منزلق عند التغيير
function updateValue(motorNumber) {
    const slider = document.getElementById(`motor${motorNumber}`);
    const valueSpan = document.getElementById(`value${motorNumber}`);
    if (slider && valueSpan) {
        valueSpan.textContent = slider.value;
    }
}

// إعادة جميع القيم إلى 90
function resetSliders() {
    for (let i = 1; i <= 6; i++) {
        const slider = document.getElementById(`motor${i}`);
        if (slider) {
            slider.value = 90;
            updateValue(i);
        }
    }
}

// إرسال الوضعية الحالية لحفظها
function savePose() {
    const data = {};
    for (let i = 1; i <= 6; i++) {
        const slider = document.getElementById(`motor${i}`);
        if (slider) {
            data[`motor${i}`] = slider.value;
        }
    }

    fetch('save_pose.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(res => res.text())
    .then(response => {
        alert(response);
        loadPoses(); // تحديث الجدول
    })
    .catch(err => {
        console.error('Error saving pose:', err);
        alert('حدث خطأ أثناء حفظ الوضعية.');
    });
}

// تحميل جميع الوضعيات من السيرفر
function loadPoses() {
    fetch('get_run_pose.php')
        .then(res => res.json())
        .then(data => {
            let html = `
                <table>
                    <tr>
                        <th>#</th>
                        <th>Motor 1</th>
                        <th>Motor 2</th>
                        <th>Motor 3</th>
                        <th>Motor 4</th>
                        <th>Motor 5</th>
                        <th>Motor 6</th>
                        <th>Action</th>
                    </tr>
            `;

            data.forEach((pose, index) => {
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${pose.motor1}</td>
                        <td>${pose.motor2}</td>
                        <td>${pose.motor3}</td>
                        <td>${pose.motor4}</td>
                        <td>${pose.motor5}</td>
                        <td>${pose.motor6}</td>
                        <td>
                            <button onclick="loadPose(${pose.id})">Load</button>
                            <button onclick="removePose(${pose.id})">Remove</button>
                        </td>
                    </tr>
                `;
            });

            html += `</table>`;
            const tableContainer = document.getElementById('poseTable');
            if(tableContainer) {
                tableContainer.innerHTML = html;
            }
        })
        .catch(err => {
            console.error('Error loading poses:', err);
        });
}

// تحميل قيمة معينة إلى المنزلقات
function loadPose(id) {
    fetch(`load_pose.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            console.log("Loaded pose data:", data);
            for (let i = 1; i <= 6; i++) {
                const slider = document.getElementById(`motor${i}`);
                if (slider && data[`motor${i}`] !== undefined) {
                    slider.value = data[`motor${i}`];
                    updateValue(i);
                }
            }
        })
        .catch(err => {
            console.error("Error loading pose:", err);
            alert('حدث خطأ أثناء تحميل الوضعية.');
        });
}

// حذف وضع معين (تحديث status إلى 0)
function removePose(id) {
    fetch('update_status.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: id })
    })
    .then(res => res.text())
    .then(response => {
        alert(response);
        loadPoses(); // تحديث الجدول
    })
    .catch(err => {
        console.error('Error removing pose:', err);
        alert('حدث خطأ أثناء حذف الوضعية.');
    });
}

// زر Run (تنفيذ - ممكن توسيعه لاحقاً)
function runPose() {
    alert("Running pose... (you can connect this to actual hardware later)");
}

// تحميل الوضعيات تلقائيًا عند فتح الصفحة
window.onload = loadPoses;
