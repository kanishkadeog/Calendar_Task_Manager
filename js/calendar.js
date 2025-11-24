// =========================
//  GOOGLE CALENDAR LOGIC
// =========================

// Current date tracker
let currentDate = new Date();
let selectedDate = formatDate(new Date());

// Run on page load
document.addEventListener("DOMContentLoaded", () => {
    renderCalendar();
    loadTasksForDate(selectedDate);

    document.getElementById("todayBtn").onclick = () => {
        currentDate = new Date();
        selectedDate = formatDate(new Date());
        renderCalendar();
        loadTasksForDate(selectedDate);
    };

    document.getElementById("prevMonth").onclick = () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    };

    document.getElementById("nextMonth").onclick = () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    };
});


// =============================
//  RENDER CALENDAR UI
// =============================
function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    // Month label (e.g., "January 2025")
    document.getElementById("monthLabel").innerText =
        currentDate.toLocaleString("default", { month: "long", year: "numeric" });

    const firstDay = new Date(year, month, 1).getDay(); // Sunday = 0
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    const grid = document.getElementById("calendarGrid");
    grid.innerHTML = "";

    // Leading empty cells
    for (let i = 0; i < firstDay; i++) {
        const cell = document.createElement("div");
        grid.appendChild(cell);
    }

    // Days
    for (let day = 1; day <= daysInMonth; day++) {
        const cell = document.createElement("div");
        cell.className = "text-center cursor-pointer select-none";

        let dateStr = `${year}-${pad(month + 1)}-${pad(day)}`;

        // Highlight selected date
        if (dateStr === selectedDate) {
            cell.innerHTML = `<span class="today-circle">${day}</span>`;
        } else {
            cell.innerHTML = `<span class="inline-block w-8 h-8 leading-8 rounded hover:bg-gray-200">${day}</span>`;
        }

        // Click date
        cell.onclick = () => {
            selectedDate = dateStr;
            renderCalendar();
            loadTasksForDate(selectedDate);
        };

        grid.appendChild(cell);
    }
}


// =============================
//  HELPERS
// =============================
function pad(n) {
    return n < 10 ? "0" + n : n;
}

function formatDate(date) {
    return `${date.getFullYear()}-${pad(date.getMonth() + 1)}-${pad(date.getDate())}`;
}
