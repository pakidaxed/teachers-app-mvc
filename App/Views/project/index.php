<?php
$project = $data['project'];
$assignedStudents = $data['assigned_students'];
$availableStudents = $data['available_students'];
$students = array_merge($assignedStudents, $availableStudents);
$groups = $data['groups'];
?>
<div class="container">
    <div class="project-info">
        <div class="header-line">
            <h1><span class="text-black">Project</span> <?= $project['name'] ?></h1>
            <a href="/"><h3>Switch project</h3></a>
        </div>

        <p>Number of groups: <span class="text-red"><?= $project['groups_total'] ?></span></p>
        <p>Students per group: <span class="text-red"><?= $project['students_per_group'] ?></span></p>
    </div>
    <div class="error">
        <?= $_SESSION['message'] ?: '' ?>
    </div>
    <div class="students-list">
        <h1>Students
            <button onclick="openAddNewStudent()">Add new student</button>
        </h1>
        <div class="add-new-student" id="new_student">
            <form method="post" action="/projects/show/<?= $project['id'] ?>/add">
                <label for="new_student_name">New student name:</label>
                <input type="text" name="new_student_name" id="new_student_name"/>
                <button class="d-block">Add</button>
            </form>
        </div>
        <table>
            <thead>
            <tr>
                <th>Student name</th>
                <th>Student group</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['name']) ?></td>

                    <td>
                        <?php
                        $found_key = array_search($student['group_id'], array_column($groups, 'id'));
                        ?><?= $found_key !== false ? $groups[(int)$found_key]['name'] : 'No group' ?>
                    </td>
                    <td>
                        <a href="/projects/show/<?= $project['id'] ?>/delete/<?= $student['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="groups">
        <h1>Groups</h1>
        <div class="groups-control">
            <?php foreach ($groups as $group): ?>
                <table id="groups">
                    <thead>
                    <tr>
                        <th><?= $group['name'] ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 1; $i <= $project['students_per_group']; $i++): ?>
                        <tr>
                            <td>
                                <?php
                                $studentName = null;
                                foreach ($assignedStudents as $assignedStudent) {
                                    if ($assignedStudent['position'] == $i && $assignedStudent['group_id'] == $group['id']) {
                                        $studentName = $assignedStudent['name'];
                                    }
                                }
                                if ($studentName): ?>
                                    <?= $studentName ?>
                                <?php else: ?>
                                    <form method="post" action="/projects/show/<?= $project['id'] ?>/assign">
                                        <input type="hidden" name="group_id" value="<?= $group['id'] ?>">
                                        <input type="hidden" name="position" value="<?= $i ?>">
                                        <label>
                                            <select name="student_id" id="student_id" onchange="this.form.submit()">
                                                <option value="null">Assign student</option>
                                                <?php foreach ($availableStudents as $availableStudent): ?>
                                                    <option value="<?= $availableStudent['id'] ?>"><?= $availableStudent['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </label>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        </div>
    </div>