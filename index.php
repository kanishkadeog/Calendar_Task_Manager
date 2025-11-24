<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<?php require "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Calendar + Task Manager</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Custom JS -->
<script src="js/calendar.js" defer></script>
<script src="js/tasks.js" defer></script>

<style>
/* Today highlight (Google Blue circle) */
.today-circle {
    background-color: #1A73E8 !important;
    color: white !important;
    border-radius: 50%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 32px;
    height: 32px;
}

/* Category colors */
.cat-work     { background: #4285F4; }
.cat-personal { background: #DB4437; }
.cat-health   { background: #0F9D58; }
.cat-study    { background: #F4B400; }
</style>

</head>
<body class="bg-gray-100">

<!-- TOP GOOGLE STYLE HEADER -->
<header class="w-full bg-[#1A73E8] text-white py-4 shadow">
    <div class="max-w-6xl mx-auto flex justify-between items-center px-4">
        <h1 class="text-2xl font-semibold">Calendar</h1>

        <div class="flex items-center gap-3">
            <button id="prevMonth" class="px-3 py-1 bg-white text-[#1A73E8] rounded">‹</button>
            <h2 id="monthLabel" class="text-xl font-medium"></h2>
            <button id="nextMonth" class="px-3 py-1 bg-white text-[#1A73E8] rounded">›</button>

            <button id="todayBtn"
                class="ml-4 px-4 py-1 border border-white rounded hover:bg-white hover:text-[#1A73E8]">
                Today
            </button>
        </div>
    </div>
</header>


<!-- MAIN LAYOUT: SIDEBAR + CALENDAR + TASK PANEL -->
<div class="max-w-7xl mx-auto mt-6 grid grid-cols-12 gap-4 px-4">

    <!-- LEFT SIDEBAR (Filters + Mini Calendar) -->
    <aside class="col-span-3 bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-3">Filters</h3>

        <!-- SEARCH -->
        <input id="taskSearch" type="text" placeholder="Search tasks..."
            class="w-full mb-4 px-3 py-2 border rounded">

        <!-- CATEGORY FILTER -->
        <label class="font-medium">Category</label>
        <select id="filterCategory" class="w-full border mt-1 mb-3 px-3 py-2 rounded">
            <option value="">All</option>
            <option value="work">Work</option>
            <option value="personal">Personal</option>
            <option value="health">Health</option>
            <option value="study">Study</option>
        </select>

        <!-- PRIORITY FILTER -->
        <label class="font-medium">Priority</label>
        <select id="filterPriority" class="w-full border mt-1 mb-3 px-3 py-2 rounded">
            <option value="">All</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>

        <!-- STATUS FILTER -->
        <label class="font-medium">Status</label>
        <select id="filterStatus" class="w-full border mt-1 mb-3 px-3 py-2 rounded">
            <option value="">All</option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
        </select>

        <!-- APPLY FILTER BUTTON -->
        <button onclick="applyFilters()"
            class="w-full mt-3 bg-[#1A73E8] text-white py-2 rounded hover:bg-blue-600">
            Apply Filters
        </button>
    </aside>


    <!-- CENTER: CALENDAR MONTH GRID -->
    <main class="col-span-6 bg-white p-4 rounded shadow">
        <div class="grid grid-cols-7 text-center font-semibold border-b pb-2">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>

        <!-- Days go here -->
        <div id="calendarGrid" class="grid grid-cols-7 mt-2 gap-y-6"></div>
    </main>


    <!-- RIGHT SIDEBAR — TASK LIST FOR SELECTED DAY -->
    <aside class="col-span-3 bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-3">Tasks on <span id="taskDateLabel"></span></h3>

        <div id="tasksForDate"></div>

        <button onclick="openAddTaskModal()"
            class="mt-5 w-full bg-[#1A73E8] text-white py-2 rounded">
            + Add Task
        </button>
    </aside>
</div>


<!-- ADD TASK MODAL -->
<div id="addTaskModal"
    class="fixed inset-0 bg-black/50 hidden flex justify-center items-center z-50">

    <div class="bg-white w-96 p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Add Task</h2>

        <label>Title</label>
        <input id="taskTitle" class="w-full border px-3 py-2 rounded mb-3">

        <label>Description</label>
        <textarea id="taskDescription" class="w-full border px-3 py-2 rounded mb-3"></textarea>

        <label>Due Date</label>
        <input id="taskDueDate" type="date" class="w-full border px-3 py-2 rounded mb-3">

        <label>Priority</label>
        <select id="taskPriority" class="w-full border px-3 py-2 rounded mb-3">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>

        <label>Category</label>
        <select id="taskCategory" class="w-full border px-3 py-2 rounded mb-4">
            <option value="work">Work</option>
            <option value="personal">Personal</option>
            <option value="health">Health</option>
            <option value="study">Study</option>
        </select>

        <div class="flex justify-end gap-3">
            <button onclick="closeAddTaskModal()"
                class="px-4 py-2 border rounded">Cancel</button>

            <button onclick="saveTask()"
                class="px-4 py-2 bg-[#1A73E8] text-white rounded">
                Save
            </button>
        </div>
    </div>
</div>

<!-- EDIT TASK MODAL -->
<div id="editTaskModal"
    class="fixed inset-0 bg-black/50 hidden flex justify-center items-center z-50">

    <div class="bg-white w-96 p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Edit Task</h2>

        <input type="hidden" id="editTaskId">

        <label>Title</label>
        <input id="editTaskTitle" class="w-full border px-3 py-2 rounded mb-3">

        <label>Description</label>
        <textarea id="editTaskDescription" class="w-full border px-3 py-2 rounded mb-3"></textarea>

        <label>Due Date</label>
        <input id="editTaskDueDate" type="date" class="w-full border px-3 py-2 rounded mb-3">

        <label>Priority</label>
        <select id="editTaskPriority" class="w-full border px-3 py-2 rounded mb-3">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>

        <label>Category</label>
        <select id="editTaskCategory" class="w-full border px-3 py-2 rounded mb-4">
            <option value="work">Work</option>
            <option value="personal">Personal</option>
            <option value="health">Health</option>
            <option value="study">Study</option>
        </select>

        <div class="flex justify-end gap-3">
            <button onclick="closeEditTaskModal()"
                class="px-4 py-2 border rounded">Cancel</button>

            <button onclick="saveEditedTask()"
                class="px-4 py-2 bg-[#1A73E8] text-white rounded">
                Update
            </button>
        </div>
    </div>
</div>



</body>
</html>
