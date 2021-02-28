<div class="container">
    <h1>Teachers Task</h1>
    <div class="container text-center">
        <h1 class="mt-100">Select Project</h1>
        <span class="add-project-span" onclick="openAddNewProject()">+ New project</span>
        <div id="projects_list">
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $project): ?>
                    <a class="projects-list-link" href="/projects/show/<?= $project['id'] ?>">
                        <p class="projects-list"><?= $project['name'] ?>
                            <span>(<?= $project['groups_total'] ?> groups)</span>
                        </p>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No projects added</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="new-project-modal" id="modal">
    <div class="modal-background"></div>
    <div class="new-project-content">
        <h1>Add New Project</h1>
        <div id="error"></div>
        <span class="close-modal-span" onclick="closeModal()">❌</span>
        <form id="newForm">
            <div class="form-control">
                <label for="project_name">Project name</label>
                <input type="text" name="project_name" id="project_name"/>
            </div>
            <div class="form-control d-flex">
                <div class="form-control text-center p-20">
                    <label for="groups_total">Groups total</label>
                    <input class="text-center" type="number" name="groups_total" id="groups_total" min="1" max="99"
                           value="2"/>
                </div>
                <div class="form-control text-center p-20">
                    <label for="students_per_group">Students per group</label>
                    <input class="text-center" type="number" name="students_per_group" id="students_per_group" min="1"
                           max="99" value="2"/>
                </div>
            </div>
            <div class="form-actions">
                <button id="submitBtn" class="button-full" onclick="addNewProject()">Create new project</button>
            </div>
        </form>
    </div>
</div>