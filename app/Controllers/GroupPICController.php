<?php

namespace App\Controllers;

use App\Models\GroupModel;
use App\Models\EmployeeModel;
use App\Models\GroupEmployeeModel;

class GroupPICController extends BaseController
{
    public function index()
    {
        $groupModel = new GroupModel();
        $groups = $groupModel->findAll();
        return view('EMPLOYEE/group/group-pic', ['groups' => $groups]);
    }

    public function viewMembers($group_id)
    {
        $groupEmployeeModel = new GroupEmployeeModel();
        $employeeModel = new EmployeeModel();

        $groupEmployees = $groupEmployeeModel->where('group_id', $group_id)->findAll();
        $employees = [];
        foreach ($groupEmployees as $groupEmployee) {
            $employee = $employeeModel->find($groupEmployee['employee_id']);
            $employees[] = $employee;
        }

        return view('ACCOUNT MANAGER/group/group-members', ['group_id' => $group_id, 'employees' => $employees]);
    }

    public function create()
    {
        return view('EMPLOYEE/group/create-group');
    }

    public function store()
    {
        $groupModel = new GroupModel();
        $data = [
            'group_name' => $this->request->getPost('group_name'),
            'description' => $this->request->getPost('description')
        ];

        $groupModel->insert($data);
        return redirect()->to('EMPLOYEE/group/group-pic')->with('success', 'Group created successfully!');
    }

    public function edit($group_id)
    {
        $groupModel = new GroupModel();
        $groupEmployeeModel = new GroupEmployeeModel();
        $employeeModel = new EmployeeModel();

        $group = $groupModel->find($group_id);
        $groupEmployees = $groupEmployeeModel->where('group_id', $group_id)->findAll();
        $all_employees = $employeeModel->findAll();

        return view('EMPLOYEE/group/edit-group', [
            'group' => $group,
            'groupEmployees' => $groupEmployees,
            'all_employees' => $all_employees,
            'employeeModel' => $employeeModel
        ]);
    }

    public function save($group_id = null)
    {
        $groupModel = new GroupModel();
        $groupEmployeeModel = new GroupEmployeeModel();
        $employeeModel = new EmployeeModel();

        $group_name = $this->request->getPost('group_name');
        $description = $this->request->getPost('description');
        $employeeIds = $this->request->getPost('employee_ids');

        if (!is_array($employeeIds)) {
            $employeeIds = [];
        }

        if ($group_id) {
            $groupModel->update($group_id, [
                'group_name' => $group_name,
                'description' => $description
            ]);

            if (!empty($employeeIds)) {
                $groupEmployeeModel->where('group_id', $group_id)
                    ->whereNotIn('employee_id', $employeeIds)
                    ->delete();
            }
        } else {
            $group_id = $groupModel->insert([
                'group_name' => $group_name,
                'description' => $description
            ]);
        }

        if (!empty($employeeIds)) {
            foreach ($employeeIds as $employeeId) {
                $existingMember = $groupEmployeeModel->where('group_id', $group_id)
                    ->where('employee_id', $employeeId)
                    ->first();
                if (!$existingMember) {
                    $groupEmployeeModel->insert([
                        'group_id' => $group_id,
                        'employee_id' => $employeeId
                    ]);
                }
            }
        }

        return redirect()->to('EMPLOYEE/group/group-pic')->with('success', 'Group saved successfully!');
    }

    public function removeMember($group_id, $employee_id)
    {
        if (!$group_id || !$employee_id) {
            return redirect()->back()->with('error', 'Invalid group or member ID.');
        }

        $groupEmployeeModel = new GroupEmployeeModel();

        try {
            $member = $groupEmployeeModel->where('group_id', $group_id)
                ->where('employee_id', $employee_id)
                ->first();

            if (!$member) {
                return redirect()->back()->with('error', 'Member not found in the group.');
            }

            $groupEmployeeModel->where('group_id', $group_id)
                ->where('employee_id', $employee_id)
                ->delete();

            return redirect()->to('EMPLOYEE/group/edit-group/' . $group_id)->with('success', 'Member removed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove member: ' . $e->getMessage());
        }
    }

    public function addMember()
    {
        $groupEmployeeModel = new GroupEmployeeModel();
        $employeeModel = new EmployeeModel();

        $group_id = $this->request->getJSON()->group_id;
        $employee_id = $this->request->getJSON()->employee_id;

        if (!$group_id || !$employee_id) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Group ID or Employee ID is missing.'
            ]);
        }

        $existingMember = $groupEmployeeModel->where('group_id', $group_id)
            ->where('employee_id', $employee_id)
            ->first();

        if ($existingMember) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'This member is already part of the group.'
            ]);
        }

        $groupEmployeeModel->insert([
            'group_id' => $group_id,
            'employee_id' => $employee_id
        ]);

        $employee = $employeeModel->find($employee_id);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Member added successfully!',
            'employee' => $employee
        ]);
    }

    public function detail($id)
    {
        $groupModel = new GroupModel();
        $employeeModel = new EmployeeModel();
        $group = $groupModel->find($id);
        $groupEmployees = $groupModel->getGroupEmployees($id);

        return view('EMPLOYEE/group/detail', [
            'group' => $group,
            'groupEmployees' => $groupEmployees,
            'employeeModel' => $employeeModel
        ]);
    }

    public function delete($group_id)
    {
        $groupModel = new GroupModel();
        $groupEmployeeModel = new GroupEmployeeModel();

        $groupEmployeeModel->where('group_id', $group_id)->delete();
        $groupModel->delete($group_id);

        return redirect()->to('EMPLOYEE/group/group-pic')->with('success', 'Group successfully deleted.');
    }
}
