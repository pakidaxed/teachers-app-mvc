function closeModal() {
    document.getElementById('modal').style.display = 'none'
}

function openAddNewProject() {
    document.querySelector('.add-project-span').addEventListener('click', (e) => {
        document.getElementById('modal').style.display = 'flex'
    })
}

function openAddNewStudent() {
    document.getElementById('new_student').style.display = 'inline-flex'
    document.getElementById('student_name').reset()
}

function addNewProject() {
    const theForm = document.getElementById('submitBtn')
    theForm.addEventListener('click', e => {
        e.preventDefault()
        const projectName = document.getElementById('project_name').value
        const groupsTotal = document.getElementById('groups_total').value
        const studentsPerGroup = document.getElementById('students_per_group').value

        fetch(window.location.origin + "/api/add", {
            method: "POST",

            body: JSON.stringify({
                "project_name": projectName.trim(),
                "groups_total": groupsTotal.trim(),
                "students_per_group": studentsPerGroup.trim()
            })
        }).then(response => {
            return response.json()
        })
            .then(data => {
                    if (data.result === true) {
                        setTimeout(reloadPage, 1900)
                        setTimeout(closeModal, 2000)
                        document.querySelector('.new-project-content').textContent = 'Project added successfully'
                    } else {
                        document.getElementById('error').textContent = 'Please check the project name and try again'
                    }
                }
            ).catch(() => {
                document.getElementById('error').textContent = 'Please check the project name and try again'
            }
        )
    })
}

function reloadPage() {
    location.reload()
}