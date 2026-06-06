function showDosenPanel(panelId, button = null) {
    document.querySelectorAll('.dosen-panel').forEach((panel) => {
        panel.hidden = panel.id !== panelId;
    });

    document.querySelectorAll('.panel-btn').forEach((panelButton) => {
        panelButton.classList.remove('panel-btn-active');
    });

    if (button) {
        button.classList.add('panel-btn-active');
    }
}

function toggleTaskForm() {
    showDosenPanel('task-form-panel');
}

function toggleNilai(button) {
    const target = document.getElementById(button.dataset.target);

    if (!target) {
        return;
    }

    target.hidden = !target.hidden;
    button.textContent = target.hidden ? 'Lihat Nilai' : 'Sembunyikan Nilai';
}

const alerts = document.querySelectorAll('.alert');

alerts.forEach((alert) => {
    setTimeout(() => {
        alert.style.opacity = '0.92';
    }, 1800);
});
const panelFromUrl = new URLSearchParams(window.location.search).get('panel');

if (panelFromUrl === 'grading') {
    showDosenPanel('grading-panel');
}