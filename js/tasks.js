// =======================
//  TASK FUNCTIONS
// =======================

//_______________________________
// function openAddTaskModal() {
//     document.getElementById("addTaskModal").classList.remove("hidden");
//     document.getElementById("taskDueDate").value = selectedDate;
// }

// function closeAddTaskModal() {
//     document.getElementById("addTaskModal").classList.add("hidden");
// }
//______________________________________

// =======================
//  for open and close add task modal FUNCTIONS
// =======================

function openAddTaskModal() {
    const modal = document.getElementById("addTaskModal");
    modal.classList.remove("hidden");
    modal.classList.add("flex");

    // CLEAR OLD VALUES — REQUIRED
    document.getElementById("taskTitle").value = "";
    document.getElementById("taskDescription").value = "";
    document.getElementById("taskDueDate").value = selectedDate; // keep date
    document.getElementById("taskPriority").value = "low";
    document.getElementById("taskCategory").value = "work";
}

function closeAddTaskModal() {
    const modal = document.getElementById("addTaskModal");
    modal.classList.add("hidden");
    modal.classList.remove("flex"); // REQUIRED
}


// =======================
//  SAVE NEW TASK (AJAX)
// =======================
// function saveTask() {
//     const data = {
//         title: document.getElementById("taskTitle").value,
//         description: document.getElementById("taskDescription").value,
//         due_date: document.getElementById("taskDueDate").value,
//         priority: document.getElementById("taskPriority").value,
//         category: document.getElementById("taskCategory").value
//     };

//     fetch("api/add_task.php", {
//         method: "POST",
//         headers: { "Content-Type": "application/json" },
//         body: JSON.stringify(data)
//     })
//         .then(res => res.json())
//         .then(() => {
//             closeAddTaskModal();
//             loadTasksForDate(selectedDate);
//         });
// }
//-----------------------one more option as above not working
function saveTask() {
    const formData = new FormData();
    formData.append("title", document.getElementById("taskTitle").value);
    formData.append("description", document.getElementById("taskDescription").value);
    formData.append("due_date", document.getElementById("taskDueDate").value);
    formData.append("priority", document.getElementById("taskPriority").value);
    formData.append("category", document.getElementById("taskCategory").value);

    fetch("api/add_task.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        closeAddTaskModal();
        loadTasksForDate(selectedDate);
    });
}


// =======================
//  for open and close edit/update task modal FUNCTIONS
// =======================

function openEditTaskModal(id, title, desc, date, priority, category) {
    document.getElementById("editTaskModal").classList.remove("hidden");
    document.getElementById("editTaskModal").classList.add("flex");

    document.getElementById("editTaskId").value = id;
    document.getElementById("editTaskTitle").value = title;
    document.getElementById("editTaskDescription").value = desc;
    document.getElementById("editTaskDueDate").value = date;
    document.getElementById("editTaskPriority").value = priority;
    document.getElementById("editTaskCategory").value = category;
}

function closeEditTaskModal() {
    document.getElementById("editTaskModal").classList.add("hidden");
    document.getElementById("editTaskModal").classList.remove("flex");
}



// =======================
//  SAVE edit/update TASK (AJAX)
// =======================
function saveEditedTask() {
    const data = {
        id: document.getElementById("editTaskId").value,
        title: document.getElementById("editTaskTitle").value,
        description: document.getElementById("editTaskDescription").value,
        due_date: document.getElementById("editTaskDueDate").value,
        priority: document.getElementById("editTaskPriority").value,
        category: document.getElementById("editTaskCategory").value
    };

    fetch("api/update_task.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(() => {
        closeEditTaskModal();
        loadTasksForDate(selectedDate);
    });
}



// =======================
//  LOAD TASKS FOR DATE
// =======================
function loadTasksForDate(date) {
    document.getElementById("taskDateLabel").innerText = date;

    fetch("api/get_tasks.php?date=" + date)
        .then(res => res.json())
        .then(tasks => {
            const container = document.getElementById("tasksForDate");
            container.innerHTML = "";

            if (tasks.length === 0) {
                container.innerHTML = `<p class="text-gray-500 text-sm">No tasks for this date.</p>`;
                return;
            }

            tasks.forEach(task => {
                const div = document.createElement("div");
                div.className = "p-3 border rounded mb-2";

                div.innerHTML = `
                    <div class="flex justify-between">
                        <span class="font-medium">${task.title}</span>

                        <span class="text-sm text-gray-500">Due: ${task.due_date}</span>

                        <input type="checkbox"
                            ${task.status === "completed" ? "checked" : ""}
                            onchange="toggleStatus(${task.id})">

                    </div>

                    <p class="text-sm text-gray-600">${task.description}</p>

                    <span class="text-xs px-2 py-1 rounded text-white bg-${
                        task.priority === "high" ? "red-500" :
                        task.priority === "medium" ? "yellow-500" : "green-500"
                    }">${task.priority}</span>

                    <span class="text-xs px-2 py-1 rounded text-white ml-2 cat-${task.category}">
                        ${task.category}
                    </span>

                   
                    <div class="mt-2 flex gap-3">
                      <button onclick="openEditTaskModal(${task.id}, '${task.title}', '${task.description}', '${task.due_date}', '${task.priority}', '${task.category}')"
                         class="text-blue-500 text-sm">Edit</button>
 
                      <button onclick="deleteTask(${task.id})"
                         class="text-red-500 text-sm">Delete</button>
                    </div>
                `;

                container.appendChild(div);
            });
        });
}


// =======================
//  DELETE TASK
// =======================
// function deleteTask(id) {
//     fetch("api/delete_task.php?id=" + id)
//         .then(() => loadTasksForDate(selectedDate));
// }
function deleteTask(id) {
    fetch("api/delete_task.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: id })
    })
    .then(res => res.json())
    .then(() => loadTasksForDate(selectedDate));
}



// =======================
//  TOGGLE STATUS
// =======================
// function toggleStatus(id) {
//     fetch("api/toggle_status.php?id=" + id)
//         .then(() => loadTasksForDate(selectedDate));
// }
function toggleStatus(id) {
    fetch("api/toggle_status.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: id })
    })
    .then(res => res.json())
    .then(() => loadTasksForDate(selectedDate));
}

// =======================
//  FILTER SYSTEM
// =======================
function applyFilters() {
    const cat = document.getElementById("filterCategory").value;
    const pri = document.getElementById("filterPriority").value;
    const sta = document.getElementById("filterStatus").value;
    const sea = document.getElementById("taskSearch").value;

    let url = `api/get_tasks.php?filter=1`;

    if (cat) url += `&category=${cat}`;
    if (pri) url += `&priority=${pri}`;
    if (sta) url += `&status=${sta}`;
    if (sea) url += `&search=${sea}`;

    fetch(url)
        .then(res => res.json())
        .then(tasks => {
            const container = document.getElementById("tasksForDate");
            container.innerHTML = "";

            tasks.forEach(task => {
                const div = document.createElement("div");
                div.className = "p-3 border rounded mb-2";

                div.innerHTML = `
                    <div class="flex justify-between">
                        <span class="font-medium">${task.title}</span>
                        <span class="text-sm text-gray-500">Due: ${task.due_date}</span>
                        <input type="checkbox" ${task.status === "completed" ? "checked" : ""}>
                    </div>
                    <p>${task.description}</p>
                `;

                container.appendChild(div);
            });
        });
}

